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
			
		$db = new DB_Sql;
		
		$db->connect();
		$sql = "insert into EXPLORATION set";
		$idclass = $_REQUEST['idclass'];
		$_SESSION['idclass'] = $idclass; 
		$goal = mysql_real_escape_string($_REQUEST['goal']);
		$_SESSION['goal'] = $goal; 
		$place = $_REQUEST['place'];
		$_SESSION['place'] = $place; 
		$question = $_REQUEST['question'];
		$_SESSION['question'] = $question;
		$leader = mysql_real_escape_string($_REQUEST['leader']);
		$other_students = mysql_real_escape_string($_REQUEST['other_students']);
		$notebook_page = mysql_real_escape_string($_REQUEST['notebook_page']);
		$_SESSION['leader'] = $leader;

		if (isset($_REQUEST['activity'])) {
			$activity = $_REQUEST['activity'];
		}
		else {
			$activity = 0;
		}
		$_SESSION['activity'] = $activity; 
	

		$sql = $sql. " idstudent=".$_SESSION['iduser'];
		$idclass = $_REQUEST['idclass'];
		$sql = $sql. ",idclass=".$idclass;
		$place = $_REQUEST['place'];
		$sql = $sql. ",place=".$place;
		$sql = $sql. ",idactivity=".$activity;
		$sql = $sql. ",time=now()";
		$goal = $_REQUEST['goal'];
		$sql = $sql. ",goal=".$goal;
		$question = $_REQUEST['question'];
		if($question != null) {
			if ($question == 'Other' and $_REQUEST['question_other'] != null) { 
				$question .= ': ' . $_REQUEST['question_other'];
			}
			$sql = $sql. ",question='".$question."'";
		}
		if($leader != null)
			$sql = $sql. ",leader='".$leader."'";
		if($other_students != null)
			$sql = $sql. ",other_students ='".$other_students."'";
		if($notebook_page != null)
			$sql = $sql. ",notebook_page='".$notebook_page."'";
		
		$sql = $sql. ",ip='". mysql_real_escape_string($_SERVER['REMOTE_ADDR']) .";". 
			mysql_real_escape_string($_SERVER['HTTP_USER_AGENT']) ."'";


		$db->query($sql);
		$sql="select max(idexploration) eid from EXPLORATION where idstudent=".$_SESSION['iduser'];
		$db->query($sql);
		if($db->next_record()){
			$_SESSION['idexploration'] = $db->Record['eid'];
		}
		header("location:/compass/student/selectunit.php"); 
	}
}
?>
