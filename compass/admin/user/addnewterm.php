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

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Add New Term</title>
<script language="JavaScript" type="text/JavaScript">

<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->


</script>

</head>
<link rel="stylesheet"  href="../../css/compass.css" type="text/css" media=screen>
<body>
<center>
<p>&nbsp;</p>
  <p><span class="tabletitle">Add New Term. </span> </p>
  <form name="form1" method="post" action="saveterminfo.php"  onSubmit="return check()">
    <table width="75%" border="0" cellspacing="0" cellpadding="0">
          
      <tr> 
        <td height="22"> <div align="center">Enter Term Name:</div></td>
        <td>&nbsp;</td>
        <td>
            <input name="term" type="text" id="text"></input>
</td>
</table>
    <p> 
            <input type="submit" name="Submit" value="Submit">
      &nbsp;&nbsp; 
      <input name="Submit2" type="button" onClick="MM_goToURL('self','termlist.php');return document.MM_returnValue" value="Cancel">
  </form>
  </p>
</center>
</body>
</html>


