<?php
session_start();

if ($_SESSION['loginname'] == null)
//	header("location:/compass/error_code.php?code=001"); 
	echo $_SESSION['loginname'];
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(8))
		header("location:/compass/error_code.php?code=004"); 
	else{		
		include "db_mysql_mt.inc"; 
			
		$db = new DB_Sql;
		
		$db->connect();
		$sql = "update ADDITIONALINFO set ";
		$description = $_REQUEST['description'];
		$sql = $sql."description='".($description)."'";
		$id = $_REQUEST['id'];
		$sql = $sql. " where idexample=".$id." and idconcept=0 and idtopic=0 and idunit=0";
		$query = $db->query($sql);
		
?>
<html>
<head>

<link rel="stylesheet"  href="../../css/compass.css" type="text/css" media=screen>
</head>

<body marginheight=0 marginwidth=0 topmargin=0 leftmargin=0>
<br>
<br>
<br>
<table width=528 cellspacing=1 cellpadding=4 border=0 align=center class=bgcolor5>
	<tr class=bgcolor2>
	<td align=center nowrap class=f14w> <b>[ Example Info ]</b>&nbsp; </td>
	</tr>
	<tr>
	<td colspan=2 height=150 align=center class=bgcolor1> <p> 
        <?= "Additional information of example ".$_REQUEST['ename']." info is updated successfully!<br> Click <a href='examplelist.php'>here</a> to continue"?>
        <br>
      </p>
	</td>
	</tr>
</table>

</body>
</html>
<? 
	}
}
?>