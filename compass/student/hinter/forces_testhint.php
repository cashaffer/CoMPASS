<?

include "id_to_name_mappings.php";

$db = null;
$sql = "";

function hint_init_db() {
	//	include "db_mysql_mt.inc";
	//	----should have already been included by the calling php
	global $db, $sql;
	$db = new DB_Sql;
	$sql = "";
	$db->connect();
}

$current_uid = "0";
$current_tid = "0";
$current_cid = "0";

$cids = array();
$cnum = 0;
$concept_topics_map = array();
$topic_time_map = array();
$concept_time_map = array();
$random_browsing = 0;
$unread_concepts = 0;
$total_time_cid = 0;
$total_time_tid = 0;

$cluster_weight = array();

$goal_tid = 0;
$goal_table = "";

$debug = "";
$some_error = 0;
$error_str = "";
function set_error($str) {
	global $some_error, $error_str;
	$some_error = 1;
	$error_str = $str;
//	echo $str;
	return -1;
}

/*
	global $db, $sql;
	global $cids, $cnum, $concept_topics_map, $topic_time_map, $concept_time_map, $random_browsing, $unread_concepts, $cluster_weight;
	global $total_time_cid, $total_time_tid;
	global $goal_tid;
/ */

function insert_concept($c, $t, $tim) {
///function insert_concept($c, $tim, &$concept_time_map, &$cids, &$unread_concepts, &$random_browsing) {
	global $cids, $cnum, $concept_topics_map, $topic_time_map, $concept_time_map, $random_browsing, $unread_concepts, $cluster_weight;
	global $total_time_cid, $total_time_tid;
	global $debug;
	if ($debug) {
		echo get_concept_name($c) . ", " . $t . " -- " . $tim . "<br>"; 
	}

	if ($c && $tim > 9) {
//	if ($c) {

		/* student has spent some time in this page, consider it in our statistics */

		$c = "" . $c;
		$t = "" . $t;

		$cids[] = $c;
		if (!isset($concept_topics_map[$c])) {
			$concept_topics_map[$c] = array();
		}
//		echo "visited $c, $t <br>";
		$concept_topics_map[$c][$t] = 1;

		if (!isset($concept_time_map[$c])) {
			$concept_time_map[$c] = $tim;
		} else {
			$concept_time_map[$c] += $tim;
		}
		$total_time_cid += $tim;

		if (!isset($topic_time_map[$t])) {
			$topic_time_map[$t] = $tim;
		} else {
			$topic_time_map[$t] += $tim;
		}

	}

	if ($t != null && $tim > 9) {
//	if ($t != null) {
		$total_time_tid += $tim;
	}

	/* this is a short click (did not spend much time on this page). see if this happens frequently */
	if ($tim <= 9) {
		$unread_concepts += 1;
		if ($debug) {
			echo "    unread: $unread_concepts";
		}
		if ($unread_concepts >= 4) {
			// consecutive short clicks
			$random_browsing = 1;
		}
	} else {
		$unread_concepts = 0;
		$random_browsing = 0;
	}
}

function get_goal ($explorationid) {
	global $db, $sql;
	global $current_uid, $current_tid, $current_cid;
	global $goal_tid, $goal_table;

	// for forces and motion, the probabilities were calculated for the whole unit instead of for a single topic.
	// so goal topic is the first topic, and goal_table is always the forces and motion table.
		
	$goal_tid = $_SESSION['goal_tid'];
	if (!$goal_tid) {
		$goal_tid = $current_tid; // set the current topic as the goal
		$_SESSION['goal_tid'] = $goal_tid;
	}

	$goal_table = "forces_transition_probabilities";
//	echo "goal table $goal_table<br>";
}

