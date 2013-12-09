<?php
session_start();
if ($_SESSION['loginname'] == null)
	header("location:/compass/error_code.php?code=001"); 
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(8))
		header("location:/compass/error_code.php?code=004"); 
	else{		
		include "db_mysql_mt.inc"; 
			
		$db = new DB_Sql;		
		$db->connect();
		$id = $_REQUEST['id'];
		$sql = "select name from EXAMPLE where idexample=".$id;
		$query = $db->query($sql);
		if($db->next_record()){	
			$name = $db->Record['name'];
			$sql = "select description from ADDITIONALINFO where idexample=".$id." and idtopic=0 and idconcept=0 and idunit=0";
			$db->query($sql);
			$db->next_record();
			$description = $db->Record['description'];

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
  <p>&nbsp; </p>
  <p><span class="tabletitle">Edit additional Infomation from DL</span> </p>
  <form name="form1" method="post" action="saveexampleinfo.php"  onSubmit="return check()">
    <table width="75%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td width="33%"><div align="right">Unit Name:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="63%"><?= ($name==null)?"":htmlentities($name)?> 
        </td>
      </tr>
      <tr> 
        <td><div align="right">Description <font color="#FF0000">*</font></div></td>
        <td>&nbsp;</td>
        <td><textarea name="description" cols="50" rows="6"><?= ($description==null)?"":htmlentities($description)?></textarea> 
        </td>
      </tr>
    </table>
    <input type="hidden" name="id" value="<?=$id?>">
    <input type="hidden" name="ename" value="<?=htmlentities($name)?>">
    <p>
    <input type="submit" name="Submit" value="Submit">
  </form>
  </p>
</center>
</body>
</html>
<? }
  }
}
?>