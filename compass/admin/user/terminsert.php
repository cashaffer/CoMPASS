<?php
session_start();
if ($_SESSION['loginname'] == null)
	header("location:/compass/error_code.php?code=001"); 
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(8))
		header("location:/compass/error_code.php?code=004"); 
}	

include "db_mysql_mt.inc"; 
	
$db = new DB_Sql;

$db->connect();


$sql = "Insert into term(idterm,name) values (4, 'Fall 2005')";

$query = $db->query($sql);

$sql = "Insert into term(idterm,name) values (3, 'Fall 2005')";

$query = $db->query($sql);

$sql = "Insert into term(idterm,name) values (5, 'Spring 2005')";

$query = $db->query($sql);

?>
