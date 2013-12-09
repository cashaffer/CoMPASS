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
		$idconcept = $_REQUEST['idconcept'];
		$idtopic = $_REQUEST['idtopic'];
		$description = $_REQUEST['description'];
		$sql = "select * from CONCEPTINTOPIC where idconcept=".$idconcept." and idtopic=".$idtopic;
		$db->query($sql);
		if($db->next_record())
			header("location:/compass/error_code.php?code=005"); 
		else{
			$sql = "insert into CONCEPTINTOPIC set";
			$sql = $sql. " idconcept=".($idconcept);
			$sql = $sql. ",idtopic=".($idtopic);
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
        <?= "Topic_Concept is added successfully!<br> Click <a href='tclist.php'>here</a> to continue"?>
        <br>
      </p>
	</td>
	</tr>
	<tr>
	<td align=center colspan=2 class=bgcolor3><input name="Submit" type="button" onClick="MM_goToURL('self','addtc.php');return document.MM_returnValue" value="Continue to add topic_concept"> 
    </td>
	</tr>
</table>

</body>
</html>
<? 		}
	}
}
?>