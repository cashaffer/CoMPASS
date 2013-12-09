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
$type = $_REQUEST['type'];
$typenames = array(1 => "Student", 2 => "Teacher", 4 => "Researcher", 8 => "Administrator");

include "db_mysql_mt.inc"; 
	
$db = new DB_Sql;

$db->connect();
$sql2 = "select u.iduser iduser,u.loginname loginname,u.firstname firstname,u.lastname lastname from USER u where usertype=2 order by loginname";

$sql="select distinct t.name termname, t.idterm idterm from TERM t order by termname";

$query = $db->query($sql);

$sql1="select c.name classname,c.idclass idclass, u.loginname username from CLASS c,USER u where u.iduser=c.idteacher order by c.name,u.loginname";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Add Groups</title>
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
function check(){
	str=document.form1.groupname.value;
	rtn = true;
	if(str == ""){
		alert("Please input Groupname first!");
		form1.groupname.focus();
		rtn=false;
	}
	else if(str.length<=2){
		alert("String you input is too short!");
		form1.gropname.focus();
		rtn=false;
	}
	else
		rtn = true;
	return rtn;
}
</script>
</head>
<link rel="stylesheet"  href="../../css/compass.css" type="text/css" media=screen>
<body>
<center>
<p>&nbsp;</p>
  <p><span class="tabletitle">Add a New Group </span> </p>
  
  <form name="form1" method="post" action="savenewgroup.php"  onSubmit="return check()">
  
    <table width="75%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td width="48%"><div align="right"> Group Name:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="48%"><input name="groupname" type="text" size="15" maxlength="30"></td>
      </tr>
      <tr> 
        <td height="22"> <div align="right">Term</div></td>
        <td>&nbsp;</td>
        <td> <select name="Term">
            <?php
	while($db->next_record()){
?>
            <option value="<?=$db->Record['idterm']?>">
            <?=$db->Record['termname']?>
            </option>
            <?php
}
?>
          </select> </td>
      </tr>
      <tr> 
        <td height="22"> <div align="right">Class Name</div></td>
        <td>&nbsp;</td>
        <td> <select name="classname">
            <?php
	$query = $db->query($sql1);
	while($db->next_record()){
?>
            <option value="<?=$db->Record['idclass']?>">
            <?=$db->Record['classname']?> (teacher: <?=$db->Record['username']?>)
            </option>
            <?php
}
?>
          </select> </td>
      </tr>
      <tr> 
        <td width="48%" height="22"> <div align="right">Description::</div></td>
        <td width="4%">&nbsp;</td>
        <td width="48%"><textarea name="description" cols="12" rows="5"></textarea></td>
      </tr>
      <tr> 
        <td width="48%"><div align="right">Status:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="48%"><input name="status" type="radio" value="0" checked>
          Normal &nbsp;&nbsp; <input type="radio" name="status" value="1">
          Halt</td>
      </tr>
    </table>
    <p> 
      <input type="submit" name="Submit" value="Submit">
      &nbsp;&nbsp; 
      <input name="Submit2" type="button" onClick="MM_goToURL('self','grouplist.php');return document.MM_returnValue" value="Cancel">
  </form>
  </p>
</center>
</body>
</html>
