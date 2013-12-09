<?

function getRecommendation($input_array, $uid, $tid) {
#	include "db_mysql_mt.inc"; --> the called should have included it
	$db = new DB_Sql;
	$db->connect();

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
	# assumption: array_size is >= 6
	# use first size-3 to predict, last 3 to test
	if ($array_size <= 5) {
		$table_name = 'compass_mt.cluster_probabilities c';
	} else {
		$table_name = 
			'(
			select t1.* from compass_mt.cluster_probabilities t1 
			inner join
			(
				select cluster_num, sum(c.probability) as prob
				FROM compass_mt.cluster_probabilities c
				where c.concept2=' . $array[$array_size - 6];
		if ($array_size >= 7) {
			$table_name = $table_name . ' or c.concept2= ' . $array[$array_size - 7];
		}
		if ($array_size >= 8) {
			$table_name = $table_name . ' or c.concept2= ' . $array[$array_size - 8];
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
		inner join
		(select c.concept2 as concept, sum(c.probability) as prob	from '
		. $table_name . 
		' where (c.concept1 = ' . $array[$array_size - 4] . ' or c.concept1=' . $array[$array_size - 5] . ')';

	# exclude already clicked concepts from results
	for ($i=0; $i<$array_size-3; $i++) {
		$full_query = $full_query . ' and (c.concept2 != ' . $array[$i] . ') ';
	}

	$full_query = $full_query . ' group by c.concept2 order by prob desc limit 6 ) q
	 where p.idconcept=q.concept;';

	
	$sql = $full_query;
	echo '<br/><br/>';
	echo $sql;
	echo '<br/><br/>';
	$result = $db->query($sql);

	if (!$result) {
		return '[-1]';
		exit;
	}

	$num_rows = mysql_num_rows($result);

	if ($num_rows == 0) {
		return '[0]';
		exit;
	}
	
	$output = '<div style="border:1px solid darkgreen;
	background-color: lightgreen; padding-left:2px;">
		<b>You may find these interesting:</b><br/>';
	while ($row = mysql_fetch_assoc($result)) {
		$output .= $row['concept'] . ' ' . $row['name'] . ' , <br/>';
	} 
	$output = $output . '<br><br>';
	$output = $output . $array[$array_size - 3]. ', '. $array[$array_size - 2]. ', '. $array[$array_size - 1];
	$output = $output . '</div>';

	mysql_free_result($result);

	return $output;
}

?>

