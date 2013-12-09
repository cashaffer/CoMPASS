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

$type = null;
$orderby = null;

if(isset($_REQUEST['type'])){
$type = $_REQUEST['type'];}

if(isset($_REQUEST['orderby'])){
$orderby = $_REQUEST['orderby'];}

if($orderby == null)
	$orderby = "name";

if($orderby == "idteacher"){
    $sql = "select distinct g.name groupname,c.name classname,t.name term,g.status status,u.firstname firstname,u.lastname lastname,g.description description,g.idgroup idgroup from CLASS c,USER u,STUDYGROUP g,TERM t where c.idclass=g.idclass AND t.idterm=g.idterm AND c.idteacher=u.iduser order by c.".$orderby ;
}
else {
    $sql = "select distinct g.name groupname,c.name classname,t.name term,g.status status,u.firstname firstname,u.lastname lastname,g.description description,g.idgroup idgroup from CLASS c,USER u,STUDYGROUP g,TERM t where c.idclass=g.idclass AND t.idterm=g.idterm AND c.idteacher=u.iduser order by g.".$orderby ;
}

$query = $db->query($sql);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Group List</title>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->

function orderby(column){
	MM_goToURL('self','grouplist.php?orderby='+column);
	return document.MM_returnValue;
}
</script>
</head>
<link rel="stylesheet"  href="../../css/compass.css" type="text/css" media=screen>
<body>
<center>
<p>&nbsp;</p>
  <p class="tabletitle">Group List </p>
  <table width="75%" border="1" cellspacing="0" cellpadding="0">
    <tr class="menutitle"> 
      <td width="17%"><a href="#" onClick="orderby('name');">Group Name</a></td>
      <td width="27%"><a href="#" onClick="orderby('idclass');">Class Name</a></td>
      <td width="27%"><a href="#" onClick="orderby('idterm');">Term</a></td>
      <td width="35%"><a href="#" onClick="orderby('idteacher');">Teacher</a></td>
      <td width="7%">Modify</td>
    </tr>
    <?php
	$bgcolor = "#FFFFDD";
	$count = true;
	while($db->next_record()){
		$bgcolor = ($count?"#FFFFFF":"#FFFFDD");
?>
    <tr bgcolor="<?= $bgcolor?>"> 
      <td><div align="center"> <a href="studentlist1.php?gid=<?=$db->Record['idgroup']?>&gname=<?= $db->Record['groupname']?>">
          <?= $db->Record['groupname']?> </a>
        </div></td>
      <td height="22" class="tabletitle"> 
        <div align="center"> 
          <?= $db->Record['classname']?>
           </div></td>
           <td><div align="center"> 
          <?= $db->Record['term']?>
        </div></td>
             <td><div align="center"> 
          <?= $db->Record['firstname']?>&nbsp;<?= $db->Record['lastname']?>
        </div></td>
      <td><div align="center"> <a href="###" onClick="MM_goToURL('self','modifygroup.php?gid=<?=$db->Record['idgroup']?>');return document.MM_returnValue">Go</a></div></td>
    </tr>
    <?php
	$count = !$count;
	}
?>
  </table>
  <p>
    <input name="Submit4" type="button" onClick="MM_goToURL('self','addgroup.php?type=<?= $type?>');return document.MM_returnValue" value="Add New Group">
  </p>
</center>
</body>
</html>