function get_sequence($explorationid, $uid, $tid, $cid) {

	global $db, $sql;
	global $current_uid, $current_tid, $current_cid;
	global $goal_tid;
	global $debug, $random_browsing;

//	$explorationid = $_REQUEST['id'];
	if ($explorationid == null) {
		$seq = $_REQUEST['seq'];
		if ($seq == null) {
			return set_error('No exploration id or sequence found');
		}
		
		/* get click sequence from url parameters */

		$concept_id_t = explode(",", $seq);
		$connum = count($concept_id_t);
		if ($connum < 3) {
			return set_error("Not enough data");
		}
		for ($i=0; $i<$connum; $i++) {
			list($con_id, $top_id, $tim) = explode(":", $concept_id_t[$i]);
			//$debug .= $con_id . ", " . $top_id . " -- " . $tim . "<br>"; 
			insert_concept($con_id, $top_id, $tim);
		}
		// last click is the current
		$current_uid = "11";
		$current_tid = $top_id;
		$current_cid = $con_id;

	} else {
	
		if ($uid) $current_uid = $uid;
		if ($tid) $current_tid = $tid;
		if ($cid) $current_cid = $cid;

		get_goal($explorationid);
//		echo "goal: $goal_tid<br>";
		
		/* get click sequence from database, using the exploration id */

		$sql = '
		select ld.idconcept cid,ld.idtopic tid,ld.idunit uid, ld.timelength t
		from compass_mt.LOGDATA ld
		where ld.idexploration=' . $explorationid . ' order by ld.time;
		';

//		echo $sql . '<br/><br/>';

		$result = $db->query($sql);

		if (!$result) {
			return set_error('No results returned. '. mysql_error($result));
		}
//		echo mysql_num_rows($result) . "<br>";
		
		$num_rows_in_result = mysql_num_rows($result);
		if ($num_rows_in_result <= 3) {
			return set_error("Not much rows found for this exploration id");
		}

		/* Discard earlier clicks if too many results */
		if ($num_rows_in_result >= 30) {
			// too many results. take only the last 30.
			for ($i=$num_rows_in_result; $i>=30; $i--) {
				$row = mysql_fetch_assoc($result);
			}
		}

		// remember the last concept and topic, because its stats may not have gotten updated in the database yet.
		$last_c = 0;
		$last_t = 0;
		/* insert results in our data structures */
		while ($row = mysql_fetch_assoc($result)) {
			$c = $row['cid'];
			$t = $row['tid'];
			$tim = $row['t'];
			insert_concept($c, $t, $tim);
			$last_c = $c;
			$last_t = $t;
		}

		/* Add the present and last concepts, as they might not have reached the database yet. */
		/* caution: this interferes with the random_browsing variable */
		$prev_random_browing = $random_browsing;
		
		if ($c != $current_cid) { 
			insert_concept($current_cid, $current_tid, 11);
		}

		// sometimes the time spent for the last click may not have reached the database yet.
		// but we have to ignore it from our suggestions.
		if ($last_c) { 
			insert_concept($last_c, $last_t, 11);
		}

		$random_browsing = $prev_random_browing;

	} // end if explore id

//TODO	insert the concept for this page

	return 0;

} // end get_seq()

function html_random_browsing() {
	global $random_browsing;
	global $debug;

	if ($debug) {
		echo " random: $random_browsing<br/>";
	}

	if ($random_browsing) {
		return "<b>Please concentrate on a concept.</b><br/>";
	}
	return "";
}

function html_visited_all_concepts() {
	global $cids, $cnum, $concept_topics_map, $topic_time_map, $concept_time_map, $random_browsing, $unread_concepts, $cluster_weight;
	global $goal_tid;

	$cnum = count($cids);

	if ($cnum < 2) {
		return "";
	}

	$c = 0;
	for ($i=90; $i<=140; $i++) {
		if (isset($concept_topics_map["".$i]) && isset($concept_topics_map["".$i]["".$goal_tid])) {
			$c++;
		}
	}
//	echo "visis: $goal_tid ted: $c <br>";
	if ($c >= 16) {
		// all concepts have been visited, no need to compute probabilities.
		return "<b>Congrats! You have read about all concepts in " . get_topic_name($goal_tid) . " </b><br>";
	}
	return "";
}


/*
for a sequence "97, 102, 136" :
	
SELECT cluster_num, sum(prob) p FROM compass_mt.lever_transition_probabilities l
where (concept1 = 97 and concept2 = 102) or (concept1 = 102 and concept2 = 136) group by cluster_num

Note that the table store log probabilities. hence the probability that a cluster produces this sequence 
is equal to the sum of log prob of page transitions (by Markov property, we consider only immediate transitions).
In the database, since we store all transitions, this sum is effectively evaluated by the above query.
*/


