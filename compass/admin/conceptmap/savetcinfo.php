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
		$sql = "update CONCEPTINTOPIC set";
		$idtopic = $_REQUEST['idtopic'];
		$sql = $sql. " idtopic=".($idtopic).",";
		$description = $_REQUEST['description'];
		if($description != null)
			$sql = $sql. "description='".($description)."'";
			
		$formeridtopic = $_REQUEST['formeridtopic'];
		$idconcept = $_REQUEST['idconcept'];
		$sql = $sql. " where idtopic=".$formeridtopic." and idconcept=".$idconcept;
//		echo $sql;
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
	<td align=center nowrap class=f14w> <b>[ Topic_Concept Info ]</b>&nbsp; </td>
	</tr>
	<tr>
	<td colspan=2 height=150 align=center class=bgcolor1> <p> 
        <?= "Topic_Concept info is updated successfully!<br> Click <a href='tclist.php'>here</a> to continue"?>
        <br>
      </p>
	</td>
	</tr>
	<tr>
	<td align=center colspan=2 class=bgcolor3>&nbsp; </td>
	</tr>
</table>

</body>
</html>
<? 
	}
}
?>