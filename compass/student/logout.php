<?php

session_start();
if ($_SESSION['loginname'] == null)
	header("location:/compass/error_code.php?code=001"); 
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(1))
		header("location:/compass/error_code.php?code=004"); 
}	

include "db_mysql_mt.inc"; 
include "config_mt.inc"; 

//if ($_SESSION['loginname'] == 'test') {
//	echo "<script>window.open(\"prompts2.php\", \"prompts\", 'width=400, height=300, left=400, top=200, toolbar=0, resizable=0');</script>";
//}
//if not Liz Core 2 or Greg Core 3 2012
				
if ($_SESSION['idclass'] != 194 && $_SESSION['idclass'] != 198) {
	echo "<script>window.open(\"navgraph.php\", \"prompts\", 'width=1050, height=600');</script>";
}
$db = new DB_Sql;

$db->connect();

$idexploration = $_SESSION['idexploration'];

		$sql = "select (UNIX_TIMESTAMP()-UNIX_TIMESTAMP(max(time))) timelength,max(time) lasttime,now() nowtime from LOGDATA where idexploration=".$idexploration;
		$db->query($sql);
		if($db->next_record()){
			$timelength=$db->Record['timelength'];
			$lasttime=$db->Record['lasttime'];
			$nowtime=$db->Record['nowtime'];
			if($timelength != null){
				$sql = "update LOGDATA set timelength=".$timelength.",endtime='".$nowtime."' where idexploration=".$idexploration." and time='".$lasttime."'";
				$db->query($sql);
			}
		}



$wait = 10;
if(isset($_SESSION['timeout'])) {
	$session_life = time() - $_SESSION['timeout'];
	if ($session_life > $wait) {
		session_unset();
		session_destroy();
	}
}
$_SESSION['timeout'] = time();
?>
<script language="JavaScript" type="text/JavaScript">
parent.document.location="/";
</script>
