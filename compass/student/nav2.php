<?
session_start();

if ($_SESSION['loginname'] == null)
	header("location:/compass/error_code.php?code=001"); 
else {
//	echo $_SESSION['loginname'];
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(1))
		header("location:/compass/error_code.php?code=004"); 
	else{			
		include "db_mysql_mt.inc"; 
		include "/hinter/id_to_name_mappings.php"; // for uid->uname etc

		$db = new DB_Sql;		
		$db->connect();
		$uid = $_REQUEST['uid'];	
		$suid = $_REQUEST['suid'];	
		$tid = $_REQUEST['tid'];	
		$cid = $_REQUEST['cid'];
		$eid = $_REQUEST['eid'];
		$barType=0;
		$cname="";
		if($eid != null)
		  $barType = 5;                  //to show example level bar
		else if($uid != null && $tid==null && $cid==null)
		  $barType = 1;                  //to show unit level bar
		else if($uid != null && $tid!=null && $cid==null)
		  $barType = 2;                  //to show topic level bar
		else if($uid != null && $tid!=null && $cid!=null)
		  $barType = 3;                  //to show concept level bar
		else if($uid == null && $tid==null && $cid!=null)
			$barType = 4;

		$unitname = "This Unit";
		$topicname = "This Topic";
		$conceptname = "This Concept";

		if ($uid != null) {
//			$unitname = get_unit_name($uid);
		}
		if ($tid != null) {
	//		$topicname = get_topic_name($tid);
		}
		if ($cid != null) {
		///	$conceptname = get_concept_name($cid);
		}
	}
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">
	.topmenu {
		width:100%;
		text-align:justify;
		font-family:"Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-weight:bold;
		font-size:13px;
	}
	.but {
		margin-top:2px;
		padding-left:10px;
		padding-right:10px;
	}
	.unit {		
		color:#AA6611;
	}
	.topic {
		color:#bb4422;
	}
	.concept {
		color:#990000;
	}
</style>
		
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>
<SCRIPT LANGUAGE="JavaScript">
function gotoExample(eid)
{ 
	url="nav2.php?eid="+eid+"&";
<?
	$suburl="";
	if($uid != null)
		$suburl = $suburl."uid=".$uid."&";
	if ($suid != null)
		$suburl = $suburl."suid=".$suid."&";
	if($tid != null)
		$suburl = $suburl."tid=".$tid."&";
	if($cid != null)
		$suburl = $suburl."cid=".$cid;
?>
	url += '<?=$suburl?>';
	window.parent.document.content.location="content.php?source=2&eid="+eid;
	self.location=url;
}

function unitChanged()
{ 
	idunit=window.document.form1.idunit.value;
	window.parent.document.mapApplet.shareddata.setMap(idunit,null,null,2);
//	self.location="nav.php?uid="+idunit;
}
function topicChanged()
{ 
	idunit=window.document.form1.idunit.value;
	idtopic=window.document.form1.idtopic.value;
	if(idtopic != '0'){
		window.parent.document.mapApplet.shareddata.setMap(idunit,idtopic,null,2);
//		self.location="nav.php?uid="+idunit+"&tid="+idtopic;
	}
}

<?
	if($barType ==3 ||$barType ==4 ){
?>
function gotoRelatedTopic(uid,tid)
{ 
	window.parent.document.mapApplet.shareddata.mapLevel=1;
	window.parent.document.mapApplet.shareddata.setMap(uid,tid,<?=$cid?>,2);
}

function gotoGeneral()
{ 
	window.parent.document.mapApplet.shareddata.setMap(null,null,<?=$cid?>,2);
//	self.location="nav.php?uid="+idunit;
}
<?
	}
?>
function check(){
	desc=window.document.form1.key.value;
	rtn = true;
	if(desc == ""){
		alert("Please input Educational Description!");
		form1.key.focus();
		rtn=false;
	}
	else
		rtn = true;
	return rtn;
}
</SCRIPT>
<body>
<?
	if( $barType <=5 ){
?>
	<center>
		<div class="topmenu" style="border-bottom: 2px solid rgb(221, 221, 221); background: rgb(238, 238, 238)">
					<div style="background: transparent url(content-bg.gif) repeat scroll 100% 0pt; width: 50%; text-align: right; padding-bottom: 3px;float:right">
						<a href="#" class="but" onClick="MM_openBrWindow('history.php','loghistory','scrollbars=yes,resizable=yes,width=300,height=500')">
							History</a>
            <td> <span class="otherlabel"><a href="###" class="logout" onClick="MM_openBrWindow('navgraph.php','graph','scrollbars=yes,resizable=yes,width=1050,height=650')">Graph</a></span> 
            </td>
	    <td> <span class="otherlabel"><a class="logout" href="selectunit.php" TARGET="_parent">Top Page</a></span> 
          </td>			
						<a href="logout.php" class="but">Logout</a>			
					</div>

			<div style="background: transparent url(content-bg.gif) repeat scroll 0% 0%; padding-bottom: 3px; text-align:right">
				<? if ($uid!=null) { ?>
					<a href="#" class="unit" onClick="window.parent.document.mapApplet.shareddata.setMap(<?= $uid?>,null,null,2);">
							<?=$unitname?></a>
				<? } ?>
				<? if ($tid!=null) { ?>
					<b>	&gt; </b>
						<a href="#" class="topic" onClick="window.parent.document.mapApplet.shareddata.setMap(<?=$uid?>,<?= $tid?>,null,2);">
									<?=$topicname?></a>
				<? } ?>						
				<? if ($cid!=null) { ?>
						<b>	&gt; </b>
				<a href="#" class="concept" onClick="window.parent.document.mapApplet.shareddata.setMap(<?=$uid?>,<?= $tid?>,<?=$cid?>,2);">
									<?=$conceptname?></a>						
				<? } ?>						
			</div>
		</div>
<div style="background: transparent url(s.png) repeat-x scroll 0pt -11px; color: black; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial; height: 20px; display: block; position: relative; top: -1px;"> </div>

<div>
<? 

		$explorationid = $_SESSION['idexploration'];

		if ($uid == "11") {
			include "hinter/forces_testhint.php";
		} else {
			include "hinter/lever_testhint.php";
		}
	
		echo get_recommendations($explorationid, $uid, $tid, $cid);

?>
</div>
</center>

<?
}

?>

</body>
</html>


