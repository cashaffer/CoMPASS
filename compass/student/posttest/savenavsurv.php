<?php

		include "db_mysql_mt.inc"; 
			
		$db = new DB_Sql;
		
		$db->connect();
		
		$name = $_REQUEST['Name'];
		$class = $_REQUEST['Class'];
		$teacher = $_REQUEST['Teacher'];
		$gender = $_REQUEST['Gender'];
		$answer="";
		for ($i = 1; $i <= 31; $i++) {
			$answer.=$_REQUEST["Q".$i];
		}
		$Q32 = $_REQUEST['Q32'];
		$Q33 = $_REQUEST['Q33'];
		$sql = "insert into SURVEY_NAVIGATION(studentname,gender,classname,teachername,takingtime,answer,Q32,Q33) values('"
			.$name."',".$gender.",'".$class."','".$teacher."',now(),'".$answer."','".$Q32."','".$Q33."')";
		
		$query = $db->query($sql);
?>
<script language="JavaScript" type="text/JavaScript">
this.location.href="/";
</script>
