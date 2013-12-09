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
		
		$iduser = $_REQUEST['iduser'];
		$idclass = $_REQUEST['idclass'];
		if($iduser != null){
			foreach ($iduser as $uid){	
				$sql = "insert into TAKESCLASS(idclass,idstudent) values("
					.$idclass.",".$uid.")";			
				$query = $db->query($sql);
			}
		}
		else
			header("location:studentlist.php?cid=".$idclass); 
		
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
	<td align=center nowrap class=f14w> <b>[ Class Info ]</b>&nbsp; </td>
	</tr>
	<tr>
	<td colspan=2 height=150 align=center class=bgcolor1> <p>
        <?= "Students are added successfully to the class!<br> Click <a href='studentlist.php?cid=".$idclass."'>here</a> to continue"?>
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