function compute_cluster_weights() {

	global $db, $sql;
	global $cids, $cnum, $concept_topics_map, $topic_time_map, $concept_time_map, $random_browsing, $unread_concepts, $cluster_weight;
	global $goal_tid, $goal_table;

	/* compute cluster weights (how probable the seq is for a cluster) */
	$sql = "
		SELECT cluster_num c, sum(prob) p FROM compass_mt.$goal_table l
		where  ";
	$sql .= '(concept1 = '.$cids[$cnum-2].' and concept2 = '.$cids[$cnum-1].')';

	// limit to 7 pairs
	$limit = 0;
	for ($i=$cnum-2; $i>=1; $i--) { 
		if ($limit == 7) { break; }
		if ($cids[$i-1] != $cids[$i]) {
			$sql .= ' or (concept1 = '.$cids[$i-1].' and concept2 = '.$cids[$i].')	';
			$limit++;
		}
	}
	$sql .= ' group by cluster_num ';

//	echo $sql;

	$result = $db->query($sql);

	if (!$result) {
		return set_error('No results returned. '. mysql_error($result));
	}

	while ($row = mysql_fetch_assoc($result)) {
		$cluster = $row['c'];
		$c_weight = $row['p'];
		$cluster_weight[$cluster] = $c_weight;
	}

//	for ($i=0; $i<count($cluster_weight); $i++) {
//		echo '<br>'. $i . ' - ' .$cluster_weight[$i];
	//	}
	
	return 0;	
} // end compute_cluster_wt()

function get_concept_suggestions($topk) {
/*
 * We have the weights of clusters, which is the probability with which they would generate this sequence.
 * For each cluster, we find its prediction, that is, the most probable elements that follows the last seen (excluding
 * the already seen ones).
 * For each prediction, we add the cluster weight, and sort the result. We then return the top k as our suggestions.
 */

/*
select * from (
	(SELECT prob + weight(0) FROM lever_transition_probabilities where concept1=99 and cluster_num=0) <--- add weight of clus 0 to prob
	union all
	(SELECT prob + weight(1) FROM lever_transition_probabilities where concept1=99 and cluster_num=1) <--- add weight of clus 1 to prob
) s
order by s.prob desc
;
*/

	global $db, $sql;
	global $cids, $cnum, $concept_topics_map, $topic_time_map, $concept_time_map, $random_browsing, $unread_concepts, $cluster_weight;
	global $current_uid, $current_tid, $current_cid;
	global $goal_tid, $goal_table;

	$last_concept = $cids[$cnum - 1]; 
	$arr = array();
	for ($i=0; $i<count($cluster_weight); $i++) {
		$arr[] .= '(SELECT *, (' . $cluster_weight[$i] . " + prob) w FROM compass_mt.$goal_table l where concept1 = ".
			$last_concept .
			' and cluster_num=' . $i . ')';
	}
	$sql = "Select * from ( " . join(" union all ", $arr) . ") s1 "; // <-- this query will return (cluster, concept) sorted by weight, which is the sum of weight of cluster and next concept. But what we need is a ranking of concepts, taking into account all clusters.

	$sql = "Select concept1, concept2, sum(w) wt from (" . $sql . ") s2 group by concept1, concept2 order by wt desc"; // <-- this query will sum all the weights for a tranition (concept1 -> concept2) and rank according to those weights.

	$result = $db->query($sql);
	if (!$result) {
		return set_error('No results returned. '. mysql_error($result));
	}
	
	$suggested_concepts = array();

	while ($row = mysql_fetch_assoc($result)) {
		$concept2 = $row['concept2'];
//		echo "<br>" . $concept2;
		if ((isset($concept_topics_map["".$concept2]) && isset($concept_topics_map["".$concept2]["".$goal_tid])) || 
			($current_cid == $concept2)) {
//			echo "-- visited ".$concept_time_map["".$concept2];
		} else {
			$suggested_concepts[] = $concept2;
			$topk--;
			if ($topk == 0) { break; }
		}
	}

	return $suggested_concepts;

	//echo "<br>".$sql;
} // end get_suggestions()

