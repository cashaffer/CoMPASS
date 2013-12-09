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

include("../../pChart/class/pData.class.php");
include("../../pChart/class/pDraw.class.php");
include("../../pChart/class/pImage.class.php");


$myData = new pData();


/* Connect to the MySQL database */
$db = mysql_connect("144.92.160.26", "root", "cao2");
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
  $Requete2 = "SELECT * FROM concept WHERE idconcept = " . $idconcept;
  $Result2  = mysql_query($Requete2,$db);
  $row2 = mysql_fetch_array($Result2);
  $currentconcept = $row2["general_title"];
  $Requete3 = "SELECT * FROM topic WHERE idtopic =" . $idtopic;
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
    foreach ($topicconcept as $key => $value) {
	if ($value == $currenttopicconcept) {

 	  /* if topicconcept is already there*/

	  $count[$key] = $count[$key] + 1;
	  $totaltime[$key] = $totaltime[$key] + $timelength/60;
          $found = true;
	}
	 
    }
    if ($found == false) {
	$topicconcept[$key+1] = $currenttopicconcept;
        $count[$key+1] =  1;
	$totaltime[$key+1] = $timelength/60;
    }

   


 }




/* GET RELEVANT CONCEPTS FOR ACTIVITY */
$Requete5 = "SELECT idactivity FROM exploration WHERE idexploration = " . $idexploration ;
$Result5 = mysql_query($Requete5,$db);
$row5 = mysql_fetch_array($Result5);
$idactivity = $row5["idactivity"];

$Requete6 = "SELECT * FROM relevant_concepts WHERE idactivity = " . $idactivity ;
$Result6 = mysql_query($Requete6,$db);

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
		  $totaltime[$key] = $totaltime[$key] + $timelength/60;
   	      	  $found = true;
		}
	 
  	  }
	// if not visited, add it to the graph, with zero visits
  	  if ($found == false) {
		$topicconcept[$key+1] = $currenttopicconcept;
    	        $count[$key+1] =  0;
		$totaltime[$key+1] = 0;
  	  }



}


/* Reorder by amount of time spent on each concept */
$arr = array(
	'totaltime' => $totaltime,
	'topicconcept' => $topicconcept,
	'count' => $count
	);
//var_dump($arr);

array_multisort($arr['totaltime'], SORT_DESC, SORT_NUMERIC, $arr['count'], $arr['topicconcept']);
//var_dump($arr);

/* PUT DATA INTO GRAPH */

$numItems = count($arr['totaltime']);
$i = 0;
foreach ($arr['topicconcept'] as $key => $value) {

  if ($i < $numItems - 1) { 
    /* Save the data in the pData array */
    $myData->addPoints($arr['topicconcept'][$key],"Topic_concept");
    //$myData->addPoints($arr['count'],"Count");
    $myData->addPoints($arr['totaltime'],"Total_time");
  }

  $i++;
}



/* Put the timestamp column on the abscissa axis */
/*$myData->setSerieDescription("Topic_concept","Concept");*/
$myData->setXAxisName("Concept");
$myData->setAbscissa("Topic_concept");

/* Name this axis "Time" */



/* First Y axis will be dedicated to the temperatures */
$myData->setAxisName(0,"Total time (minutes)");
$myData->setAxisUnit(0,"");

/* Draw serie 1 in red with a 80% opacity */
$serieSettings = array("R"=>11,"G"=>11,"B"=>229,"Alpha"=>60);
$myData->setPalette("Total_time",$serieSettings);

$myPicture = new pImage(678,550,$myData,TRUE);
$Settings = array("R"=>255, "G"=>254, "B"=>252, "Dash"=>1, "DashR"=>275, "DashG"=>274, "DashB"=>272);
$myPicture->drawFilledRectangle(0,0,700,230,$Settings);

$myPicture->drawRectangle(0,0,677,549,array("R"=>0,"G"=>0,"B"=>0));

$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>50,"G"=>50,"B"=>50,"Alpha"=>20));

$myPicture->setFontProperties(array("FontName"=>"../../pChart/fonts/arial.ttf","FontSize"=>14));
$TextSettings = array("Align"=>TEXT_ALIGN_MIDDLEMIDDLE
, "R"=>0, "G"=>0, "B"=>0);
$myPicture->drawText(350,25,"Your CoMPASS Navigation",$TextSettings);

$myPicture->setShadow(FALSE);
$myPicture->setGraphArea(50,50,675,425);
$myPicture->setFontProperties(array("R"=>0,"G"=>0,"B"=>0,"FontName"=>"../../pChart/fonts/arial.ttf","FontSize"=>10));

$Settings = array("Pos"=>SCALE_POS_LEFTRIGHT
, "Mode"=>SCALE_MODE_START0
, "Factors"=>array(1)
, "LabelingMethod"=>LABELING_ALL
, "GridR"=>255, "GridG"=>255, "GridB"=>255, "GridAlpha"=>50, "TickR"=>0, "TickG"=>0, "TickB"=>0, "TickAlpha"=>50, "LabelRotation"=>60, "CycleBackground"=>1, "DrawXLines"=>1, "DrawSubTicks"=>0, "SubTickR"=>255, "SubTickG"=>0, "SubTickB"=>0, "SubTickAlpha"=>50, "DrawYLines"=>ALL);
$myPicture->drawScale($Settings);

$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>50,"G"=>50,"B"=>50,"Alpha"=>10));

$Config = array("Gradient"=>1,"AroundZero"=>1);
$myPicture->drawBarChart($Config);

/*$Config = array("FontR"=>0, "FontG"=>0, "FontB"=>0, "FontName"=>"../../pChart/fonts/pf_arma_five.ttf", "FontSize"=>6, "Margin"=>6, "Alpha"=>30, "BoxSize"=>5, "Style"=>LEGEND_NOBORDER
, "Mode"=>LEGEND_HORIZONTAL);*/
/*$myPicture->drawLegend(563,16,$Config);*/


$LabelSettings = array("TitleR"=>255,"TitleG"=>255,"TitleB"=>255, "DrawSerieColor"=>FALSE,"TitleMode"=>LABEL_TITLE_BACKGROUND, "OverrideTitle"=>"Visits","ForceLabels"=>array($arr['count'][0],$arr['count'][1],$arr['count'][2],$arr['count'][3],$arr['count'][4],$arr['count'][5],$arr['count'][6],$arr['count'][7],$arr['count'][8],$arr['count'][9],$arr['count'][10],$arr['count'][11],$arr['count'][12],$arr['count'][13],$arr['count'][14],$arr['count'][15],$arr['count'][16],$arr['count'][17],$arr['count'][18],$arr['count'][19],$arr['count'][20],$arr['count'][21],$arr['count'][22],$arr['count'][23],$arr['count'][24],$arr['count'][25],$arr['count'][26],$arr['count'][27],$arr['count'][28],$arr['count'][29],$arr['count'][30]), "GradientEndR"=>220,"GradientEndG"=>255,"GradientEndB"=>220, "TitleBackgroundG"=>11, "TitleBackgroundB"=>100,"TitleBackgroundR"=>11);
$myPicture->writeLabel(array("Total_time"),array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30),$LabelSettings);


$myPicture->stroke();


$_SESSION['missingconcept'] == "hello";
?>  	


