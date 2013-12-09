<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>redirect page</title>
</head>
<?php
 session_start();
 $username='guest';
$_SESSION['loginname'] = $username;
header('Location:http://compassproject.net/compass/teacher/explore.php?uid=18');

?>
<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