// returns concepts in other topics, that may be of interest
function get_related_concept_topics($topk) {
	global $cids, $cnum, $concept_topics_map, $topic_time_map, $concept_time_map, $random_browsing, $unread_concepts, $cluster_weight;
	global $total_time_cid, $total_time_tid;
	global $goal_tid;

	$related_concept_topics = array();
	if (count($concept_time_map) <= 3) { // suggest related topics only after student reads atleast 3 concepts.
		return $related_concept_topics;
	}

	$concepts_maybe_interested = array();

	// concepts that a student is interested in = 
	//     1) visits the same concept in different topics
	//     2) spends more time on this
	//
	for ($i=90; $i<=140; $i++) {
		if (isset($concept_topics_map["".$i])) {
			$topics = $concept_topics_map["".$i];
			if (count($topics) > 1) {
				// this concept was read in different topics. maybe the student is interested in this concept
				$concepts_maybe_interested["".$i] = 10*count($topics);
			}
		}
	}
//		arsort($concept_time_map);
	foreach ($concept_time_map as $c => $tim) {
		if (!isset($concepts_maybe_interested[$c])) {
			$concepts_maybe_interested[$c] = $tim;
		} else {
			$concepts_maybe_interested[$c] += $tim;
		}		
	} 

	// now order the topics
	// default order: IP, Lever, Pulley, Screw, Wedge, Wheel & Axle
	// todo
	$top_topics = array("29" => "9", "28" => "8", "27" => "6");
	foreach ($topic_time_map as $t => $tim) {
		$top_topics[$t] = $tim; // more weight for the visited topic 
	}

	// dont show the goal_topic in related topics
	$top_topics["".$goal_tid] = 0;

	arsort($concepts_maybe_interested); // todo
	arsort($top_topics);
	// restrict to $topk elements
	foreach ($top_topics as $t => $tim) {
		if ($topk <= 0) { break; }
		foreach ($concepts_maybe_interested as $c => $timdash) {
//			echo " concept $c, topic $t: " . isset($concept_topics_map["".$c]["".$t]) . "<br>";
			if (isset($concept_topics_map["".$c]) && isset($concept_topics_map["".$c]["".$t])) { 
				// already visited
			}	else {
				$related_concept_topics[$c . "_" . $t] = $timdash * $tim;
				$topk--;
				if ($topk <= 0) { break; }
			}
		}
	}

	arsort($related_concept_topics);
	return $related_concept_topics;
}

function get_anchor_text($uid, $tid, $cid, $suggestion_num, $is_in_different_topic) {
	$info = "from:hinter,suggestion:$suggestion_num";
 	if ($is_in_different_topic)	{
		$info .= ",different_topic";
	}
	$link = "<a target='_parent' href='explore.php?uid=$uid&tid=$tid&source=1&dllink=$info";
	$anchor = "";
	$cstr = get_concept_name($cid);
	$tstr = get_topic_name($tid);
//	echo "$cstr $tstr ..<br>";
	if ($tstr == "") {
		// TODO : print only unit name
		return "";
	}
	if (!$cstr) { 
		$anchor = $tstr;
	}
	else { 
		$link .= "&cid=$cid";
		$anchor = $cstr . " in " . $tstr;
	}
	$link .= "'>";
	return $link . $anchor . "</a>";
}

