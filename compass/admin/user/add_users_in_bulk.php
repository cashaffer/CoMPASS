<?php
session_start();
if ($_SESSION['loginname'] == null)
	header("location:/compass/error_code.php?code=001"); 
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(8))
		header("location:/compass/error_code.php?code=004"); 
}	
$type = $_REQUEST['type'];
$typenames = array(1 => "Student", 2 => "Teacher", 4 => "Researcher", 8 => "Administrator");

?>
<html>
<head>
<title>Add users in bulk</title>
<script type="text/javascript">
function showusernames() {
	var str = getnormalizedusernames();
	alert(str.replace(',', '\n', 'g'));
	return false;
}
var allowableChars = ",1234567890abcdefghijklmnopqrstuvwxyz"
function getnormalizedusernames() {
	var unames = document.getElementById("unames_ta").value;
	var str = unames.split('');
	var retstr = '';
	for (var i=0; i<str.length; i++) {
		var ch = str[i].toLowerCase();
		if (allowableChars.indexOf(ch) >= 0) {
			retstr += ch;
		}
	}
	return retstr;
}
function checkusernames() {
	var hiddeninput = document.getElementById("usernames");
	hiddeninput.value = getnormalizedusernames();
	return true;
}

</script>
</head>
<link rel="stylesheet"  href="../../css/compass.css" type="text/css" media=screen>
<body>
<center>
	<form name="form1" method="post" action="save_users_in_bulk.php" onsubmit="return checkusernames()">
	<b>Type the usernames in the textbox below, each username separated by a comma. The password will be set as the username itself.</b><br/>
	<textarea id="unames_ta" rows=10 cols=30></textarea><br/>
	(Optional: To see what usernames will be created, press this button: )<button style="font-size:x-small;" id="check" onclick="return showusernames()">See usernames</button>
	<input type="hidden" name="usernames" id="usernames" value=""/>
  <input type="hidden" name="utype" value="<?=$type?>">
	<br/><br/>
	<input type="submit" name="submit" value="Submit"/>
	</form>
</center>
</body>
</html>
