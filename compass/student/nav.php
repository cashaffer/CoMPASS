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
		$db = new DB_Sql;		
		$db->connect();
                
                $uid = null;	
		$suid = null;	
		$tid = null;	
		$cid = null;
		$eid = null;
                
                if(isset($_REQUEST['uid'])){
                $uid = $_REQUEST['uid'];}
                
                if(isset($_REQUEST['suid'])){
                $suid = $_REQUEST['suid'];}
                
                if(isset($_REQUEST['tid'])){
                $tid = $_REQUEST['tid'];}
                
                if(isset($_REQUEST['cid'])){
                $cid = $_REQUEST['cid'];}
                
                if(isset($_REQUEST['eid'])){
                $eid = $_REQUEST['eid'];}
                
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

	// testing a new design
//if ($_SESSION['loginname'] == 'testtest') {
//	header("location:nav2.php?uid=".$uid."&suid=".$suid."&tid=".$tid."&cid=".$cid);
//}


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">
<!--
.para {
	text-align: justify;
	margin-top: 0in;
}
.otherlabel {
	font-size: small;
}
.topic {
	font-size: small;
}
.otheroptions {
	background-color: #CCCCFF;
}
.concept {
	color: #990000;
}
.heading {
	font-family: "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
	font-size: 24px;
	font-weight: bold;
	margin-top: .5em;
	margin-bottom: .3em;
}
.unit {
	font-size: 10px;
}
body {
	margin: 0px;
}
.topbar {
	color: #FFFFFF;
	background-color: #000066;
}

a:link.logout, a:visited.logout {
	color: #FFFFFF;
}

a:hover.logout {
	color: #FFFF00;
}

a:active.logout {
	color: #FF0000;
}

-->
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
	url="nav.php?eid="+eid+"&";
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
//	window.parent.document.mapApplet.shareddata.setMap(idunit,null,null,2);
	window.parent.location="explore.php?uid="+idunit;
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
 <form name="form1" method="post" action="search.php"  onSubmit="return check()">
<table width="100%" border="0" cellpadding="0" cellspacing="5">
  <tr> 
    <td colspan="2"> <table class="topbar" width="100%" cellpadding="0" cellspacing="5">
        <tr> 
            <td height="24"> 
              <select name="idunit" onChange="unitChanged();">
                <option value="<?=(($uid==null)?0:$uid)?>">Change unit</option>
                <?php
			//$sql="select idunit,name from UNIT order by name";
			// GWS - updated to display only the units for the current class
			$sql="select distinct unit.idunit, unit.name FROM unit, class_to_unit, takesclass, user where unit.idunit = class_to_unit.idunit and class_to_unit.idclass = takesclass.idclass and takesclass.idstudent = user.iduser and user.loginname = '" . $_SESSION['loginname'] . "' order by unit.name";
			$db->query($sql);
			while ($db->next_record()){
				$idunit = $db->Record['idunit'];
				$unitname = $db->Record['name'];
				
				$parenpos = strpos($unitname,"(");   //GWS 1/3/08 - removing parentheses and indeces from titles
				if ($parenpos !== false) {
				   $unitname = substr($unitname ,0,$parenpos);	
				} else { 
  				   $unitname = $unitname; 
	                        } 


				$select = "";
				if($idunit!=$uid){
		?>
                <option value="<?= $idunit?>"> 
                <?= htmlentities($unitname)?>
                </option>
                <?php
				}
			}
		?>
              </select></td>
          <td>  <select name="idtopic" onChange="topicChanged();">
              <option value="<?=(($tid==null)?0:$tid)?>">Change topic</option>
              <?php
			$tname=null;
			if($uid != null){
				$sql="select idtopic,name from TOPIC where idunit=".$uid." order by name";
				$db->query($sql);
				while ($db->next_record()){
					$idtopic = $db->Record['idtopic'];
					$topicname = $db->Record['name'];

					$parenpos = strpos($topicname,"(");   //GWS 1/3/08 - removing parentheses and indeces from titles
					if ($parenpos !== false) {
					   $topicname = substr($topicname,0,$parenpos);	
					} else { 
  					   $topicname = $topicname;
	                      		} 

					$select = "";
					if($idtopic!=$tid){
			?>
				  <option value="<?= $idtopic?>" >
				  <?= htmlentities($topicname)?>
				  </option>
				  <?php
				  }
				  else
				  $tname=$topicname;
				}
			}
		?>
            </select> </td>
		
          <?php
		  if($tid !=null && $cid != null){
		  ?>
		  	 
            <td> <span class="otherlabel">Go to: <a href="#" class="logout" onClick="window.parent.document.mapApplet.shareddata.setMap(<?= $uid?>,<?= $tid?>,null,2);"> 
              <?=$tname?>
              </a></span></td>
		  <?php
		  }
		if($cid != null){
			$sql="select general_title name from CONCEPT where idconcept=".$cid;
			$db->query($sql);
			$db->next_record();
			$cname=$db->Record['name'];

			$parenpos = strpos($cname,"(");   //GWS 1/3/08 - removing parentheses and indeces from titles
			if ($parenpos !== false) {
			   $cname = substr($cname,0,$parenpos);	
			} else { 
  			   $cname = $cname;
	                } 

		 /*
		?>
		  <td> <span class="otherlabel">Current concept: <?=$cname?></span></td>
          <?
		*/
		}
