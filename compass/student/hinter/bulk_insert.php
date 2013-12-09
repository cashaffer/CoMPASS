<?
include "db_mysql_mt.inc";
$db = new DB_Sql;
$db->connect();

$lines = file('forces-pair_probabilities.csv');
foreach ($lines as $line_num => $line) {
	echo "inserting {$line_num}<br>\n";
	$result = $db->query($line);
	if (!$result) {
		echo "failed<br>\n";
	}
}
?>	
