<?php
include "config.inc";
session_start();
//if ($_SESSION['loginnanme'] == null) 
//	header ("location:/compass/viewlogs");

include "db_mysql_mt.inc";

$db = new DB_Sql;
$db->connect();

$idteacher = $_SESSION['iduser'];
$d = $_REQUEST['d'];
$sql = "SELECT idunit, idconcept, idtopic, avg(timelength) t FROM compass_mt.logdata l where idexploration in (SELECT idexploration FROM compass_mt.exploration e where idclass in (SELECT idclass FROM compass_mt.class c where idteacher=".$idteacher.") and date(time)='".$d."') group by idunit, idconcept, idtopic;";
$str = '';

$num_units = 0;
$query = $db->query($sql);

$prev_unit = '';
$prev_concept = '';
$prev_topic = '';

while ($db->next_record()) {
	$unit = $db->Record['idunit'];
	$concept = $db->Record['idconcept'];
	$topic = $db->Record['idtopic'];
	$time = $db->Record['t'];
//	$time = round($time/60.0, 2);

	if ($unit == null or 
		$concept == null or
		$topic == null or
		$time == null) {
			continue;
		}

	/*
	 * Note: keep synced with logs.php
	 * [ 2,
	 *   [ 11,
	 *     { c1: { t1: time1 , t2: time2, t3: time3},
	 *       c2: { .... }
	 *     }
	 *   ],
	 *   [ 15,
	 *     { c3: {....}
	 *     }
	 *   ]
	 * ]
	 */

	if ($unit != $prev_unit) {
		// new unit
		$num_units++;
		if ($num_units > 1) { 
			$str .= "}}],"; 
		}
		$str .= "\n [ " . $unit . ",\n " . "{ " . $concept . " : {" . $topic.":".$time;
	} else {
		if ($concept == $prev_concept) {
			// same concept, only topic changes
			$str .= ", " . $topic.":".$time;
		} else {
			// new concept
			$str .= "}, \n" . $concept . ": {" . $topic.":".$time;
		}
	}
	$prev_unit = $unit;
	$prev_concept = $concept;
	$prev_topic = $topic;
}

if ($num_units > 0) {
	$str = "[ " . $num_units . ", " . $str . "} } ] ]";
}

if ($str == '') { $str = 0; }

$str = 'ret = ' . $str . ';';

$sql = "SELECT count(distinct(idstudent)) c FROM compass_mt.exploration e where idclass in (SELECT idclass FROM compass_mt.class c where idteacher=".$idteacher.") and date(time)='".$d."'";
$query = $db->query($sql);
$num_students = 0;
if($db->next_record()) {
	$num_students = $db->Record['c'];
}
$str = $str . ' num_students = ' . $num_students . ';';
echo $str;
?>


