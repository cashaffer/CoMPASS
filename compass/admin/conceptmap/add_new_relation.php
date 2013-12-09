<?php
// For creating a new relation through ajax calls
// Usage: sendAJAXRequest("http://www.compassproject.net/compass/admin/conceptmap/add_new_relation.php?rname=my_new_relation")
// where  sendAJAXRequest is a function which does a GET request on its url param using xmlhttprequest object.
// The return text of this page is the ID of the relation that is presnetly created, or 0 if 
//     there is an error while creating a new relation. 
//     
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
		$r = mysql_real_escape_string($_REQUEST['rname']);
		$sql = "insert into relation (name) values (\"".$r."\")";

		$query = $db->query($sql);

		$db->query(
			"select idrelation from compass_mt.relation where ".
			"name=\"".$r."\"");
		$rid=0;
		if ($db->next_record())
			$rid = $db->Record['idrelation'];

	}
}
?>
<?=$rid?>

