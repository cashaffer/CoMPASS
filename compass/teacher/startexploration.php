<?php
session_start();

if ($_SESSION['loginname'] == null)
	header("location:/compass/error_code.php?code=001"); 
//	echo $_SESSION['loginname'];
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(2))
		header("location:/compass/error_code.php?code=004"); 
	else{		
		include "db_mysql_mt.inc"; 
			
		$db = new DB_Sql;
		
		$db->connect();
		$sql = "insert into EXPLORATION set";
		$idclass = $_REQUEST['idclass'];
		$goal = $_REQUEST['goal'];
		$place = $_REQUEST['place'];
		$question = $_REQUEST['question'];
		$leader = $_REQUEST['leader'];
		$sql = $sql. " idstudent=".$_SESSION['iduser'];
		$idclass = $_REQUEST['idclass'];
		$sql = $sql. ",idclass=".$idclass;
		$place = $_REQUEST['place'];
		$sql = $sql. ",place=".$place;
		$sql = $sql. ",time=now()";
		$goal = $_REQUEST['goal'];
		$sql = $sql. ",goal=".$goal;
		$question = $_REQUEST['question'];
		if($question != null)
		$sql = $sql. ",question='".$question."'";
		if($leader != null)
		$sql = $sql. ",leader='".$leader."'";
		
		$db->query($sql);
		$sql="select max(idexploration) eid from EXPLORATION where idstudent=".$_SESSION['iduser'];
		$db->query($sql);
		if($db->next_record()){
			$_SESSION['idexploration'] = $db->Record['eid'];
		}
		header("location:selectunit.php"); 
	}
}
?>
