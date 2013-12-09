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
		
		$sql = "insert into SURVEY_ANSWER(studentname,gender,classname,teachername,takingtime,answer) values('"
			.$name."',".$gender.",'".$class."','".$teacher."',now(),'".$answer."')";
		
		$query = $db->query($sql);
?>
<script language="JavaScript" type="text/JavaScript">
this.location.href="/";
</script>
