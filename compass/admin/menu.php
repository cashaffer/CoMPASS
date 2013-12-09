<?php
include "config.inc"; 

session_start();

if ($_SESSION['loginname'] == null)
	header("location:/compass/error_code.php?code=001"); 
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(8))
		header("location:/compass/error_code.php?code=004"); 
}	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>admin panel</title>
</head>

<body>
<link rel="stylesheet" href="../css/compass.css" type="text/css" media=screen>

<script type="text/javascript">

/***********************************************
* Switch Menu script- by Martial B of http://getElementById.com/
* Modified by Dynamic Drive for format & NS4/IE4 compatibility
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

if (document.getElementById){ //DynamicDrive.com change
document.write('<style type="text/css">\n')
document.write('.submenu{display: none;}\n')
document.write('</style>\n')
}

function SwitchMenu(obj){
	if(document.getElementById){
	var el = document.getElementById(obj);
	var ar = document.getElementById("masterdiv").getElementsByTagName("span"); //DynamicDrive.com change
		if(el.style.display != "block"){ //DynamicDrive.com change
			for (var i=0; i<ar.length; i++){
				if (ar[i].className=="submenu") //DynamicDrive.com change
				ar[i].style.display = "none";
			}
			el.style.display = "block";
		}else{
			el.style.display = "none";
		}
	}
}

</script>
<!-- Keep all menus within masterdiv-->
<div id="masterdiv">

	<div class="menutitle" onclick="SwitchMenu('sub1')">User Info</div>
	<span class="submenu" id="sub1">
		- <a href="user/requestlist.php?type=1" target="mainFrame">Deal Requests</a><br>
		- <a href="user/userlist.php?type=1" target="mainFrame">User Control</a><br>
		- <a href="user/classlist.php" target="mainFrame">Class Control</a><br>
		- <a href="user/grouplist.php" target="mainFrame">Group Control</a><br>
		- <a href="user/termlist.php" target="mainFrame">Term Control</a>
	</span>

	<div class="menutitle" onclick="SwitchMenu('sub2')">Concept Map</div>
	<span class="submenu" id="sub2">
		- <a href="conceptmap/unitlist.php" target="mainFrame">Units</a><br>
		- <a href="conceptmap/topiclist.php" target="mainFrame">Topics</a><br>
		- <a href="conceptmap/conceptlist.php" target="mainFrame">Concepts</a><br>
		- <a href="conceptmap/tclist.php" target="mainFrame">Topic_Concepts</a><br>
		- <a href="conceptmap/relationlist.php" target="mainFrame">Concept Relations</a><br>
		- <a href="conceptmap/examplelist.php" target="mainFrame">Examples</a><br>
		- <a href="conceptmap/updatexml.php" target="mainFrame">Update XML</a>
	</span>

<?php
 if(strtolower(version) == "compass-dl"){
?>
	<div class="menutitle" onclick="SwitchMenu('sub3')">CoMPASS-DL</div>
	<span class="submenu" id="sub3">
		- <a href="conceptmap_dl/unitlist.php" target="mainFrame">Units</a><br>
		- <a href="conceptmap_dl/topiclist.php" target="mainFrame">Topics</a><br>
		- <a href="conceptmap_dl/conceptlist.php" target="mainFrame">Concepts</a><br>
		- <a href="conceptmap_dl/tclist.php" target="mainFrame">Topic_Concepts</a><br>
		- <a href="conceptmap_dl/examplelist.php" target="mainFrame">Examples</a><br>
	</span>
<?php
}
?>

	<div class="menutitle" onclick="SwitchMenu('sub4')">Log Data</div>
	
  <span class="submenu" id="sub4"> - <a href="log/viewpretest.php" target="mainFrame">Pretest 
  Result </a><br>
  - <a href="log/viewposttest.php" target="mainFrame">Posttest Result </a><br>
   - <a href="log/loglist.php" target="mainFrame">View 
  Log</a><br>
   - <a href="log/setuppath.php" target="mainFrame">Make Logfiles</a><br>
  - <a href="log/query.php" target="mainFrame">Do Statistics</a><br>
  - <a href="log/query_dev.php" target="mainFrame">Do Statistics (dev)</a><br>
  - <a href="">Backup Log</a><br>
  </span> 

  <div class="menutitle" onclick="SwitchMenu('sub5')">Error reports</div>
	<span class="submenu" id="sub5">
		- <a href="error_reports/view_reports.php" target="mainFrame">View reports</a><br>
	</span>
</div>

</body>
</html>