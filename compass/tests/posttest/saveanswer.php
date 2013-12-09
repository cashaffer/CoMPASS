<?php

		include "db_mysql_mt.inc"; 
			
		$db = new DB_Sql;
		
		$db->connect();
		
		$name = $_REQUEST['Name'];
		$teacher = $_REQUEST['Teacher'];
		$classname = $_REQUEST['Class'];
		$gender = $_REQUEST['Gender'];
$Q1	=$_REQUEST['Q1'];  
$Q2a    =$_REQUEST['Q2a']; 
$Q2b    =$_REQUEST['Q2b']; 
$Q3a    =$_REQUEST['Q3a']; 
$Q3b    =$_REQUEST['Q3b']; 
$Q4    =$_REQUEST['Q4']; 
$Q5     =$_REQUEST['Q5'];  
$Q6     =$_REQUEST['Q6'];  
$Q7     =$_REQUEST['Q7'];  
$Q8     =$_REQUEST['Q8'];  
$Q9a     =$_REQUEST['Q9a'];  
$Q9b     =$_REQUEST['Q9b'];  
$Q10    =$_REQUEST['Q10']; 
$Q11a    =$_REQUEST['Q11a']; 
$Q11b    =$_REQUEST['Q11b']; 
$Q12   =$_REQUEST['Q12']; 
$Q13a  =$_REQUEST['Q13a'];
$Q13b  =$_REQUEST['Q13b'];
$Q14   =$_REQUEST['Q14']; 
$Q15   =$_REQUEST['Q15']; 
		
		$sql = "insert into POSTTEST_ANSWER2006(studentname,gender,teachername,classname,takingtime,Q1,Q2a,Q2b,Q3a,Q3b,Q4,Q5,Q6,Q7,Q8,Q9a,Q9b,Q10,Q11a,Q11b,Q12,Q13a,Q13b,Q14,Q15) values('"
			.$name."',".$gender.",'".$teacher."','".$classname."',now(),".$Q1.",".$Q2a.",'".$Q2b."',".$Q3a.",'".$Q3b."',".$Q4.",".$Q5.",'".$Q6."',".$Q7.",".$Q8.",".$Q9a.",'".$Q9b."',".$Q10.",".$Q11a.",'".$Q11b."',".$Q12.",".$Q13a.",'".$Q13b."',".$Q14.",".$Q15.")";
		
		$query = $db->query($sql);
?>
<script Language="Javascript" Type="text/Javascript" >
this.location.href="navigation.php?Name=<?=$name?>&Class=<?=$classname?>&Teacher=<?=$teacher?>&Gender=<?=$gender?>";
</script>