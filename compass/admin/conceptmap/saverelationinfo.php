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
		$tid = $_REQUEST['tid'];
		$cid1 = $_REQUEST['cid1'];
		$cid2 = $_REQUEST['cid2'];
		$formercid1 = $_REQUEST['formercid1'];
		$formercid2 = $_REQUEST['formercid2'];
		$rid = $_REQUEST['rid'];
		$rlevel = $_REQUEST['rlevel'];
		$description = $_REQUEST['description'];
		$sql = "update CONCEPTRELATION set";
		$sql = $sql. " conceptfrom=".$cid1.",conceptto=".$cid2.",idtopic=".$tid.",idrelation=".$rid.",level=".$rlevel;
		if($description != null)
			$sql = $sql. ",description='".($description)."'";
			
		$sql = $sql. " where idtopic=".$tid." and conceptfrom=".$formercid1." and conceptto=".$formercid2;
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
	<td align=center nowrap class=f14w> <b>[ Concept_Relation Info ]</b>&nbsp; </td>
	</tr>
	<tr>
	<td colspan=2 height=150 align=center class=bgcolor1> <p> 
        <?= "Concept_Relation info is updated successfully!<br> Click <a href='relationlist.php'>here</a> to continue"?>
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