function get_recommendations($explorationid, $uid, $cid, $tid, $d) {
	global $cids, $cnum, $concept_topics_map, $topic_time_map, $concept_time_map, $random_browsing, $unread_concepts, $cluster_weight;
	global $total_time_cid, $total_time_tid;
	global $current_uid, $current_tid;
	global $goal_tid;
	global $debug;

	if ($d) {
		$debug = 1;
	}

	$str = "";
		
	global $db, $sql;
	hint_init_db();

	$s = get_sequence($explorationid, $uid, $cid, $tid);
	if ($s == -1) {
		return "";
	}
	
	$cnum = count($cids);
	
	$str .= html_random_browsing();
	$str .= html_visited_all_concepts();
	
	if ($cnum < 2) {
		return $str;
	}
	compute_cluster_weights();

	$suggested_concepts = array();
	$related_concept_topics = array();

	$suggested_concepts = get_concept_suggestions(4);
//	echo count($concept_time_map);
	if (count($concept_time_map) > 3) {
		$related_concept_topics = get_related_concept_topics(4);
	}

	$ns = count($suggested_concepts);
	$nr = count($related_concept_topics);

	$num_needed = 4;  // total number of suggestions needed.
	$num_goal = 3; // number of suggestions for the goal topic out of $num_needed
	$num_added = 0; // current value of number of suggestions 

	if ($ns < $num_goal) { 
		$num_goal = $ns;
	}
 // these concepts do not appear in some topics
	/*
	 * for circular motion 27 , these topics do not appear:
	 * [96, 98,  103, 107, 109,  111, 115, 116, 121,  124, 125, 128,  130, 132,  136]
	 *
	 * for falling objects 28 , these concepts do not appear:
	 * [ 96,    103, 105,  107,     115,  117,    121,  124, 125,    132,  
	 *
	 * for linear motion 29, these concepts do not appear:
	 * [ 96, 98,    105,  107, 109,  111,  115,      124, 125, 128,  130, 132,  
	 * */

	$concept_topic_already_suggested = array();
	
	if ("".$goal_tid == "27") {
		$concept_topic_NOT_to_be_suggested = array(96, 98,  103, 107, 109,  111, 115, 116, 121,  124, 125, 128,  130, 132,  136);
		foreach ($concept_topic_NOT_to_be_suggested as $i => $con) {
			// hack: mark this concept as already shown, to prevent it from beging displayed.
			$concept_topic_already_suggested[ "".$con ."_". $goal_tid ] = 1;
		}
	} else if ("".$goal_tid == "28") {
		$concept_topic_NOT_to_be_suggested = array( 96,    103, 105,  107,     115,  117,    121,  124, 125,    132);
		foreach ($concept_topic_NOT_to_be_suggested as $i => $con) {
			// hack: mark this concept as already shown, to prevent it from beging displayed.
			$concept_topic_already_suggested[ "".$con ."_". $goal_tid ] = 1;
		}
	} else if ("".$goal_tid == "29") {
		$concept_topic_NOT_to_be_suggested = array(96, 98,    105,  107, 109,  111,  115,      124, 125, 128,  130, 132);
		foreach ($concept_topic_NOT_to_be_suggested as $i => $con) {
			// hack: mark this concept as already shown, to prevent it from beging displayed.
			$concept_topic_already_suggested[ "".$con ."_". $goal_tid ] = 1;
		}
	}

	for ($i=0; $i<$num_goal; $i++) {
		$con = $suggested_concepts[$i];
		if (!isset($concept_topic_already_suggested["" . $con . "_" . $goal_tid])) {
			$num_added++;
			$str .= get_anchor_text($current_uid, $goal_tid, $con, $num_added, false) . "<br/>";
			$concept_topic_already_suggested["" . $con . "_" . $goal_tid] = 1;
		}
	}

	foreach($related_concept_topics as $ct => $tim) {
		if ($num_added >= $num_needed) { break; }
		list($con, $top) = explode("_", $ct);
		if (!isset($concept_topic_already_suggested["" . $con . "_" . $top])) {
			$num_added++;
			$str .= get_anchor_text($current_uid, $top, $con, $num_added, true) . "<br/>";
			$concept_topic_already_suggested["" . $con . "_" . $top] = 1;
		}
	}


/*	$i=0;
*	// displayed in multiples of 2. so if num_needed =3, then 4 rows will be shown.
	while ($num_added <= $num_needed) {
		// show 2 concepts for the goal topic, 2 for related topics
		$si = 2;
		for (; $i<count($suggested_concepts); $i++) {
			if ($si <= 0) { break; }
			$con = $suggested_concepts[$i];
			$top = $goal_tid;
			if (!isset($concept_topic_already_suggested["" . $con . "_" . $top])) {
				$concept_topic_already_suggested["" . $con . "_" . $top] = 1;
				$num_added++;
				$str .= get_anchor_text($current_uid, $top, $con, $num_added, false) . "<br>";
				$si--;
			}
		} 

		if ($num_added > $num_needed) { break; }
 
		$si = 2;
		foreach($related_concept_topics as $ct => $tim) {
			if ($si <= 0) { break; }
			list($con, $top) = explode("_", $ct);
			if (!isset($concept_topic_already_suggested["" . $con . "_" . $top])) {
				$concept_topic_already_suggested["" . $con . "_" . $top] = 1;
				$num_added++;
				$str .= get_anchor_text($current_uid, $top, $con, $num_added, true) . "<br>";
				$si--;
			}
		}
	} // end while num_added
 */

	if ($num_added > 0) {
	return  	'<table style="float:right;width:340px" class="otherlabel">' .
					  '<tr><td width="30%"> Suggestions for you: </td>' .
				  	'<td><div style="border: 1px solid lightSlateGray; background: lightSteelBlue none repeat scroll 0% 0%; padding-left: 2px;" class="otherlabel">' .
						$str .
						'</.div></td></tr>' .
						'</div>';
	} else {
		return $str ;
	}
}


//echo get_recommendations();

?>

