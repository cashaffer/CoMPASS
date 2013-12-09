<?php
session_start();

if ($_SESSION['loginname'] == null)
//	header("location:/compass/error_code.php?code=001"); 
	echo $_SESSION['loginname'];
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(8))
		header("location:/compass/error_code.php?code=004"); 
	else{		
		include "db_mysql_mt.inc"; 
			
		$db = new DB_Sql;
		
		$db->connect();

		/*
		// PWSP10(Letter A-D)(Numbers 01-10)(Letter F or B)
		$str = array('a', 'b', 'c', 'd');
		for ($j=0; $j<=4; $j++) {
			$ch = $str[$j];
		for ($i=1; $i<=10; $i++) {
			$uname = "pwsp10$ch$i"."f";
			$sql = "insert into user(loginname,lastname,firstname,passwd,usertype,status) values('$uname', '$uname', '$uname', '$uname', 1, 0)";
			$result = $db->query($sql);
			if (!$result) {
				echo "could not create user $uname<br>" . mysql_error();
				exit;
			} else {
				echo "$uname<br>";
			}

			$uname = "pwsp10$ch$i"."b";
			$sql = "insert into user(loginname,lastname,firstname,passwd,usertype,status) values('$uname', '$uname', '$uname', '$uname', 1, 0)";
			$result = $db->query($sql);
			if (!$result) {
				echo "could not create user $uname<br>" . mysql_error();
				exit;
			} else {
				echo "$uname<br>";
			}
		} // for i
		} // for j
		 */
		$arr1 = array("blue", 'orange', 'green', 'yellow', 'black', 'red');
		$arr2 = array(1111, 2222);
		for ($i=0; $i<count($arr1); $i++) {
		for ($j=0; $j<count($arr2); $j++) {
			$uname = "".$arr1[$i] . $arr2[$j];
			$sql = "insert into user(loginname,lastname,firstname,passwd,usertype,status) values('$uname', '$uname', '$uname', '$uname', 1, 0)";
			$result = $db->query($sql);
			if (!$result) {
				echo "could not create user $uname<br>" . mysql_error();
				exit;
			} else {
				echo "$uname<br>";
			}
		} // j
		} // i

	}
}
?>

