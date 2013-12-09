<?php
session_start();

if ($_SESSION['loginname'] == null)
	header("location:/compass/error_code.php?code=001"); 
//	echo $_SESSION['loginname'];
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(4))
		header("location:/compass/error_code.php?code=004"); 
	else{		
		include "db_mysql_mt.inc"; 
		include "showcontent_1.inc";	
		$db = new DB_Sql;
		
		$db->connect();

	  	$ids = array("uid" => 0, "suid" => 0, "tid" => 0, "cid" => 0, "eid" => 0, "source" => 0);
  		$uid=$_REQUEST['uid'];
  		if($uid !=null)
			$ids['uid'] = (int) $uid;
                
		 $suid = null;
                if(isset($_REQUEST['suid'])){
                $suid = $_REQUEST['suid'];}
		if ($suid!=null)
			$ids['suid'] = (int) $suid;
                $tid = null;
                if(isset($_REQUEST['tid'])){
                $tid=$_REQUEST['tid'];}
  		if($tid !=null)
  			$ids['tid'] = (int) $tid;
                
                $cid = null;
                if(isset($_REQUEST['cid'])){
                $cid=$_REQUEST['cid'];}
  		if($cid !=null)
  			$ids['cid'] = (int) $cid;
                $eid = null;
                if(isset($_REQUEST['eid'])){
                $eid=$_REQUEST['eid'];}
  		if($eid !=null)
  			$ids['eid'] = (int) $eid;
                
  		$source=$_REQUEST['source'];
  		if($source !=null)
  			$ids['source'] = (int) $source;


// show contents  		
  		$showcontent = new showcontent_1;
  		$showcontent->setids($ids);
  		$showcontent->getcontent($db);
  		$parts = $showcontent->getparts();
  		$detail = $showcontent->getdetail("content");
  		$title = $showcontent->gettitle();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="../css/compass.css" type="text/css" media=screen>
<script language="JavaScript">
if ( screen.width > 800 ) {
  document.writeln("<style>");
  document.writeln("body {font-size: 12pt;}");
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
</head>
<body style="padding-right:20px">
<?php
	if($title != null)
		echo "<h1 id='hid'>".$title."</h1>";
	if($detail != null)
		echo $detail;
	if($parts != null){
		echo "<p align=\"center\">";
		foreach ($parts as $key => $value )
			if($key!="content")
				echo "<a href=\"showcontent.php?part=".$key."\" class=\"tabletitle\">".$value."</a>&nbsp; &nbsp; &nbsp; &nbsp;";
		echo "</p>";
	}
?>
</body>
</html>
<?php		  	
	}
}
?>
