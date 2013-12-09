<?php

		include "db_mysql_mt.inc"; 
			
		$db = new DB_Sql;
		
		$db->connect();
		
		$name = $_REQUEST['Name'];
		$class = $_REQUEST['Class'];
		$teacher = $_REQUEST['Teacher'];
		$gender = $_REQUEST['Gender'];
		$answer="";
		for ($i = 1; $i <= 50; $i++) {
			$answer.=$_REQUEST["Q".$i];
		}
		
		$sql = "insert into SURVEY_ANSWER2006(studentname,gender,classname,teachername,takingtime,answer) values('"
			.$name."',".$gender.",'".$class."','".$teacher."',now(),'".$answer."')";
		
		$query = $db->query($sql);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<title>Done!</title>
</head>

<body>
<h1>Done! </h1>
</body>
</html>
