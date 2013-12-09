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
		include "showcontent_1.inc";	
// show contents  		
  		$showcontent = new showcontent_1;
  		$part=$_REQUEST['part'];
  		$parts = $showcontent->getparts();
  		$detail = $showcontent->getdetail($part);
  		$title = $showcontent->gettitle();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<link rel="stylesheet" href="../css/compass.css" type="text/css" media=screen>
<script language="JavaScript">
if ( screen.width > 800 ) {
  document.writeln("<style>");
  document.writeln("body {font-size: 14px;}");
  document.writeln("h1 {font-size: 22pt;}");
  document.writeln("</style>");
}
else {
  document.writeln("<style>");
  document.writeln("body {font-size: 9pt;}");
  document.writeln("h1 {font-size: 14pt;}");
  document.writeln("</style>");
}

function redirectmap(uid,tid,cid)
{ 
	parent.document.nav.location="nav.php?source=2&uid="+uid+"&tid="+tid+"&cid="+cid;
	parent.document.mapApplet.shareddata.setmap(uid,tid,cid,1);
//	self.location="nav.php?uid="+idunit;
}

</script>
<body>
<?php
	if($title != null)
		echo "<h1>".$title."</h1>";
	if($detail != null)
		echo $detail;
	if($parts != null){
		echo "<p align=\"center\">";
		if($part == "content"){
		foreach ($parts as $key => $value)
			if($key!=$part)
				echo "<a href=\"showcontent.php?part=".$key."\" class=\"tabletitle\">".$value."</a>&nbsp; &nbsp; &nbsp; &nbsp;";
		}
		else
				echo "<a href=\"showcontent.php?part=content\" class=\"tabletitle\">Back</a>";
		echo "</p>";
	}
?>
</body>
</html>
<?php		  	
	}
}
?>
