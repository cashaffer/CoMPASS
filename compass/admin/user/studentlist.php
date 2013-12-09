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
	
$db = new DB_Sql;

$db->connect();

$cid = $_REQUEST['cid'];
$orderby = null;

if(isset($_REQUEST['orderby'])){
$orderby = $_REQUEST['orderby'];}

if($orderby == null)
	$orderby = "loginname";

$sql = "select u.iduser iduser,u.loginname,u.firstname firstname,u.lastname lastname,u.status status from TAKESCLASS,user u where TAKESCLASS.idclass=".$cid." and TAKESCLASS.idstudent=u.iduser order by u.".$orderby;

$query = $db->query($sql);

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
	MM_goToURL('self','classlist.php?orderby='+column);
	return document.MM_returnValue;
}
</script>
</head>
<link rel="stylesheet"  href="../../css/compass.css" type="text/css" media=screen>
<body>
<center>
<p>&nbsp;</p>
  <p><span class="tabletitle"> Student List (Class Name:<?= $_REQUEST['cname']?>)</span></p>
  <form name="form1" method="post" action="">
    <table width="75%" border="1" cellspacing="0" cellpadding="0">
      <tr class="menutitle"> 
        <td width="42%"><a href="#" onClick="orderby('loginname');">User Name</a></td>
        <td width="37%"><a href="#" onClick="orderby('firstname');">Real Name</a></td>
        <td width="21%"><a href="#" onClick="orderby('status');">Status</a></td>
        <td width="21%">Operation</td>
      </tr>
      <?php
	$bgcolor = "#FFFFDD";
	$count = true;
	while($db->next_record()){
		$bgcolor = ($count?"#FFFFFF":"#FFFFDD");
?>
      <tr bgcolor="<?= $bgcolor?>"> 
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
        <td><div align="center">
            <input name="Submit" type="submit" onClick="MM_goToURL('self','deleteuserfromclass.php?iduser=<?=$db->Record['iduser']?>&idclass=<?=$cid?>');return document.MM_returnValue" value="Delete">
          </div></td>
      </tr>
      <?php
	$count = !$count;
	}
?>
    </table>
    <p> 
      <input name="Submit2" type="button" onClick="MM_goToURL('self','addstudenttoclass.php?idclass=<?=$cid?>');return document.MM_returnValue" value="Add Students">
      &nbsp;&nbsp;
      <input name="Submit22" type="button" onClick="MM_goToURL('self','classlist.php');return document.MM_returnValue" value="Cancel">
    </p>
  </form>
</center>
</body>
</html>
