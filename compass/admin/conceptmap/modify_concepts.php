<?php
session_start();
	include "priority.php";
	include "db_mysql_mt.inc"; 
			
		$db = new DB_Sql;
		$db->connect();
		$sql = "SELECT * FROM compass_mt.conceptintopic c where  description like '%/compass/student/%'";
		$db->query($sql);
		if($db->next_record()){	
			$desc = $db->Record['description'];
			$idconcept = $db->Record['idconcept'];
			$idtopic = $db->Record['idtopic'];
			echo $desc;
			echo $idconcept . "~" . $idtopic . "\n\n";
			$desc = str_replace("/compass/student/", "", $desc);			
			$sql = "update conceptintopic set description = '". mysql_escape_string($desc) . "' where idtopic=". $idtopic . " and idconcept = ". $idconcept;
			$db->query($sql);
			echo "-------------------------------------------------------\n";
			echo "-------------------------------------------------------\n";
//			echo $sql . "\n\n";
			echo $desc;
		}

?>


