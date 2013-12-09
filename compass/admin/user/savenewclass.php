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
		
		$name = $_REQUEST['classname'];
		$description = $_REQUEST['description'];
		$idteacher = $_REQUEST['teacher'];
		$status = $_REQUEST['status'];
		
		$sql = "insert into CLASS(name,description,idteacher,status) values('"
			.$name."','".$description."',".$idteacher.",".$status.")";
		
		$query = $db->query($sql);

		// now get the new id for this added class
		$sql = "select idclass from CLASS c where c.name='" . $name . "' and c.idteacher=" . $idteacher ;
		$query = $db->query($sql);
		$row = mysql_fetch_row($query);
		$idclass = $row[0];

		// associate default units with this class
		$default_units = array(11, 18);
		for ($i = 0, $sz = count($default_units); $i < $sz; ++$i) {
			$sql = "insert into CLASS_TO_UNIT(idclass, idunit) values(" . $idclass . "," . $default_units[$i] . ")";
			$query = $db->query($sql);
		}
		
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
        <?= "Class ".$name." is added successfully!<br> Click <a href='classlist.php'>here</a> to continue"?>
        <br>
      </p>
	</td>
	</tr>
	<tr>
	<td align=center colspan=2 class=bgcolor3><input name="Submit" type="button" onClick="MM_goToURL('self','addclass.php');return document.MM_returnValue" value="Continue to add user"> 
    </td>
	</tr>
</table>

</body>
</html>
<? 
	}
}
?>
