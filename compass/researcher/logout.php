<?php
session_start();
if ($_SESSION['loginname'] == null)
	header("location:/compass/error_code.php?code=001"); 
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(4))
		header("location:/compass/error_code.php?code=004"); 
}	

session_unset();
session_destroy();
?>
<script language="JavaScript" type="text/JavaScript">
alert("The exploration is ended. Thank you!");
parent.document.location="/";
</script>
