<?php

//$domain = $_SERVER["SERVER_NAME"];
//echo $_SERVER["SERVER_NAME"] . "~" . $_SERVER["REQUEST_URI"] ."~". strpos($domain, "www."). '~'. str_replace("www.", "", $domain);
//if (strpos($domain, "www.") === 0) {
//	echo "redirecting";
//return;
//	$newdomain = str_replace("www.", "", $domain);
//	header("location:http://" . $newdomain . $_SERVER["REQUEST_URI"]);
//}

session_start();
include "db_mysql_mt.inc"; 

function dispatchPage($utype){		//For now, we ignore the situation that one user has 2 more types.

     if (  strpos( $_REQUEST['username'] , 'list') !== false) {
		header("location:../compassstatic/student/purpose.php"); 
	} else {
	
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
}
	
$db = new DB_Sql;

$db->connect();

$sql = "select iduser,passwd,usertype from USER where loginname='".$_REQUEST['username']."'";

$query = $db->query($sql);

if($db->next_record()) {
	if($db->Record['passwd'] == $_REQUEST['password']){
		$_SESSION['iduser'] = $db->Record['iduser'];
		$_SESSION['loginname'] = $_REQUEST['username'];
		$_SESSION['usertype'] = $db->Record['usertype'];
		$_SESSION['clicks'] = 0;
		$_SESSION['totalclicks'] = 0;				
		dispatchPage( $_SESSION['usertype'] );
	}
	else
		header("location:error_code.php?code=002"); 
}
else
	header("location:error_code.php?code=003"); 
	

?>
