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


$sql = "select * from CLASS where idclass=".$cid;

$query = $db->query($sql);
$db->next_record();
$status = $db->Record['status'];
$idteacher = $db->Record['idteacher'];
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
function check(){
	str=document.form1.classname.value;
	rtn = true;
	if(str == ""){
		alert("Please input Classname first!");
		form1.classname.focus();
		rtn=false;
	}
	else if(str.length<=2){
		alert("String you input is too short!");
		form1.classname.focus();
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
  <p><span class="tabletitle">Modify Class Info. </span> </p>
  <form name="form1" method="post" action="saveclassinfo.php"  onSubmit="return check()">
    <table width="75%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td width="48%"><div align="right">Class Name:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="48%"><input name="classname" type="text" value="<?= $db->Record['name']?>" size="15" maxlength="25"></td>
      </tr>
      <tr> 
        <td width="48%" height="22"> <div align="right">Description::</div></td>
        <td width="4%">&nbsp;</td>
        <td width="48%"><textarea name="description" cols="12" rows="5"><?= $db->Record['description']?></textarea></td>
      </tr>
      <tr> 
        <td height="22"> <div align="right">Teacher:</div></td>
        <td>&nbsp;</td>
        <td> <select name="teacher">
            <?php
	$sql = "select iduser,loginname,firstname,lastname from USER where usertype=2 order by loginname";

	$query = $db->query($sql);
	while($db->next_record()){
?>
            <option value="<?=$db->Record['iduser']?>" <?=($db->Record['iduser']==$idteacher)?"selected":""?>>
            <?=$db->Record['loginname']?>
            (
            <?=$db->Record['firstname']?>
            <?=$db->Record['lastname']?>
            )</option>
            <?php
	}
?>
          </select></td>
      </tr>
      <tr> 
        <td width="48%"><div align="right">Status:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="48%"><input name="status" type="radio" value="0" <?=($status==0?"checked":"")?>>
          Normal &nbsp;&nbsp; <input type="radio" name="status" value="1" <?=($status==1?"checked":"")?>>
          Halt</td>
      </tr>
    </table>
    <p> 
      <input type="hidden" name="cid" value="<?=$cid?>">
      <input type="submit" name="Submit" value="Submit">
      &nbsp;&nbsp; 
      <input name="Submit2" type="button" onClick="MM_goToURL('self','classlist.php?cid=<?=$cid?>');return document.MM_returnValue" value="Cancel">
  </form>
  </p>
</center>
</body>
</html>
