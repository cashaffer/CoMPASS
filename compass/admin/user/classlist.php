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
$type = $_REQUEST['type'];    
}

if(isset($_REQUEST['orderby'])){
$orderby = $_REQUEST['orderby'];}

if($orderby == null)
	$orderby = "name";

$sql = "select c.name name,c.description description,u.firstname firstname,u.lastname lastname,c.status status,c.idclass idclass from CLASS c,USER u where c.idteacher=u.iduser order by c.".$orderby;

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
  <p class="tabletitle">Class List </p>
  <table width="75%" border="1" cellspacing="0" cellpadding="0">
    <tr class="menutitle"> 
      <td width="12%"><a href="#" onClick="orderby('name');">Class Name</a></td>
      <td width="27%"><a href="#" onClick="orderby('idteacher');">Teacher</a></td>
      <td width="45%"><a href="#" onClick="orderby('description');">Description</a></td>
      <td width="9%"><a href="#" onClick="orderby('status');">Status</a></td>
      <td width="7%">Modify</td>
    </tr>
    <?php
	$bgcolor = "#FFFFDD";
	$count = true;
	while($db->next_record()){
		$bgcolor = ($count?"#FFFFFF":"#FFFFDD");
?>
    <tr bgcolor="<?= $bgcolor?>"> 
      <td height="22" class="tabletitle"> 
        <div align="center"> <a href="studentlist.php?cid=<?=$db->Record['idclass']?>&cname=<?= $db->Record['name']?>">
          <?= $db->Record['name']?>
          </a> </div></td>
      <td><div align="center"> 
          <?= $db->Record['firstname']?>&nbsp;<?= $db->Record['lastname']?>
        </div></td>
      <td><div align="center"> 
          <?= ($db->Record['description']==""?"&nbsp;":$db->Record['description'])?>
        </div></td>
      <td><div align="center"> 
          <?= (($db->Record['status']==0)?"Normal":"Frozen")?>
        </div></td>
      <td><div align="center"> <a href="###" onClick="MM_goToURL('self','modifyclass.php?cid=<?=$db->Record['idclass']?>');return document.MM_returnValue">Go</a></div></td>
    </tr>
    <?php
	$count = !$count;
	}
?>
  </table>
  <p>
    <input name="Submit3" type="button" onClick="MM_goToURL('self','addclass.php?type=<?= $type?>');return document.MM_returnValue" value="Add New Class">
  </p>
</center>
</body>
</html>
