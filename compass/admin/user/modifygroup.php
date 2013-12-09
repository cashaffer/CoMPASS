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
$gid = $_REQUEST['gid'];


$sql = "select * from STUDYGROUP where idgroup=".$gid;

$query = $db->query($sql);
$db->next_record();
$status = $db->Record['status'];
if(isset($db->Record['idteacher'])){
$idteacher = $db->Record['idteacher'];}
else {
    $idteacher = null;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Modify Group</title>
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
		form1.classname.focus();
		rtn=false;
	}
	else if(str.length<=2){
		alert("String you input is too short!");
		form1.groupname.focus();
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
  <p><span class="tabletitle">Modify Group Info. </span> </p>
  <form name="form1" method="post" action="savegroupinfo.php"  onSubmit="return check()">
    <table width="75%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td width="48%"><div align="right">Group Name:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="48%"><input name="groupname" type="text" value="<?= $db->Record['name']?>" size="15" maxlength="25"></td>
      </tr>
      <tr> 
        <td width="48%" height="22"> <div align="right">Description::</div></td>
        <td width="4%">&nbsp;</td>
        <td width="48%"><textarea name="description" cols="12" rows="5"><?= $db->Record['description']?></textarea></td>
      </tr>
     <tr> 
        <td height="22"> <div align="right">Term:</div></td>
        <td>&nbsp;</td>
        <td> <select name="term">
            <?php
	$sql = "select idterm,name from TERM order by name";

	$query = $db->query($sql);
	while($db->next_record()){
?>
            <option value="<?=$db->Record['idterm']?>">
            <?=$db->Record['name']?>
           
            </option>
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
      <input type="hidden" name="gid" value="<?=$gid?>">
      <input type="submit" name="Submit" value="Submit">
      &nbsp;&nbsp; 
      <input name="Submit5" type="button" onClick="MM_goToURL('self','grouplist.php?gid=<?=$gid?>');return document.MM_returnValue" value="Cancel">
  </form>
  </p>
</center>
</body>
</html>
