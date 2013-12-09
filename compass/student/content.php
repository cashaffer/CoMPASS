<?php
session_start();

if ($_SESSION['loginname'] == null)
	header("location:/compass/error_code.php?code=001"); 
//	echo $_SESSION['loginname'];
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(1) && !$priority->checkPage(2))
		header("location:/compass/error_code.php?code=004"); 
	else{		
		include "db_mysql_mt.inc"; 
		include "tracer.inc";	
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
			if (isset($_SESSION['dllink'])) {
				$ids['dllink'] = $_SESSION['dllink'];
			}
                        else{
                            $ids['dllink'] = "";
                        }
		//if ($_SESSION['loginname'] == 'test') {
			if (isset($_SESSION['starttime'])) {
				$timepassed = time() - $_SESSION['starttime'];
			}
			if ($timepassed > 600 && $_SESSION['activity'] != 5) {  // if not reading excursion 
				//if not Liz Core 2 or Greg Core 3 2012
				
				if ($_SESSION['idclass'] != 194 && $_SESSION['idclass'] != 198) {
					echo "<script>window.open(\"navgraph.php\", \"navgraph\", 'width=1050, height=600');</script>";
					$_SESSION['starttime'] = time();	
				}

			}




			/*if ($_SESSION['totalclicks'] <= 3 && $ids['cid']==0 && $ids['tid'] !=0) {
				echo "<script>window.open(\"prompts1.php\", \"prompts\", 'width=400, height=150, left=25, top=400, toolbar=0, resizable=0');</script>";
			}
			if ($_SESSION['totalclicks'] == 3) {
				echo "<script>window.open(\"history1.php\", \"history\", 'width=400, height=300, left=450, top=250, toolbar=0, resizable=0');</script>";
			    $_SESSION['clicks'] = 0;
			}
			if ($_SESSION['totalclicks'] == 7) {
				if ($ids['tid'] == 60) {
				    echo "<script>window.open(\"history2a.php\", \"history\", 'width=400, height=350, left=450, top=250, toolbar=0, resizable=0');</script>";
				} else if ($ids['tid'] == 65) {
				    echo "<script>window.open(\"history2b.php\", \"history\", 'width=400, height=350, left=450, top=250, toolbar=0, resizable=0');</script>";
				} else {					
				    echo "<script>window.open(\"history2.php\", \"history\", 'width=400, height=350, left=450, top=250, toolbar=0, resizable=0');</script>";
				}
			}	
			if ($_SESSION['totalclicks'] == 15) {
				if ($ids['tid'] == 60) {
				    echo "<script>window.open(\"history3a.php\", \"history\", 'width=400, height=600, left=450, top=250, toolbar=0, resizable=0');</script>";
				} else if ($ids['tid'] == 65) {
				    echo "<script>window.open(\"history3b.php\", \"history\", 'width=400, height=600, left=450, top=250, toolbar=0, resizable=0');</script>";
				} else {					
				    echo "<script>window.open(\"history3.php\", \"history\", 'width=400, height=600, left=450, top=250, toolbar=0, resizable=0');</script>";
				}

			}

			*/
			
			$_SESSION['clicks'] = $_SESSION['clicks'] + 1;
			$_SESSION['totalclicks'] = $_SESSION['totalclicks'] + 1;
			$_SESSION['timepassed'] = $_SESSION['timepassed'];
		//}

//write log
  		$tracer = new tracer;
  		if($tracer->isNewAction($ids))
  			$tracer->updateLog($db);

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

<?
//			$testing = false;
//			if ($_SESSION['loginname'] == 'testtest') {
//				$testing = true;
//			}
?>
	<script type="text/javascript">
//	if (<?=$testing?>) {
//	document.writeln("<style type='text/css'>");
//	document.writeln("body { border: 1px solid lightgrey; font-size:17px;} ");
//	document.writeln("#hid {background: rgb(235, 235, 235) url(content-bg.gif) no-repeat scroll -4px 0pt; padding-left:10px}");
//	document.writeln("#hid { text-transform:capitalize; }");
//	document.writeln("p{padding: 7px;font-size:15px}");
//	document.writeln("</style>");
//	}
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