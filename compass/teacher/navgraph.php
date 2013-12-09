<?php
session_start();

if ($_SESSION['loginname'] == null)
	header("location:/compass/error_code.php?code=001"); 
//	echo $_SESSION['loginname'];
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(2))
		header("location:/compass/error_code.php?code=004"); 
}
include "db_mysql_mt.inc"; 
			
$db = new DB_Sql;
		
$db->connect();
		

// get all explorations for current class and date selected
echo "<strong>These graphs display the navigation data for your class - the number of visits and amount of time spent on each concept.  <br> The first chart is for the class as a whole. The remaining charts are for each individual student group.</strong><br><br>";
echo "<a href='teachergraphs.php'>return</a><br><br>";

$idclass = mysql_real_escape_string($_REQUEST['Class']);
$selecteddate =	$_REQUEST['selecteddate'];

echo "<img src='classchart.php?Class=".$idclass."&selecteddate=".$selecteddate."'/>";
echo "<br>";

$sql="select * from exploration where idclass = ".$idclass;
$db->query($sql);


// step through all rows and choose rows where date matches selected date
//echo $idclass;

$db2 = mysql_connect("localhost", "root", "");
mysql_select_db("compass_mt",$db2);

$topicconceptcount = 0;
$topicconcept = array();
$count = array();
$totaltime = array();
		
while($db->next_record()){
	$datetime = $db->Record['time'];
	$navdate = substr($datetime,0,10);
	$_SESSION['navdate'] = $navdate;
	//echo "selecteddate: ".$selecteddate."<br>";
	//echo "navdate: ".$navdate."<br>";
	
	if ($navdate == $selecteddate) {
		
		// add chart for this exploration
		echo "<img src='chart.php?idexploration=".$db->Record['idexploration']."'/>";
		echo "<br>";
			 


	}

}

?>  	
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<link rel="stylesheet" href="../css/compass.css" type="text/css" media=screen>

<body>
<table cellpadding=15 style="vertical-align:top">
<td>

</td>
</table>
</body>
</head>
</html>