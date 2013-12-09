<?php
session_start();
if ($_SESSION['loginname'] == null)
	header("location:/compass/error_code.php?code=001"); 
//	echo $_SESSION['loginname'];
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(1))
		header("location:/compass/error_code.php?code=004"); 
	else{		
		include "db_mysql_mt.inc"; 
  		$idexploration=$_SESSION['idexploration'];
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<form name="form1" action="navgraph_saveanswer.php" method="post">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<link rel="stylesheet" href="../css/compass.css" type="text/css" media=screen>

<body>
<table cellpadding=15 style="vertical-align:top">
<td>
<img src="chart.php"/>
</td>
<td valign="top">

<?php
 

/* Connect to the MySQL database */
$db = mysql_connect("localhost", "root", "");
mysql_select_db("compass_mt",$db);

/* Build the query that will returns the data to graph */
$Requete = "SELECT * FROM logdata WHERE idexploration = " . $idexploration ;
$Result  = mysql_query($Requete,$db);
$topicconceptcount = 0;
$topicconcept = array();
$count = array();
$totaltime = array();


   while($row = mysql_fetch_array($Result))
 {
  /* Get the data from the query result */
  $timelength   = $row["timelength"];
  $idconcept = $row["idconcept"];
  $idtopic    = $row["idtopic"];
  $idunit    = $row["idunit"];



  /* construct topic_concept */
  $Requete2 = "SELECT * FROM concept WHERE idconcept = '$idconcept'";
  $Result2  = mysql_query($Requete2,$db);
  $row2 = mysql_fetch_array($Result2);
  $currentconcept = $row2["general_title"];
  $Requete3 = "SELECT * FROM topic WHERE idtopic = '$idtopic'";
  $Result3  = mysql_query($Requete3,$db);
  $row3 = mysql_fetch_array($Result3);
  $currenttopic = $row3["name"];
  /* formatting*/
  $parenpos = strpos($currenttopic,"(");
  if ($parenpos > 0) {
     $currenttopic = trim(substr($currenttopic,0,$parenpos));
  }

  //$currenttopicconcept = $currenttopic . "_" . $currentconcept;	
   $currenttopicconcept = $currentconcept . "\n" . "(" . $currenttopic . ")";	

  if ($currenttopicconcept == "\n()") {
    $Requete4 = "SELECT * FROM unit WHERE idunit = " . $idunit ;
    $Result4  = mysql_query($Requete4,$db);
    $row4 = mysql_fetch_array($Result4);
    $currenttopicconcept = $row4["name"];
    $parenpos = strpos($currenttopicconcept ,"(");
    if ($parenpos > 0) {
       $currenttopicconcept  = trim(substr($currenttopicconcept ,0,$parenpos));
    }
  } else if ($currentconcept == "" ) {
	$currenttopicconcept = $currenttopic;

  } else if ($currenttopic == "" ) {
	$currenttopicconcept = $currentconcept;

  }


  if ($currenttopicconcept{0} == "\n()") {
      $currenttopicconcept  = trim(substr($currenttopicconcept,1,strlen($currenttopicconcept)));
  }
  $underscorepos = strpos($currenttopicconcept ,"\n");
  if ($underscorepos  == (strlen($currenttopicconcept) - 1)) {
      $currenttopicconcept  = trim(substr($currenttopicconcept ,0,strlen($currenttopicconcept)-1));
  }


  /* add up count and timelength per topic_concept */


    /* step through array of prior topic_concepts */
    $found = false;
    $key = 0;
    foreach ($topicconcept as $key => $value) {
	if ($value == $currenttopicconcept) {

 	  /* if topicconcept is already there*/

	  $count[$key] = $count[$key] + 1;
	  $totaltime[$key] = $totaltime[$key] + $timelength;
          $found = true;
	}
	 
    }
    if ($found == false) {
	$topicconcept[$key+1] = $currenttopicconcept;
        $count[$key+1] =  1;
	$totaltime[$key+1] = $timelength;
    }

   


 }

/* GET RELEVANT CONCEPTS FOR ACTIVITY */
$Requete5 = "SELECT idactivity FROM exploration WHERE idexploration = " . $idexploration ;
$Result5 = mysql_query($Requete5,$db);
$row5 = mysql_fetch_array($Result5);
$idactivity = $row5["idactivity"];

$Requete6 = "SELECT * FROM relevant_concepts WHERE idactivity = " . $idactivity ;
$Result6 = mysql_query($Requete6,$db);
$firstfound = true;
$i=0;
while($row6 = mysql_fetch_array($Result6))
{
	
	// construct topic_concept name
	/* construct topic_concept */
 	 $Requete7 = "SELECT * FROM concept WHERE idconcept = " . $row6["idconcept"];
 	 $Result7  = mysql_query($Requete7,$db);
 	 $row7 = mysql_fetch_array($Result7);
 	 $currentconcept = $row7["general_title"];
 	 $Requete8 = "SELECT * FROM topic WHERE idtopic =" . $row6["idtopic"];
 	 $Result8  = mysql_query($Requete8,$db);
 	 $row8 = mysql_fetch_array($Result8);
 	 $currenttopic = $row8["name"];
 	 /* formatting*/
  	$parenpos = strpos($currenttopic,"(");
  	if ($parenpos > 0) {
  	   $currenttopic = trim(substr($currenttopic,0,$parenpos));
  	}

  	//$currenttopicconcept = $currenttopic . "_" . $currentconcept;	
  	 $currenttopicconcept = $currentconcept . "\n" . "(" . $currenttopic . ")";	

 	 if ($currenttopicconcept == "\n()") {
  	  $Requete9 = "SELECT * FROM unit WHERE idunit = " . $row6["idunit"] ;
  	  $Result9  = mysql_query($Requete9,$db);
  	  $row9 = mysql_fetch_array($Result9);
  	  $currenttopicconcept = $row9["name"];
  	  $parenpos = strpos($currenttopicconcept ,"(");
  	  if ($parenpos > 0) {
  	     $currenttopicconcept  = trim(substr($currenttopicconcept ,0,$parenpos));
  	  }
 	 } else if ($currentconcept == "" ) {
		$currenttopicconcept = $currenttopic;
	
 	 } else if ($currenttopic == "" ) {
		$currenttopicconcept = $currentconcept;

 	 }


  	if ($currenttopicconcept{0} == "\n()") {
  	    $currenttopicconcept  = trim(substr($currenttopicconcept,1,strlen($currenttopicconcept)));
  	}
  	$underscorepos = strpos($currenttopicconcept ,"\n");
  	if ($underscorepos  == (strlen($currenttopicconcept) - 1)) {
  	    $currenttopicconcept  = trim(substr($currenttopicconcept ,0,strlen($currenttopicconcept)-1));
 	 }



	// check if concept already has been visited

 	  $found = false;
   	 foreach ($topicconcept as $key => $value) {
		if ($value == $currenttopicconcept) {
	
 		  /* if topicconcept is already there*/

		  $count[$key] = $count[$key] + 1;
		  $totaltime[$key] = $totaltime[$key] + $timelength;
   	      	  $found = true;
		}
	 
  	  }
	// if not visited, add it to the graph, with zero visits

  	  if ($found == false) {
		if ($firstfound == true) {
			echo "<strong>The graph shows you the number of times you visited concepts and the time you spent on each. Think about what you have already learned. Do you have the science information necessary for your exploration? What other concepts can you visit? Discuss with your group and check the concepts that you would like to visit. <br><br> </strong>";
			$firstfound = false;
		}
		
		$topicconcept[$key+1] = $currenttopicconcept;
    	        $count[$key+1] =  0;
		$totaltime[$key+1] = 0;

		echo "<input type='checkbox' name='option".$i."' value= '". $currenttopicconcept ."'>" .$currenttopicconcept. "<br><br>";
		$_SESSION['option'.$i+1]=$currenttopicconcept;
		$i++;

  	  }
	
		
}

$Requete10 = "INSERT INTO graph_logdata (idexploration, timestarted) VALUES (".$idexploration.", '". date ("Y-m-d H:i:s")."')";
$Result10  = mysql_query($Requete10,$db);
$_SESSION['logdataid'] = mysql_insert_id();
   

$_SESSION['checkboxes'] = $i;
if ($i > 0) {
		echo "Make sure to take note of which concepts you have decided to visit. Then click the submit button and continue navigating.<br><br>";
		echo "<input type='submit' name='Submit' value='Submit'/>";
	} 

else {

echo "<strong>The graph shows you the number of times you visited concepts and the time you spent on each. Think about what you have already learned. Do you have the science information necessary for your exploration? What other concepts should you visit? <br><br> </strong>";
			
}

?>

</td>
</table>

</body>
</form>
</html>