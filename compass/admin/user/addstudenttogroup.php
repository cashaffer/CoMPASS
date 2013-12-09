<?php
session_start();
if ($_SESSION['loginname'] == null)
	header("location:/compass/error_code.php?code=001"); 
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(8))
		header("location:/compass/error_code.php?code=004"); 
}	

include "db_mysql_mt.inc"; 
include "config.inc"; 
include "pager.inc"; 
	
$db = new DB_Sql;

$db->connect();

$gid = $_REQUEST['idgroup'];
$orderby = $_REQUEST['orderby'];

if($orderby == null)
	$orderby = "loginname";

$sql = "select idclass from studygroup where idgroup=".$gid;
$db->query($sql);
$db->next_record();
$cid=$db->Record['idclass'];
$sql = "select u1.iduser iduser,u1.loginname,u1.firstname firstname,u1.lastname lastname from user u1,TAKESCLASS tc1 where u1.usertype=1 and tc1.idstudent=u1.iduser and tc1.idclass="
	.$cid." order by u1.".$orderby;

if ( isset($_GET['page']) )
{
   $page = (int)$_GET['page'];
}
else
{
   $page = 1;
} 
$pager_option = array(
       "sql" => $sql,
       "PageSize" => PageSize,
       "CurrentPageID" => $page
); 
if ( isset($_GET['numItems']) )
{
   $pager_option['numItems'] = (int)$_GET['numItems'];
} 
$pager = new Pager($pager_option); 

if ( $pager->isFirstPage )
{
   $turnover = "";
}
else
{
   $turnover = "<a href='?idgroup=".$gid."&orderby=".$orderby."&page=1&numItems=".$pager->numItems."'>First</a> | <a href='?idgroup=".$gid."&orderby=".$orderby."&page=".$pager->PreviousPageID."&numItems=".$pager->numItems."'>Last Page</a> | ";
} 
if ( $pager->isLastPage )
{
   $turnover .= "";
}
else
{
   $turnover .= "<a href='?idgroup=".$gid."&orderby=".$orderby."&page=".$pager->NextPageID."&numItems=".$pager->numItems."'>Next Page</a> | <a href='?idgroup=".$gid."&orderby=".$orderby."&page=".$pager->numPages."&numItems=".$pager->numItems."'>End</a>";
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
function orderby(column){
	MM_goToURL('self','grouplist.php?idgroup=<%=gid%>&orderby='+column);
	return document.MM_returnValue;
}
</script>
</head>
<link rel="stylesheet"  href="../../css/compass.css" type="text/css" media=screen>
<body>
<center>
<p>&nbsp;</p>
  <p><span class="tabletitle"> Student List (to Group <?= $_REQUEST['gname']?>)</span></p>
  <form name="form1" method="post" action="savegroupstudent.php">
    <table width="75%" border="1" cellspacing="0" cellpadding="0">
      <tr class="menutitle"> 
        <td width="12%">&nbsp;</td>
        <td width="31%"><a href="#" onClick="orderby('loginname');">User Name</a></td>
        <td width="41%"><a href="#" onClick="orderby('firstname');">Real Name</a></td>
        <td width="16%"><a href="#" onClick="orderby('status');">Status</a></td>
      </tr>
      <?php
	$bgcolor = "#FFFFDD";
	$count = true;
	$pager->getDataLink();
	while($db->next_record()){
		$bgcolor = ($count?"#FFFFFF":"#FFFFDD");
?>
      <tr bgcolor="<?= $bgcolor?>"> 
        <td><div align="center">
            <input type="checkbox" name="iduser[]" value="<?= $db->Record['iduser']?>">
          </div></td>
        <td><div align="center"> 
            <?= $db->Record['loginname']?>
          </div></td>
        <td><div align="center"> 
            <?= ($db->Record['firstname']==""?"&nbsp;":$db->Record['firstname'])?>
            &nbsp; 
            <?= ($db->Record['lastname']==""?"&nbsp;":$db->Record['lastname'])?>
          </div></td>
        <td><div align="center"> 
            <?= (($db->Record['status']==0)?"Normal":"Frozen")?>
          </div></td>
      </tr>
      <?php
	}
?>
    </table>
	<br>
    <br>
	<?=$turnover?>
    <p> 
      <input type="hidden" name="idgroup" value="<?=$gid?>">
      <input name="Submit23" type="submit" value="Add Students">
      &nbsp;&nbsp;
      <input name="Submit22" type="button" onClick="MM_goToURL('self','studentlist1.php?gid=<?=$gid?>');return document.MM_returnValue" value="Cancel">
    </p>
  </form>
</center>
</body>
</html>
