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
$sql = "select idconcept,general_title from CONCEPT order by general_title";
$db->query($sql);
$db1 = new DB_Sql;
$db1->connect();
$sql = "select t.idtopic tid,t.name tname,u.name uname from TOPIC t,UNIT u where t.idunit=u.idunit order by u.name,t.name";
$db1->query($sql);
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
	MM_goToURL('self','userlist.php?type=<?= $type?>&orderby='+column);
	return document.MM_returnValue;
}
function check(){
	desc=document.form1.description.value;
	rtn = true;
	if(desc == ""){
		alert("Please input Description!");
		form1.description.focus();
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
  <p><span class="tabletitle">Add a New Topic_Concept</span> </p>
  <form name="form1" method="post" action="savenewtc.php"  onSubmit="return check()">
    <table width="75%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td width="33%"><div align="right">Concept <font color="#FF0000">*</font>:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="63%"><select name="idconcept">
            <?
	while($db->next_record()){
?>
            <option value="<?= $db->Record['idconcept']?>">
            <?= $db->Record['general_title']?>
            </option>
            <?
	}
?>
          </select> </td>
      </tr>
      <tr>
        <td><div align="right">Topic <font color="#FF0000">*</font></div></td>
        <td>&nbsp;</td>
        <td><select name="idtopic">
<?
	while($db1->next_record()){
?>
            <option value="<?= $db1->Record['tid']?>"><?= $db1->Record['uname']?> =&gt;<?= $db1->Record['tname']?> </option>
<?
	}
?>
          </select></td>
      </tr>
      <tr> 
        <td><div align="right">Description:</div></td>
        <td>&nbsp;</td>
				<td><textarea name="description" cols="100" rows="30"><content><p>
</p></content></textarea> </td>
      </tr>
    </table>
    <p>
    <input type="submit" name="Submit" value="Submit">
  </form>
  </p>
</center>
</body>
</html>
