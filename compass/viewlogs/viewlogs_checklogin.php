<?php
session_start();

include "db_mysql_mt.inc"; 

function dispatchPage($utype){		//For now, we ignore the situation that one user has 2 more types.
	if (($utype&1) == 1)		//go to student's main page
		header("location:./student/purpose.php"); 
	else if(($utype&2) == 2)	//go to teacher's main page
		header("location:./teacher/selectunit.php"); 
	else if(($utype&4) == 4)	//go to researcher's main page
		header("location:./researcher/selectunit.php"); 
	else if(($utype&8) == 8)	//go to admin's main page
		header("location:./admin/panel.php"); 
	else				//go to anonymous user's main page
		header("location:./anonym/panel.php"); 
}
	
$db = new DB_Sql;

$db->connect();

$sql = "select iduser,passwd,usertype from USER where loginname='".$_REQUEST['username']."' and passwd='".$_REQUEST['password']."'";

$query = $db->query($sql);

if($db->next_record()) {
	if ($db->Record['usertype'] == 2) {
		$_SESSION['iduser'] = $db->Record['iduser'];
		$_SESSION['loginname'] = $_REQUEST['username'];
		$_SESSION['usertype'] = $db->Record['usertype'];		
		header("location:logs.php"); 	
	} else {
		echo "<center><br/><br/><b> Oops, you are not listed as a teacher. <br/>If this is an error, please mail Balaji at `g<span>@</span>wi<span>sc</span>.edu` to add your name. </b></center>";
	} 
} else {
	echo "<center><br/><br/><b> Oops, wrong username / password. <br/><a href='/compass/viewlogs'>Try again</a>. </b></center>";
}
?>



