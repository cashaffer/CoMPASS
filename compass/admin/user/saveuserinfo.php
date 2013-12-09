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
		
		$uid = $_REQUEST['uid'];
		$usertype = $_REQUEST['utype'];
		$loginname = $_REQUEST['loginname'];
		$lastname = $_REQUEST['lastname'];
		$firstname = $_REQUEST['firstname'];
		$status = $_REQUEST['status'];
		
		$sql = "update user set loginname='".$loginname."',lastname='".$lastname."',firstname='".$firstname."',usertype=".$usertype.",status=".$status." where iduser=".$uid;
		
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
	<td align=center nowrap class=f14w>
	<b>[ User Info ]</b>&nbsp;
	</td>
	</tr>
	<tr>
	<td colspan=2 height=150 align=center class=bgcolor1> <p>
        <?= "User ".$loginname."'s info is updated successfully!<br> Click <a href='userlist.php?type=".$usertype."'>here</a> to continue"?>
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