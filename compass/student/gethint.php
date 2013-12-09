<?php

function getRecommendation($explorationid, $uid, $cid, $tid) {
#	include "db_mysql_mt.inc"; --> the called should have included it
	$db = new DB_Sql;
	$db->connect();

$sql2 = '
select c.general_title cname,ld.idconcept cid,ld.idtopic tid,ld.idunit uid
from compass_mt.LOGDATA ld
left join compass_mt.CONCEPT c
on c.idconcept=ld.idconcept
where ld.idexploration="' . $explorationid . '" order by ld.time;
';

$result = $db->query($sql2);
if (!$result) {
	return '';
}

while ($row = mysql_fetch_assoc($result)) {
	$c = $row['cid'];
	if ($c != null) {
		$input_array[] = $c;
	}
}

$input_array[] = $cid; # the current concept might not be updated in database yet.

if (count($input_array) <= 1) {
	return '';
}

#	$concepts = mysql_real_escape_string($_GET['concepts']);

#	if ($concepts == null) {
#		header("location:/compass/error_code.php?code=006"); 
#	}
#	$input_array = split(',', $concepts);
	# remove consecutive duplicates
	$last_a = '';
	foreach ($input_array as $a) {
		if ($a != $last_a && $a != '') {
			$array[] = $a;
			$last_a = $a;			
		}
	}


	$array_size = count($array);

	# if there are more than 4 concepts, use the first few to prune the clusters
	# that is, form a table with only those clusters that could have generated the concepts
	if ($array_size <= 4) {
		$table_name = 'compass_mt.cluster_probabilities c';
	} else {
		$table_name = 
			'(
			select t1.* from compass_mt.cluster_probabilities t1 
			inner join
			(
				select cluster_num, sum(c.probability) as prob
				FROM compass_mt.cluster_probabilities c
				where c.concept2=' . $array[$array_size - 3];
		if ($array_size >= 4) {
			$table_name = $table_name . ' or c.concept2= ' . $array[$array_size - 4];
		}
		if ($array_size >= 5) {
			$table_name = $table_name . ' or c.concept2= ' . $array[$array_size - 5];
		}

		$table_name = $table_name . ' group by c.cluster_num
			order by prob desc
				limit 25
			) t2
			where t1.cluster_num = t2.cluster_num
		) c';
	}

	$full_query = ' select q.concept, p.name, q.prob from 
		(select co.idconcept, co.general_title as name from compass_mt.concept co) p
		inner join (';
	$get_concepts_query = '
		select c.concept, c.prob from
		(		
		select c.concept2 as concept, sum(c.probability) as prob	from '
		. $table_name . 
		' where (c.concept1 = ' . $array[$array_size - 1] . ' or c.concept1=' . $array[$array_size - 2] . ')';

	# exclude already clicked concepts from results
	for ($i=0; $i<$array_size; $i++) {
		$get_concepts_query = $get_concepts_query . ' and (c.concept2 != ' . $array[$i] . ') ';
	}

	$get_concepts_query = $get_concepts_query . ' group by c.concept2  ) c 
		inner join 
	(SELECT c3.idconcept as idconcept FROM compass_mt.conceptintopic c3 where idtopic = ' . $tid . ') z
	where z.idconcept = c.concept
	order by c.prob desc limit 3 ';	

	$full_query = $full_query . $get_concepts_query . ') q where p.idconcept=q.concept;';
	
	$sql = $full_query;
	$result = $db->query($sql);

	if (!$result) {
		return '';
		exit;
	}

#	echo '<br/>';
#	echo $full_query;
#	echo '<br/>';

	$num_rows = mysql_num_rows($result);

	if ($num_rows == 0) {
		return '';
		exit;
	}
	
	$output = '<div style="font-size:small;float:right;border:1px solid darkgreen;
	background-color: lightgreen;width:100px; padding-left:2px;">
		<b>You may find these interesting:</b>
		';
	while ($row = mysql_fetch_assoc($result)) {
		$output = $output .
			'<a style="text-transform:capitalize" 
			onClick="window.parent.document.mapApplet.shareddata.setMap(' . $uid . ', ' . $tid . ', ' . $row['concept'] . ',2);"
			 href="#">' . $row['name'] . '</a><br/>';
	} 
	$output = $output . '</div>';

	mysql_free_result($result);

	return $output;
}

?>

