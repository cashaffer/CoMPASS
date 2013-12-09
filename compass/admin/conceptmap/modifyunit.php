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
		$sql = "select * from Unit where idunit=".$id;
		$query = $db->query($sql);
		if($db->next_record()){	

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
	str=document.form1.general_title.value;
	desc=document.form1.educational_description.value;
	rtn = true;
	if(str == ""){
		alert("Please input Concept Name first!");
		form1.general_title.focus();
		rtn=false;
	}
	else if(desc == ""){
		alert("Please input Educational Description!");
		form1.educational_description.focus();
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
  <p><span class="tabletitle">Modify Unit</span> </p>
  <form name="form1" method="post" action="saveunitinfo.php"  onSubmit="return check()">
    <table width="75%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td width="33%"><div align="right">Unit Name <font color="#FF0000">*</font>:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="63%"><input name="unitname" type="text" value="<?= ($db->Record['name']==null)?"":htmlentities($db->Record['name'])?>" size="50" maxlength="250"> 
        </td>
      </tr>
      <tr> 
        <td><div align="right">Description <font color="#FF0000">*</font></div></td>
        <td>&nbsp;</td>
        <td><textarea name="description" cols="50" rows="6"><?= ($db->Record['description']==null)?"":htmlentities($db->Record['description'])?></textarea> 
        </td>
      </tr>
    </table>
    <input type="hidden" name="id" value="<?=$id?>">
    <p>
    <input type="submit" name="Submit" value="Submit">
  </form>
  </p>
</center>
</body>
</html>
<?php }
  }
}
?>