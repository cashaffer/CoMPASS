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
		$rid = $_REQUEST['rid'];
		$rlevel = $_REQUEST['rlevel'];
		$description = $_REQUEST['description'];
		$sql = "select * from CONCEPTRELATION where conceptfrom=".$cid1." and conceptto=".$cid2." and idtopic=".$tid;
		$db->query($sql);
		if($db->next_record())
			header("location:/compass/error_code.php?code=005"); 
		else{
			$sql = "insert into CONCEPTRELATION set";
			$sql = $sql. " conceptfrom=".($cid1);
			$sql = $sql. ",conceptto=".($cid2);
			$sql = $sql. ",idtopic=".($tid);
			$sql = $sql. ",idrelation=".($rid);
			$sql = $sql. ",level=".($rlevel);
			if($description != null)
				$sql = $sql. ",description='".($description)."'";
			
			$query = $db->query($sql);
?>
<html>
<head>
<link rel="stylesheet"  href="../../css/compass.css" type="text/css" media=screen>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
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
        <?= "Concept_Relation is added successfully!<br> Click <a href='relationlist.php'>here</a> to continue"?>
        <br>
      </p>
	</td>
	</tr>
	<tr>
	<td align=center colspan=2 class=bgcolor3><input name="Submit" type="button" onClick="MM_goToURL('self','addrelation.php');return document.MM_returnValue" value="Continue to add Concept_Relation"> 
    </td>
	</tr>
</table>

</body>
</html>
<? 		}
	}
}
?>