/*
		if($eid != null){
			$sql="select name from EXAMPLE where idconcept=".$eid;
			$db->query($sql);
			$db->next_record();
			$ename=$db->Record['name'];
		?>
		  <td> <span class="otherlabel">Current example: <?=$ename?></span></td>
          <?
		}
*/
		?>
					<td> <span class="otherlabel">Search</span> 
						<input name="key" type="text" class="unit" size="15">
						<input name="uid" type="hidden" value="<?=$uid?>"/>
            <input type="submit" name="Submit" value="Go"> </td>
            <td> <span class="otherlabel"><a href="###" class="logout" onClick="MM_openBrWindow('history.php','loghistory','scrollbars=yes,resizable=yes,width=300,height=500')">History</a></span> 
            </td>
	<?php
	   if ($_SESSION['idclass'] != 194 && $_SESSION['idclass'] != 198) {
	?>
            <td> <span class="otherlabel"><a href="###" class="logout" onClick="MM_openBrWindow('navgraph.php','graph','scrollbars=yes,resizable=yes,width=1150,height=650')">Graph</a></span> 
            </td>

	<?php	
		}
        ?> 
	    <td> <span class="otherlabel"><a class="logout" href="selectunit.php" TARGET="_parent">Top Page</a></span> 
          </td>
          <td> <span class="otherlabel"><a class="logout" href="logout.php">Logout</a></span> 
          </td>
        </tr>
      </table>
