<?php
session_start();

if ($_SESSION['loginname'] == null)
	header("location:/compass/error_code.php?code=001"); 
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(8))
		header("location:/compass/error_code.php?code=004"); 
	else {
	?>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Administrator's Panel</title>
	</head>
	
	<frameset rows="80,*" cols="*" frameborder="NO" border="0" framespacing="0">
	  <frame src="Top.htm" name="topFrame" scrolling="NO" noresize >
	  <frameset cols="160,*" frameborder="NO" border="0" framespacing="0">
	    <frame src="menu.php" name="leftFrame" scrolling="NO" noresize>
	    <frame src="right.php" name="mainFrame">
	  </frameset>
	</frameset>
	<noframes><body>
	
	</body></noframes>
	</html>
	<?php
	}
}
?>