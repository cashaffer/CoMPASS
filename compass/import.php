<?php
		include "db_mysql_mt.inc"; 
			
		$db = new DB_Sql;
		
		$db->connect();
		$connection_string = 'DRIVER={SQL Server};SERVER=<HICKERY>;DATABASE=<compass>'; 
		
		$user = "root"; 
		$pass = ""; 
		
		$conn = mysql_connect( "localhost", $user, $pass );
                mysql_select_db("compass_mt", $conn);
/*		import situation
		$sql = "select situationname sname,topicname tname from situation";
		$res = odbc_exec($conn,$sql);
		while (odbc_fetch_row($res))
		{
			$sql = "select idunit from unit where name='".odbc_result($res,2)."'";
			$db->query($sql);
			if($db->next_record()){
				$sql="insert into topic set name='".odbc_result($res,1)."',idunit=".$db->Record['idunit'];
				$db->query($sql);
			}
//			echo $sql;
		}
*/
/*		import situation_concept
		$sql = "select situationname sname,conceptname cname from situation_concept";
		$res = odbc_exec($conn,$sql);
		while (odbc_fetch_row($res))
		{
			$sql = "select idtopic from topic where name='".odbc_result($res,1)."'";
			$db->query($sql);
			if($db->next_record()){
				$tid=$db->Record['idtopic'];
				$sql = "select idconcept from concept where general_title='".odbc_result($res,2)."'";
				$db->query($sql);
				if($db->next_record()){
					$cid=$db->Record['idconcept'];
					$sql="insert into CONCEPTINTOPIC set idconcept=".$cid.",idtopic=".$tid;
					$db->query($sql);
				}
			}
		}
*/		
		$sql = "select concept1name cname1,concept2name cname2,situationname sname,relationdescription r from situation_relation";
		$res = mysql_query($sql);
                
                if (false === $res) {
                   echo mysql_error();
                        }
                else{        
		while (mysql_fetch_array($res))
		{
			$sql = "select idtopic from topic where name='".odbc_result($res,3)."'";
			$db->query($sql);
			if($db->next_record()){
				$tid=$db->Record['idtopic'];
				$sql = "select idconcept from concept where general_title='".odbc_result($res,1)."'";
				$db->query($sql);
				if($db->next_record()){
					$cid1=$db->Record['idconcept'];
					$sql = "select idconcept from concept where general_title='".odbc_result($res,2)."'";
					$db->query($sql);
					if($db->next_record()){
						$cid2=$db->Record['idconcept'];
						$sql = "select idrelation from RELATION where name='".odbc_result($res,4)."'";
						$db->query($sql);
						if($db->next_record()){
							$r=$db->Record['idrelation'];
							$sql="insert into CONCEPTRELATION set conceptfrom=".$cid1.",conceptto=".$cid2.",idrelation=".$r.",level=2".",idtopic=".$tid;
							$db->query($sql);
						}
					}
				}
			}
		}
                }
?>