</td>
  </tr>
  <tr valign="top"> 
    <td width="50%" colspan="2" class="otheroptions"> <table class="otheroptions" width="100%" cellpadding="0" cellspacing="5">
        <tr > 
          <td height="20" > 
            <?php
	if($barType ==1 ){
		?>
            Please choose one topic from the map below or from the topic list. 
            <?php
			}
	else if($barType ==2 ){
		?>
            Please choose one concept from the map below or change the current 
            topic from the topic list. 
            <?php
			}
	else if($eid == null){
		?>
            <table width="100%" align="left" cellpadding="0" cellspacing="5" class="otheroptions">
              <tr valign="top">
                <td colspan="2" class="otherlabel"><span class="concept"> </span> 
                  <?php
	if($barType ==3 ){
		?>
                  You can refer to the <a href="#" onClick="gotoGeneral();">definition</a>  of
                  <span class="concept"> 
                  <?=$cname?>
                  </span> 
                  <?php
	}
		?>
                </td>
  </tr>
              <tr align="left" valign="top"> 
                <td class="otherlabel" colspan="2" id="othertopics">You can also read about 
                  <span class="concept"> 
                  <?=$cname?>
                  </span> 
                  in 
                  <?=($barType==3?"other ":"")?>
                  topics: 
                  <?php
			// GWS - updated to display only the topics corresponding to units for the current class
			//$sql="select distinct(cr.idtopic) tid,t.name tname,u.idunit uid from CONCEPTRELATION cr,TOPIC t,UNIT u where (cr.conceptfrom=".$cid." or cr.conceptto=".$cid.") and cr.idtopic=t.idtopic and t.idunit=u.idunit order by cr.idtopic,t.name";

		if ($uid) {
			// update (balaji) : show only those topics from the same unit
			$sql = "select distinct(cr.idtopic) tid,t.name tname,u.idunit uid from compass_mt.CONCEPTRELATION cr,compass_mt.TOPIC t,compass_mt.UNIT u where (cr.conceptfrom=".$cid." or cr.conceptto=".$cid.") and cr.idtopic=t.idtopic and t.idunit=u.idunit and u.idunit = " . $uid;
		} else {
			$sql="select distinct(cr.idtopic) tid,t.name tname,u.idunit uid from CONCEPTRELATION cr,TOPIC t,UNIT u, class_to_unit, takesclass, user where ((cr.conceptfrom=".$cid." or cr.conceptto=".$cid.") and cr.idtopic=t.idtopic and t.idunit=u.idunit) and (u.idunit = class_to_unit.idunit and class_to_unit.idclass = takesclass.idclass and takesclass.idstudent and takesclass.idstudent = user.iduser and user.loginname = '" . $_SESSION['loginname'] . "') order by cr.idtopic,t.name";
		}
	
			$db->query($sql);
			$num_t = 0;
			while ($db->next_record()){
				$idunit = $db->Record['uid'];
				$idtopic = $db->Record['tid'];
				$topicname = $db->Record['tname'];

				$parenpos = strpos($topicname,"(");   //GWS 1/3/08 - removing parentheses and indeces from titles
				if ($parenpos !== false) {
				   $topicname = substr($topicname,0,$parenpos);	
				} else { 
  				   $topicname = $topicname;
	                      	} 

				if($barType ==3 ){
					if($tid == $idtopic)
						continue;
				}
				$num_t++;
	?>
                  <a href="#" onClick="gotoRelatedTopic(<?=$idunit?>,<?=$idtopic?>)">
                  <?=$topicname?>
                  </a>&nbsp;&nbsp; 
                  <?php
			}
	?>
                </td>
	</tr>
<?php
			if ($num_t == 0) {
?>
				<script type="text/javascript"> 
				var tdel = document.getElementById("othertopics");
					if (tdel) { tdel.innerHTML = "  "; }
			  </script>
<?php
			}
?>

<?php
/*
?>
		add example here
  <tr valign="top">
          <td height="20"colspan="2" class="otherlabel">examples:
                  <?
			$sql="select e.idexample eid,e.name ename from EXAMPLE e,EXAMPLE_HAS_CONCEPT ehc where e.idexample=ehc.idexample and ehc.idconcept=".$cid." order by e.name";
			$db->query($sql);
			while ($db->next_record()){
				$idexample = $db->Record['eid'];
				$examplename = $db->Record['ename'];
?>
                  <a href="#" onClick="gotoExample(<?=$idexample?>)"> 
                  <?=$examplename?>
                  </a>&nbsp;&nbsp; 
                  <?
			}

?>
                </td>
  </tr>
<?
*/
?>
</table>		
		<?php
			}
		else{
		?>
		    <table class="otheroptions" width="100%" cellpadding="0" cellspacing="5">
              <tr valign="top"> 
                <td class="otherlabel">Related concepts:</td>
                <td class="topic"> 
<?php
			$sql="select c.general_title cname,c.idconcept cid from CONCEPT c,EXAMPLE_HAS_CONCEPT ehc where c.idconcept=ehc.idconcept and ehc.idexample=".$eid." order by c.general_title";
			$db->query($sql);
			while ($db->next_record()){
				$idconcept = $db->Record['cid'];
				$conceptname = $db->Record['cname'];

				$parenpos = strpos($conceptname,"(");   //GWS 1/3/08 - removing parentheses and indeces from titles
				if ($parenpos !== false) {
				   $conceptname = substr($conceptname,0,$parenpos);	
				} else { 
  				   $conceptname = $conceptname;
	                      	} 
?>
    	<a href="###" onClick="gotoExample(<?=$idexample?>)"><?=$examplename?></a>&nbsp;&nbsp;
<?php
			}
?>
                </td>
              </tr>
            </table>
		<?php
		}
			?>
			</td>
<td>
<?php
	if ($_SESSION['loginname'] == 'testtest') {

		$explorationid = $_SESSION['idexploration'];

		include "prompts/prompt.php";

//		if ($_SESSION['loginname'] == 'testtest') { $debug = 1; }
		//		else { $debug = 0; }
		$return_array = get_recommendations($explorationid, $uid, $tid, $cid, $debug);		
		echo "(Number of clicks = $return_array[2], percentage of goal concepts = $return_array[4])<br/>";
		echo "(Goal = $return_array[1])<br/>";
?>

<applet 
	name = "promptsapplet"
	id = "promptsapplet"
	codebase = "/compass/student/prompts/"
		code="jesstest.class" 
		archive = "jesstest.jar"
		width="250" height="100">
	<param name="paramStr" value="hihi"/>
	<param name="setgoal" value="<?=$return_array[1]?>"/>
	<param name="num_moves" value="<?=$return_array[2]?>"/>
	<param name="moves" value="<?=$return_array[3]?>"/>
	<param name="percent_visited" value="<?=$return_array[4]?>"/>
	<param name="random_browsing" value="<?=$return_array[5]?>"/>
	<param name="goal_last_visited" value="<?=$return_array[6]?>"/>
</applet>

<?php
} // end if testtest
?>

</td>
        </tr>
      </table></td>
  </tr>
</table>
</form>
<?php
}

?>

</body>
</html>
<?php
}
//}
?>