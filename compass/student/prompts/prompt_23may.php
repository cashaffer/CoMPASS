<?

include "id_to_name_mappings.php";

$db = null;
$sql = "";

function hint_init_db() {
	//	include "db_mysql_mt.inc"; ----should have already been included by the calling php
	global $db, $sql;
	$db = new DB_Sql;
	$sql = "";
	$db->connect();
}

$current_uid = "0";
$current_tid = "0";
$current_cid = "0";

$cids = array();
$tids = array();
$times = array();
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

$debug = 1;
$return_string = "";
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
	global $cids, $tids, $times, $cnum, $concept_topics_map, $topic_time_map, $concept_time_map, $random_browsing, $unread_concepts, $cluster_weight;
	global $total_time_cid, $total_time_tid;
	global $debug, $return_string, $last_topic, $last_concept;
	if ($debug) {
		//$return_string .= get_concept_name($c) . ", " . get_topic_name($t) . " -- " . $tim . "<br>"; 
	}

	$c = "" . $c;
	$t = "" . $t;	
	$cids[] = $c;
	$tids[] = $t;
	$times[] = $tim;

	return;


	if ($c && $tim > 9) {
//	if ($c) {

		/* student has spent some time in this page, consider it in our statistics */

		$c = "" . $c;
		$t = "" . $t;

		$cids[] = $c;
		$tids[] = $t;
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
			//echo "    unread: $unread_concepts";
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
	
	$goal_tid = $_SESSION['goal_tid'];
	if (!$goal_tid) {
//		echo "<b>goal</b> not found, querying....<br>";
		$sql = "select question from exploration where idexploration='$explorationid'";
		$result = $db->query($sql);
		if ($result) {
			while ($row = mysql_fetch_assoc($result)) {
				$goal_topic_name = strtolower($row['question']);
				if (!$goal_topic_name) { 
					$goal_tid = $current_tid; // set the current topic as the goal
					break;
				}

				if (strpos($goal_topic_name, 'lever') !== false) {
					$goal_tid = 64; // lever
				} else if (strpos($goal_topic_name, 'lined') !== false) {
					$goal_tid = 60; // IP
				} else if (strpos($goal_topic_name, 'wedge') !== false ||
									strpos($goal_topic_name, 'wege') !== false ||
									strpos($goal_topic_name, 'wede') !== false) {
					$goal_tid = 61; // wedge

				} else if (strpos($goal_topic_name, 'pul') !== false ) {
					$goal_tid = 65; // pulley

				} else if (strpos($goal_topic_name, 'screw') !== false ) {
					$goal_tid = 63; // screw

				} else if (strpos($goal_topic_name, 'wheel') !== false ) {
					$goal_tid = 62; // wheel and axle

				} else if (strpos($goal_topic_name, 'force') !== false ) {
					$goal_tid = 0; // forces and motion
				}

				break;
			} // end while
		}
		if (!$goal_tid) { 
			$goal_tid = $current_tid; // set the current topic as the goal
		}
		$_SESSION['goal_tid'] = $goal_tid;
	}

	$goal_tid_table = array( 64=>'lever_transition_probabilities', 60=>'inclined_transition_probabilities', 
		61=>'wedge_transition_probabilities', 65=>'pulley_transition_probabilities', 63=>'screw_transition_probabilities',
		62=>'wheel_transition_probabilities');
	$goal_table = $goal_tid_table[$goal_tid];
//	echo "goal table $goal_table<br>";
}

function get_sequence($explorationid, $uid, $tid, $cid) {

	global $db, $sql;
	global $current_uid, $current_tid, $current_cid;
	global $goal_tid;
	global $debug, $random_browsing;

//	$explorationid = $_REQUEST['id'];
	if ($explorationid == null) {
		echo "explore id not found!";
		exit;
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
		if ($num_rows_in_result == 0) {
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

	if ($random_browsing) {
		return "<b>Please concentrate on a concept.</b><br/>";
	}
	return "";
}

function html_visited_all_concepts() {
	global $cids, $tids, $times, $cnum, $concept_topics_map, $topic_time_map, $concept_time_map, $random_browsing, $unread_concepts, $cluster_weight;
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
	if ($c >= 11) {
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
	global $cids, $tids, $times, $cnum, $concept_topics_map, $topic_time_map, $concept_time_map, $random_browsing, $unread_concepts, $cluster_weight;
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
	global $cids, $tids, $times, $cnum, $concept_topics_map, $topic_time_map, $concept_time_map, $random_browsing, $unread_concepts, $cluster_weight;
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
	global $cids, $tids, $times, $cnum, $concept_topics_map, $topic_time_map, $concept_time_map, $random_browsing, $unread_concepts, $cluster_weight;
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
	$top_topics = array("60" => "9", "64" => "8", "65" => "6", "63" => "5", "61" => "4", "62" => "3");
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
	global $cids, $tids, $times, $cnum, $concept_topics_map, $topic_time_map, $concept_time_map, $random_browsing, $unread_concepts, $cluster_weight;
	global $total_time_cid, $total_time_tid;
	global $current_uid, $current_tid;
	global $goal_tid;
	global $debug, $return_string;

	if ($d) {
		$debug = 1;
	}

	global $db, $sql;
	hint_init_db();

	$s = get_sequence($explorationid, $uid, $cid, $tid);
	if ($s == -1) {
		return "";
	}
	html_random_browsing();
	html_visited_all_concepts();

	for ($i=1; $i<count($cids); $i++) {
		$tim = $times[$i];
		if (!$tim) { continue; }
		$ft = get_topic_name($tids[$i - 1]);
		$fc = get_concept_name($cids[$i - 1]);
		$tt = get_topic_name($tids[$i]);
		$tc = get_concept_name($cids[$i]);
		if (!$ft) $ft = 'nil';
		if (!$fc) $fc = 'nil';
		if (!$tt) $tt = 'nil';
		if (!$tc) $tc = 'nil';
		$return_string .= "(move (from-topic $ft) (from-concept $fc) (to-topic $tt) (to-concept $tc) (delta-time $tim) (timestamp $i)) \n";
	}
	$goal_name = get_topic_name($goal_tid);
	$set_goal = "(defrule set-goal-topic" .
	                				    "(declare (salience 10))" .
	                				    "?f1 <- (topic (name $goal_name) (family ?fam) (goal false))" .
	                				    "?f2 <- (goalset false)" .
	                				    "=>" .
	                				    "(retract ?f1)".
	                				    "(retract ?f2)".	                				    
															"(assert (goalset true))" .
	                				    "(printout t goal is $goal_name)".															
	                				    "(assert (topic (name $goal_name) (family ?fam) (goal true))))";
	                			
	$return_array[1] = $set_goal;
 	$return_array[2] = $return_string;
	return $return_array;
}


//echo get_recommendations();

?>

