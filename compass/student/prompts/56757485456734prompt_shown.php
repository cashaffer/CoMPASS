<?
session_start();


		include "db_mysql_mt.inc"; 
		$db = new DB_Sql;		
		$db->connect();
		$p = $_REQUEST['p'];
		$e = $_REQUEST['e'];
		$r = $_REQUEST['r'];
		$sql = "insert into prompts_shown values($e, $r, $p)";
		$result = $db->query($sql);
echo "hello!"

?>
