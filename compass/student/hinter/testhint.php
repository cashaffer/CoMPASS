<?
include "db_mysql_mt.inc";
$db = new DB_Sql;
$db->connect();

$explorationid = mysql_real_escape_string($_GET['id']);

if ($explorationid == null) {
	header("location:/compass/error_code.php?code=006"); 
}

$sql = '
select c.general_title cname,ld.idconcept cid,ld.idtopic tid,ld.idunit uid
from compass_mt.LOGDATA ld
left join compass_mt.CONCEPT c
on c.idconcept=ld.idconcept
where ld.idexploration="' . $explorationid . '" order by ld.time;
';

$result = $db->query($sql);
if (!$result) {
	echo 'error';
	exit;
}

while ($row = mysql_fetch_assoc($result)) {
	$c = $row['cid'];
	if ($c != null) {
		$cids[] = $c;
		$cnames[] = $row['cname'];
	}
}

for ($i=0; $i<count($cids); $i++) {
	echo $cids[$i] . $cnames[$i] . '<br/>' ;
}

if (count($cids) >= 5) {
include("testgethint.php");
echo 'test<br/>';
echo getRecommendation($cids, 11, 29);
} else {
	echo 'less than 5 concepts..';
}
?>
