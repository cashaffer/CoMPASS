<?php
session_start();
if ($_SESSION['loginname'] == null)
	header("location:/compass/error_code.php?code=001"); 
//	echo $_SESSION['loginname'];
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(1))
		header("location:/compass/error_code.php?code=004"); 
	else{		
		include "db_mysql_mt.inc"; 
  		$idexploration=$_SESSION['idexploration'];
		$db = new DB_Sql;		
		$db->connect();
	$sql="select c.general_title cname,t.name tname,u.name uname,e.name ename,ld.idconcept idc,ld.idtopic idt,ld.idunit idu, ld.idexample ide from LOGDATA ld left join CONCEPT c on c.idconcept=ld.idconcept left join TOPIC t on ld.idtopic=t.idtopic left join UNIT u on ld.idunit=u.idunit left join EXAMPLE e on ld.idexample=e.idexample where ld.idexploration=".$idexploration." order by ld.time";
		$db->query($sql);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<link rel="stylesheet" href="../css/compass.css" type="text/css" media=screen>

<body>
After you read this page, think about your challenge. What are some concepts you should read about?<br>
<br>
Discuss with your friends what you will read.<br>
<br>
After your discussion, please close this window to resume your work on CoMPASS.
</body>
</html>
<?php		  	
	}
}
?>