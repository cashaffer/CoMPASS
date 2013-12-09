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
	else{		
		include "db_mysql_mt.inc"; 
			
		$db = new DB_Sql;
		
		$db->connect();
		$sql="select idunit,name from UNIT where idunit = 10 or idunit = 11 or idunit = 18 order by name";
		$db->query($sql);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
function orderby(column){
	MM_goToURL('self','../admin/conceptmap/tclist.php?searchname=<?= $searchname?>&orderby=%27%2Bcolum');
	return document.MM_returnValue;
}
function check(){
	str=document.form2.searchname.value;
	rtn = true;
	if(str == ""){
		alert("Please input name first!");
		form2.searchname.focus();
		rtn=false;
	}
	else if(str.length<=2){
		alert("String you input is too short!");
		form2.searchname.focus();
		rtn=false;
	}
	else
		rtn = true;
	return rtn;
}
</script>
</head>
<link rel="stylesheet" href="../css/compass.css" type="text/css" media=screen>
<body>
<center>
<p>&nbsp;</p>
<table>
<td>
  <p class="tabletitle">Select a Unit</p>
  <?php
		while($db->next_record()){
			$unitname = $db->Record['name'];
			$parenpos = strpos($unitname,"(");   //GWS 1/3/08 - removing parentheses and indeces from titles
			if ($parenpos !== false) $unitname = trim(substr($unitname,0,$parenpos));	 

?>
  
  <a href="explore.php?uid=<?=$db->Record['idunit']?>" class="f14b"><?=$unitname?></a> <p/>&nbsp;&nbsp;
  <?php
	}
?>

<br>
<br>
<br>
<br>
<b>Simulations:</b>
<br>
<br>
<a href="../../sims/roller_coaster_sim.html">Roller Coaster Simulation</a>  <a href="./CoMPASS Roller Coaster Simulation Manual_FINAL.pdf">(Manual)</a> 
<br>
<br>
<a href="../../sims/inclined_plane_2010.php">Inclined Plane Simulation</a>
<br><br>
Pulley Simulation:
<script src="http://www.java.com/js/deployJava.js"></script><script>
        // using java_script to get location of JNLP file relative to HTML page
    
  // check if current JRE version is greater than 1.6.0 
   // alert("versioncheck " + deployJava.versionCheck('1.6+'));
    if (deployJava.versionCheck('1.5.0_10+') == false) {                   
        userInput = confirm("You need the latest Java(TM) Runtime Environment. Would you like to update now?");        
        if (userInput == true) {  
    
            // Set deployJava.returnPage to make sure user comes back to 
            // your web site after installing the JRE
            deployJava.returnPage = location.href;
            
            // install latest JRE or redirect user to another page to get JRE from.
            deployJava.installLatestJRE(); 
        }
    }
else
{
 var url = "http://iis.cse.eng.auburn.edu/~mynenls/vips/files/vipswisc.jnlp";
        deployJava.createWebStartLaunchButton(url, '1.5.0'); <!-- you can also invoke deployJava.runApplet here -->
}
    </script>

<br><br><br><br>
<b>Reading Excursion Websites:</b><br><br>
Reading Excursion #1:<br>
<a href="http://www.physics4kids.com/files/motion_intro.html" target="_blank">www.physics4kids.com/files/motion_intro.html</a><br>
<a href="http://www.physicsclassroom.com/Class/newtlaws/U2L2b.cfm" target="_blank">www.physicsclassroom.com/Class/newtlaws/U2L2b.cfm</a><br>
<a href="http://www.physics4kids.com/files/motion_vectors.html" target="_blank">www.physics4kids.com/files/motion_vectors.html</a><br>
Reading Excursion #2:<br>
<a href="http://www.fi.edu/guide/hughes/energyconservation.html" target="_blank">www.fi.edu/guide/hughes/energyconservation.html</a><br>
Reading Excursion #3:<br>
<a href="http://www.iptv.org/exploremore/energy/Energy_In_Depth/sections/potential.cfm" target="_blank">www.iptv.org/exploremore/energy/Energy_In_Depth/sections/potential.cfm</a><br>
Reading Excursion #4:<br>
<a href="http://www.physics4kids.com/files/motion_laws.html" target="_blank">www.physics4kids.com/files/motion_laws.html</a><br>
<a href="http://www.beyondbooks.com/psc91/4d.asp" target="_blank">www.beyondbooks.com/psc91/4d.asp</a><br>
<br><br><br>

<b>Videos:</b><br><br>
Video for Reading Excursion 1: <a href="Work Video 1 - 4.mov">(Mac)</a> <a href="Work Videos.wmv">(Windows)</a>    
</td>

<?php
if ($_SESSION['loginname'] != "guest") {

?>
<td VALIGN=top>
<strong>Teacher Tools:</strong><br><br>
<a href="http://compassproject.net/posttest/physics_fiesta_spring2012.php">Physics Fiesta Online Post-test</a><br><br><br>
<a href="teachergraphs.php">Class Navigation Graphs</a><br><br><br>
<strong>Documents:</strong><br><br>
<a href="Physics Fiesta_Final 2012.pdf">Physics Fiesta Test</a><br>
<a href="Science Practices Test_Final 2012.pdf">Science Practices Test</a><br>
<a href="Final_Student Notebook_print.pdf">Student Notebook</a><br>
<a href="CoMPASS Rubrics.pdf">CoMPASS Rubrics</a><br>
<a href="Jessica Geissler's Concept Map Materials.pdf">Jessica Geissler's Concept Map Materials</a><Br>
<a href="CAPS.pdf">CAPS Guide</a><Br>
</td>
</table>
</center>
</body>
</html>
<?php
	}
	}
}
?>
