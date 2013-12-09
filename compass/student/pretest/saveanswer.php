<?php

		include "db_mysql_mt.inc"; 
			
		$db = new DB_Sql;
		
		$db->connect();
		
		$name = $_REQUEST['Name'];
		$class = $_REQUEST['Class'];
		$teacher = $_REQUEST['Teacher'];
		$gender = $_REQUEST['Gender'];
$Q1	=$_REQUEST['Q1'];  
$Q2a    =$_REQUEST['Q2a']; 
$Q2b    =$_REQUEST['Q2b']; 
$Q3a    =$_REQUEST['Q3a']; 
$Q3b    =$_REQUEST['Q3b']; 
$Q4a    =$_REQUEST['Q4a']; 
$Q4b    =$_REQUEST['Q4b']; 
$Q5     =$_REQUEST['Q5'];  
$Q6     =$_REQUEST['Q6'];  
$Q7     =$_REQUEST['Q7'];  
$Q8     =$_REQUEST['Q8'];  
$Q9     =$_REQUEST['Q9'];  
$Q10    =$_REQUEST['Q10']; 
$Q11    =$_REQUEST['Q11']; 
$Q12   =$_REQUEST['Q12']; 
$Q13a  =$_REQUEST['Q13a'];
$Q13b  =$_REQUEST['Q13b'];
$Q14   =$_REQUEST['Q14']; 
$Q15   =$_REQUEST['Q15']; 
$Q16   =$_REQUEST['Q16']; 
$Q17   =$_REQUEST['Q17']; 
		
		$sql = "insert into PRETEST_ANSWER(studentname,gender,classname,teachername,takingtime,Q1,Q2a,Q2b,Q3a,Q3b,Q4a,Q4b,Q5,Q6,Q7,Q8,Q9,Q10,Q11,Q12,Q13a,Q13b,Q14,Q15,Q16,Q17) values('"
			.$name."',".$gender.",'".$class."','".$teacher."',now(),".$Q1.",".$Q2a.",'".$Q2b."',".$Q3a.",'".$Q3b."',".$Q4a.",'".$Q4b."',".$Q5.",".$Q6.",'".$Q7."',".$Q8.",".$Q9.",".$Q10.",".$Q11.",".$Q12.",".$Q13a.",'".$Q13b."',".$Q14.",".$Q15.",".$Q16.",".$Q17.")";
		
		$query = $db->query($sql);
?>
<script Language="Javascript" Type="text/Javascript" >
this.location.href="attitude_test.php?Name=<?=$name?>&Class=<?=$class?>&Teacher=<?=$teacher?>&Gender=<?=$gender?>";
</script>