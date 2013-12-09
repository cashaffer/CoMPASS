<?php
session_start();
if ($_SESSION['loginname'] == null)
	header("location:/compass/error_code.php?code=001"); 
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(8))
		header("location:/compass/error_code.php?code=004"); 
}	

include "db_mysql_mt.inc"; 
include "config.inc"; 
	
$db = new DB_Sql;

$db->connect();

$idteacher = ($_REQUEST['idteacher']==null?0:$_REQUEST['idteacher']);
$idclass = ($_REQUEST['idclass']==null?0:$_REQUEST['idclass']);
$idgroup = ($_REQUEST['idgroup']==null?0:$_REQUEST['idgroup']);
$idstudent = ($_REQUEST['idstudent']==null?0:$_REQUEST['idstudent']);
$fromtime = ($_REQUEST['fromtime']==null?"":$_REQUEST['fromtime']);
$totime = ($_REQUEST['totime']==null?"":$_REQUEST['totime']);
$idtopic = ($_REQUEST['idtopic']==null?0:$_REQUEST['idtopic']);
$place = ($_REQUEST['place']==null?1:$_REQUEST['place']);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script language="JavaScript" type="text/JavaScript">
</script>
</head>
<link rel="stylesheet" href="../../css/compass.css" type="text/css" media=screen>
<body>
<center>
  <?
if($idstudent!=0){
	$sql="select sum(ld.timelength) totaltime from LOGDATA ld,EXPLORATION e where e.idexploration=ld.idexploration and e.idstudent=".$idstudent." and e.place=".$place." and e.idclass=".$idclass;
		if($fromtime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')>='".$fromtime."'";
		if($totime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')<='".$totime."'";

	$db->query($sql);
	$db->next_record();
	$totaltime = $db->Record['totaltime'];
	if($totaltime==0){
		echo("No log data found!");
	}
	else{
		$sql="select loginname,firstname,lastname from USER where iduser=".$idstudent;
		$db->query($sql);
		$db->next_record();
		$loginname=$db->Record['loginname'];
		$firstname=$db->Record['firstname'];
		$lastname=$db->Record['lastname'];
		$sql="select c.name cname,g.name gname,u.loginname tname from CLASS c,STUDYGROUP g,USER u  where c.idclass=".$idclass." and g.idgroup=".$idgroup." and c.idclass=g.idclass and c.idteacher=u.iduser";
		$db->query($sql);
		$db->next_record();
		$cname=$db->Record['cname'];
		$gname=$db->Record['gname'];
		$tname=$db->Record['tname'];
		if($idtopic ==0)
			$sql="select count(ld.idconcept) visitcount,sum(ld.timelength) visittime,c.general_title cname from LOGDATA ld,EXPLORATION e,CONCEPT c where ld.timelength is not null and ld.idconcept=c.idconcept and e.idexploration=ld.idexploration and e.idstudent=".$idstudent." and e.idclass=".$idclass." and e.place=".$place." and ld.idconcept is not null and ld.idexample is null";
		else
			$sql="select count(ld.idconcept) visitcount,sum(ld.timelength) visittime,c.general_title cname from LOGDATA ld,EXPLORATION e,CONCEPT c,CONCEPTINTOPIC tc where ld.timelength is not null and tc.idtopic=".$idtopic." and tc.idconcept=ld.idconcept and ld.idtopic=".$idtopic." and ld.idconcept=c.idconcept and e.idexploration=ld.idexploration and e.idstudent=".$idstudent." and e.idclass=".$idclass." and e.place=".$place." and ld.idconcept is not null and ld.idexample is null";
		if($fromtime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')>='".$fromtime."'";
		if($totime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')<='".$totime."'";

		$sql.=" group by ld.idconcept";
		$db->query($sql);		

?>
  <table width="80%" border="1" cellspacing="0" cellpadding="0">
    <tr> 
      <td colspan="5" class="tabletitle"> 
        <p>Student Name: 
          <?=$firstname." ".$lastname." (".$loginname.")"?>
          <br>
          Class Name: 
          <?=$cname?>
          &nbsp;&nbsp;(Teacher: 
          <?=$tname?>
          )<br>
          Group Name: 
          <?=$gname?>
          <?
	if($fromtime!=""){
?>
          <br>
          Logged on after: 
          <?=$fromtime?>
          <?
	}
	if($totime!=""){
?>
          <br>
          Logged on before: 
          <?=$totime?>
          <?
	}
?>
          <br>
          Total time using Compass: 
          <?=$totaltime?>
          second(s) <br>
        </p></td>
    </tr>
    <tr bgcolor="#E3EFFD" class="tabletitle"> 
      <td>Concept</td>
      <td>Total Time (s)</td>
      <td>Average Time (s)</td>
      <td>Time Proportion (%)</td>
      <td>Visit Count</td>
    </tr>
    <?php
	$bgcolor = "#FFFFDD";
	$count = true;
	while($db->next_record()){
		$bgcolor = ($count?"#FFFFFF":"#FFFFDD");
?>
    <tr align="center" bgcolor="<?= $bgcolor?>" class="f12b"> 
      <td height="22"> 
        <?= ($db->Record['cname']==null?"N/A":$db->Record['cname'])?>
      </td>
      <td> 
        <?= $db->Record['visittime']?>
      </td>
      <td> 
        <?= round($db->Record['visittime']/$db->Record['visitcount'])?>
      </td>
      <td> 
        <?= round($db->Record['visittime']/$totaltime*100,2)?>
      </td>
      <td> 
        <?=$db->Record['visitcount']?>
      </td>
    </tr>
    <?php
	$count = !$count;
	}
?>
    <tr > 
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr bgcolor="#E3EFFD" class="tabletitle"> 
      <td>Topic</td>
      <td>Total Time (s)</td>
      <td>Average Time (s)</td>
      <td>Time Proportion (%)</td>
      <td>Visit Count</td>
    </tr>
    <?php
		if($idtopic ==0)
			$sql="select count(ld.idtopic) visitcount,sum(ld.timelength) visittime,t.name tname from LOGDATA ld,EXPLORATION e,TOPIC t where ld.timelength is not null and ld.idtopic=t.idtopic and e.idexploration=ld.idexploration and e.idstudent=".$idstudent." and e.idclass=".$idclass." and e.place=".$place." and ld.idtopic is not null and ld.idexample is null and ld.idconcept is null";
		else
			$sql="select count(ld.idtopic) visitcount,sum(ld.timelength) visittime,t.name tname from LOGDATA ld,EXPLORATION e,TOPIC t where ld.timelength is not null and ld.idtopic=t.idtopic and e.idexploration=ld.idexploration and e.idstudent=".$idstudent." and e.idclass=".$idclass." and e.place=".$place." and ld.idtopic=".$idtopic." and ld.idexample is null and ld.idconcept is null";
		if($fromtime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')>='".$fromtime."'";
		if($totime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')<='".$totime."'";

		$sql.=" group by ld.idtopic";
		$db->query($sql);		
	$bgcolor = "#FFFFDD";
	$count = true;
	while($db->next_record()){
		$bgcolor = ($count?"#FFFFFF":"#FFFFDD");
?>
    <tr align="center" bgcolor="<?= $bgcolor?>" class="f12b"> 
      <td height="22"> 
        <?= ($db->Record['tname']==null?"N/A":$db->Record['tname'])?>
      </td>
      <td> 
        <?= $db->Record['visittime']?>
      </td>
      <td> 
        <?= round($db->Record['visittime']/$db->Record['visitcount'])?>
      </td>
      <td> 
        <?= round($db->Record['visittime']/$totaltime*100,2)?>
      </td>
      <td> 
        <?=$db->Record['visitcount']?>
      </td>
    </tr>
    <?php
	$count = !$count;
	}
?>
  </table>
<?
	}
}
else if($idgroup!=0){
	$sql="select sum(ld.timelength) totaltime from LOGDATA ld,EXPLORATION e,GROUPMEMBERS gm where e.idexploration=ld.idexploration and e.idstudent=gm.idstudent and e.idclass=".$idclass." and e.place=".$place." and gm.idgroup=".$idgroup;
		if($fromtime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')>='".$fromtime."'";
		if($totime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')<='".$totime."'";

	$db->query($sql);
	$db->next_record();
	$totaltime = $db->Record['totaltime'];
	if($totaltime==0){
		echo("No log data found!");
	}
	else{
		$sql="select c.name cname,g.name gname,u.loginname tname from CLASS c,STUDYGROUP g,USER u  where c.idclass=".$idclass." and g.idgroup=".$idgroup." and c.idclass=g.idclass and c.idteacher=u.iduser";
		$db->query($sql);
		$db->next_record();
		$cname=$db->Record['cname'];
		$gname=$db->Record['gname'];
		$tname=$db->Record['tname'];
		if($idtopic ==0)
			$sql="select count(ld.idconcept) visitcount,sum(ld.timelength) visittime,c.general_title cname from LOGDATA ld,EXPLORATION e,CONCEPT c,GROUPMEMBERS gm where ld.timelength is not null and ld.idconcept=c.idconcept and e.idexploration=ld.idexploration and e.idstudent=gm.idstudent and gm.idgroup=".$idgroup." and e.idclass=".$idclass." and e.place=".$place." and ld.idconcept is not null and ld.idexample is null";
		else
			$sql="select count(ld.idconcept) visitcount,sum(ld.timelength) visittime,c.general_title cname from LOGDATA ld,EXPLORATION e,CONCEPT c,CONCEPTINTOPIC tc,GROUPMEMBERS gm where ld.timelength is not null and tc.idtopic=".$idtopic." and tc.idconcept=ld.idconcept and  ld.idconcept=c.idconcept and ld.idtopic=".$idtopic." and e.idexploration=ld.idexploration and e.idstudent=gm.idstudent and gm.idgroup=".$idgroup." and e.idclass=".$idclass." and e.place=".$place." and ld.idconcept is not null and ld.idexample is null";
		if($fromtime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')>='".$fromtime."'";
		if($totime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')<='".$totime."'";

		$sql.=" group by ld.idconcept";
		$db->query($sql);		

?>
  <table width="80%" border="1" cellspacing="0" cellpadding="0">
    <tr> 
            <td colspan="5" class="tabletitle">
		<p> Class Name: 
          <?=$cname?>
          &nbsp;&nbsp;(Teacher: 
          <?=$tname?>
          )<br>
          Group Name: 
          <?=$gname?>
          <?
	if($fromtime!=""){
?>
          <br>
          Logged on after: 
          <?=$fromtime?>
          <?
	}
	if($totime!=""){
?>
          <br>
          Logged on before: 
          <?=$totime?>
          <?
	}
?>
          <br>
          Total time using Compass: 
          <?=$totaltime?>
          second(s) <br>
        </p></td>
    </tr>
    <tr bgcolor="#E3EFFD" class="tabletitle"> 
      <td>Concept</td>
      <td>Total Time (s)</td>
      <td>Average Time (s)</td>
      <td>Time Proportion (%)</td>
      <td>Visit Count</td>
    </tr>
    <?php
	$bgcolor = "#FFFFDD";
	$count = true;
	while($db->next_record()){
		$bgcolor = ($count?"#FFFFFF":"#FFFFDD");
?>
    <tr align="center" bgcolor="<?= $bgcolor?>" class="f12b"> 
      <td height="22"> 
        <?= ($db->Record['cname']==null?"N/A":$db->Record['cname'])?>
      </td>
      <td> 
        <?= $db->Record['visittime']?>
      </td>
      <td> 
        <?= round($db->Record['visittime']/$db->Record['visitcount'])?>
      </td>
      <td> 
        <?= round($db->Record['visittime']/$totaltime*100,2)?>
      </td>
      <td> 
        <?=$db->Record['visitcount']?>
      </td>
    </tr>
    <?php
	$count = !$count;
	}
?>
    <tr > 
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr bgcolor="#E3EFFD" class="tabletitle"> 
      <td>Topic</td>
      <td>Total Time (s)</td>
      <td>Average Time (s)</td>
      <td>Time Proportion (%)</td>
      <td>Visit Count</td>
    </tr>
    <?php
		if($idtopic ==0)
			$sql="select count(ld.idtopic) visitcount,sum(ld.timelength) visittime,t.name tname from LOGDATA ld,EXPLORATION e,TOPIC t,GROUPMEMBERS gm where ld.timelength is not null and ld.idtopic=t.idtopic and e.idexploration=ld.idexploration and e.idstudent=gm.idstudent and gm.idgroup=".$idgroup." and e.idclass=".$idclass." and e.place=".$place." and ld.idtopic is not null and ld.idexample is null and ld.idconcept is null";
		else
			$sql="select count(ld.idtopic) visitcount,sum(ld.timelength) visittime,t.name tname from LOGDATA ld,EXPLORATION e,TOPIC t,GROUPMEMBERS gm where ld.timelength is not null and ld.idtopic=t.idtopic and e.idexploration=ld.idexploration and e.idstudent=gm.idstudent and gm.idgroup=".$idgroup." and e.idclass=".$idclass." and e.place=".$place." and ld.idtopic=".$idtopic." and ld.idexample is null and ld.idconcept is null";
		if($fromtime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')>='".$fromtime."'";
		if($totime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')<='".$totime."'";

		$sql.=" group by ld.idtopic";
		$db->query($sql);		
	$bgcolor = "#FFFFDD";
	$count = true;
	while($db->next_record()){
		$bgcolor = ($count?"#FFFFFF":"#FFFFDD");
?>
    <tr align="center" bgcolor="<?= $bgcolor?>" class="f12b"> 
      <td height="22"> 
        <?= ($db->Record['tname']==null?"N/A":$db->Record['tname'])?>
      </td>
      <td> 
        <?= $db->Record['visittime']?>
      </td>
      <td> 
        <?= round($db->Record['visittime']/$db->Record['visitcount'])?>
      </td>
      <td> 
        <?= round($db->Record['visittime']/$totaltime*100,2)?>
      </td>
      <td> 
        <?=$db->Record['visitcount']?>
      </td>
    </tr>
    <?php
	$count = !$count;
	}
?>
  </table>
  <?
	}
}
else if($idclass!=0){
	$sql="select sum(ld.timelength) totaltime from LOGDATA ld,EXPLORATION e where e.idexploration=ld.idexploration and e.place=".$place." and e.idclass=".$idclass;
		if($fromtime !="")
		$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')>='".$fromtime."'";
	if($totime !="")
		$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')<='".$totime."'";

	$db->query($sql);
	$db->next_record();
	$totaltime = $db->Record['totaltime'];
	if($totaltime==0){
		echo("No log data found!");
	}
	else{
		$sql="select c.name cname,u.loginname tname from CLASS c,USER u  where c.idclass=".$idclass." and c.idteacher=u.iduser";
		$db->query($sql);
		$db->next_record();
		$cname=$db->Record['cname'];
		$tname=$db->Record['tname'];
		if($idtopic ==0)
			$sql="select count(ld.idconcept) visitcount,sum(ld.timelength) visittime,c.general_title cname from LOGDATA ld,EXPLORATION e,CONCEPT c where ld.timelength is not null and ld.idconcept=c.idconcept and e.idexploration=ld.idexploration and e.idclass=".$idclass." and e.place=".$place." and ld.idconcept is not null and ld.idexample is null";
		else
			$sql="select count(ld.idconcept) visitcount,sum(ld.timelength) visittime,c.general_title cname from LOGDATA ld,EXPLORATION e,CONCEPT c,CONCEPTINTOPIC tc where ld.timelength is not null and tc.idtopic=".$idtopic." and tc.idconcept=ld.idconcept and  ld.idconcept=c.idconcept and ld.idtopic=".$idtopic." and e.idexploration=ld.idexploration and e.idclass=".$idclass." and e.place=".$place." and ld.idconcept is not null and ld.idexample is null";
		if($fromtime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')>='".$fromtime."'";
		if($totime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')<='".$totime."'";

		$sql.=" group by ld.idconcept";
		$db->query($sql);		

?>
  <table width="80%" border="1" cellspacing="0" cellpadding="0">
    <tr> 
      <td colspan="5" class="tabletitle">
	  <p> Class Name: 
          <?=$cname?>
          &nbsp;&nbsp;(Teacher: 
          <?=$tname?>
          )<br>
          Group Name: 
          <?=$gname?>
          <?
	if($fromtime!=""){
?>
          <br>
          Logged on after: 
          <?=$fromtime?>
          <?
	}
	if($totime!=""){
?>
          <br>
          Logged on before: 
          <?=$totime?>
          <?
	}
?>
          <br>
          Total time using Compass : 
          <?=$totaltime?>
          second(s) <br>
        </p></td>
    </tr>
    <tr bgcolor="#E3EFFD" class="tabletitle"> 
      <td>Concept</td>
      <td>Total Time (s)</td>
      <td>Average Time (s)</td>
      <td>Time Proportion (%)</td>
      <td>Visit Count</td>
    </tr>
    <?php
	$bgcolor = "#FFFFDD";
	$count = true;
	while($db->next_record()){
		$bgcolor = ($count?"#FFFFFF":"#FFFFDD");
?>
    <tr align="center" bgcolor="<?= $bgcolor?>" class="f12b"> 
      <td height="22"> 
        <?= ($db->Record['cname']==null?"N/A":$db->Record['cname'])?>
      </td>
      <td> 
        <?= $db->Record['visittime']?>
      </td>
      <td> 
        <?= round($db->Record['visittime']/$db->Record['visitcount'])?>
      </td>
      <td> 
        <?= round($db->Record['visittime']/$totaltime*100,2)?>
      </td>
      <td> 
        <?=$db->Record['visitcount']?>
      </td>
    </tr>
    <?php
	$count = !$count;
	}
?>
    <tr > 
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr bgcolor="#E3EFFD" class="tabletitle"> 
      <td>Topic</td>
      <td>Total Time (s)</td>
      <td>Average Time (s)</td>
      <td>Time Proportion (%)</td>
      <td>Visit Count</td>
    </tr>
    <?php
		if($idtopic ==0)
			$sql="select count(ld.idtopic) visitcount,sum(ld.timelength) visittime,t.name tname from LOGDATA ld,EXPLORATION e,TOPIC t where ld.timelength is not null and ld.idtopic=t.idtopic and e.idexploration=ld.idexploration and e.idclass=".$idclass." and e.place=".$place." and ld.idtopic is not null and ld.idexample is null and ld.idconcept is null";
		else
			$sql="select count(ld.idtopic) visitcount,sum(ld.timelength) visittime,t.name tname from LOGDATA ld,EXPLORATION e,TOPIC t where ld.timelength is not null and ld.idtopic=t.idtopic and e.idexploration=ld.idexploration and e.idclass=".$idclass." and e.place=".$place." and ld.idtopic=".$idtopic." and ld.idexample is null and ld.idconcept is null";
		if($fromtime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')>='".$fromtime."'";
		if($totime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')<='".$totime."'";

		$sql.=" group by ld.idtopic";
		$db->query($sql);		
	$bgcolor = "#FFFFDD";
	$count = true;
	while($db->next_record()){
		$bgcolor = ($count?"#FFFFFF":"#FFFFDD");
?>
    <tr align="center" bgcolor="<?= $bgcolor?>" class="f12b"> 
      <td height="22"> 
        <?= ($db->Record['tname']==null?"N/A":$db->Record['tname'])?>
      </td>
      <td> 
        <?= $db->Record['visittime']?>
      </td>
      <td> 
        <?= round($db->Record['visittime']/$db->Record['visitcount'])?>
      </td>
      <td> 
        <?= round($db->Record['visittime']/$totaltime*100,2)?>
      </td>
      <td> 
        <?=$db->Record['visitcount']?>
      </td>
    </tr>
    <?php
	$count = !$count;
	}
?>
  </table>
  <?
	}
}
else if($idteacher!=0){
	$sql="select sum(ld.timelength) totaltime from LOGDATA ld,EXPLORATION e,CLASS c where e.idexploration=ld.idexploration and e.idclass=c.idclass and e.place=".$place." and c.idteacher=".$idteacher;
		if($fromtime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')>='".$fromtime."'";
		if($totime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')<='".$totime."'";

	$db->query($sql);
	$db->next_record();
	$totaltime = $db->Record['totaltime'];
	if($totaltime==0){
		echo("No log data found!");
	}
	else{
		$sql="select u.loginname tname from USER u  where u.iduser=".$idteacher;
		$db->query($sql);
		$db->next_record();
		$cname=$db->Record['cname'];
		$tname=$db->Record['tname'];
		if($idtopic ==0)
			$sql="select count(ld.idconcept) visitcount,sum(ld.timelength) visittime,c.general_title cname from LOGDATA ld,EXPLORATION e,CONCEPT c,CLASS cs where ld.timelength is not null and ld.idconcept=c.idconcept and e.idexploration=ld.idexploration and e.idclass=cs.idclass and e.place=".$place." and cs.idteacher=".$idteacher." and ld.idconcept is not null and ld.idexample is null";
		else
			$sql="select count(ld.idconcept) visitcount,sum(ld.timelength) visittime,c.general_title cname from LOGDATA ld,EXPLORATION e,CONCEPT c,CONCEPTINTOPIC tc,CLASS cs where ld.timelength is not null and tc.idtopic=".$idtopic." and tc.idconcept=ld.idconcept and ld.idtopic=".$idtopic." and ld.idconcept=c.idconcept and e.idexploration=ld.idexploration and e.idclass=cs.idclass and e.place=".$place." and cs.idteacher=".$idteacher." and ld.idconcept is not null and ld.idexample is null";
		if($fromtime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')>='".$fromtime."'";
		if($totime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')<='".$totime."'";

		$sql.=" group by ld.idconcept";
		$db->query($sql);		

?>
  <table width="80%" border="1" cellspacing="0" cellpadding="0">
    <tr> 
      <td colspan="5" class="tabletitle">
	  <p> Teacher: 
          <?=$tname?>
          <?
	if($fromtime!=""){
?>
          <br>
          Logged on after: 
          <?=$fromtime?>
          <?
	}
	if($totime!=""){
?>
          <br>
          Logged on before: 
          <?=$totime?>
          <?
	}
?>
          <br>
          Total time using Compass: 
          <?=$totaltime?>
          second(s) <br>
        </p></td>
    </tr>
    <tr bgcolor="#E3EFFD" class="tabletitle"> 
      <td>Concept</td>
      <td>Total Time (s)</td>
      <td>Average Time (s)</td>
      <td>Time Proportion (%)</td>
      <td>Visit Count</td>
    </tr>
    <?php
	$bgcolor = "#FFFFDD";
	$count = true;
	while($db->next_record()){
		$bgcolor = ($count?"#FFFFFF":"#FFFFDD");
?>
    <tr align="center" bgcolor="<?= $bgcolor?>" class="f12b"> 
      <td height="22"> 
        <?= ($db->Record['cname']==null?"N/A":$db->Record['cname'])?>
      </td>
      <td> 
        <?= $db->Record['visittime']?>
      </td>
      <td> 
        <?= round($db->Record['visittime']/$db->Record['visitcount'])?>
      </td>
      <td> 
        <?= round($db->Record['visittime']/$totaltime*100,2)?>
      </td>
      <td> 
        <?=$db->Record['visitcount']?>
      </td>
    </tr>
    <?php
	$count = !$count;
	}
?>
    <tr > 
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr bgcolor="#E3EFFD" class="tabletitle"> 
      <td>Topic</td>
      <td>Total Time (s)</td>
      <td>Average Time (s)</td>
      <td>Time Proportion (%)</td>
      <td>Visit Count</td>
    </tr>
    <?php
		if($idtopic ==0)
			$sql="select count(ld.idtopic) visitcount,sum(ld.timelength) visittime,t.name tname from LOGDATA ld,EXPLORATION e,TOPIC t,CLASS cs where ld.timelength is not null and ld.idtopic=t.idtopic and e.idexploration=ld.idexploration and e.idclass=cs.idclass and e.place=".$place." and cs.idteacher=".$idteacher." and ld.idtopic is not null and ld.idexample is null and ld.idconcept is null";
		else
			$sql="select count(ld.idtopic) visitcount,sum(ld.timelength) visittime,t.name tname from LOGDATA ld,EXPLORATION e,TOPIC t,CLASS cs where ld.timelength is not null and ld.idtopic=t.idtopic and e.idexploration=ld.idexploration and e.idclass=cs.idclass and e.place=".$place." and cs.idteacher=".$idteacher." and ld.idtopic=".$idtopic." and ld.idexample is null and ld.idconcept is null";
		if($fromtime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')>='".$fromtime."'";
		if($totime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')<='".$totime."'";

		$sql.=" group by ld.idtopic";
		$db->query($sql);		
	$bgcolor = "#FFFFDD";
	$count = true;
	while($db->next_record()){
		$bgcolor = ($count?"#FFFFFF":"#FFFFDD");
?>
    <tr align="center" bgcolor="<?= $bgcolor?>" class="f12b"> 
      <td height="22"> 
        <?= ($db->Record['tname']==null?"N/A":$db->Record['tname'])?>
      </td>
      <td> 
        <?= $db->Record['visittime']?>
      </td>
      <td> 
        <?= round($db->Record['visittime']/$db->Record['visitcount'])?>
      </td>
      <td> 
        <?= round($db->Record['visittime']/$totaltime*100,2)?>
      </td>
      <td> 
        <?=$db->Record['visitcount']?>
      </td>
    </tr>
    <?php
	$count = !$count;
	}
?>
  </table>
  <?
	}
}
else {
	$sql="select sum(ld.timelength) totaltime from LOGDATA ld,EXPLORATION e where e.idexploration=ld.idexploration and e.place=".$place;
		if($fromtime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')<='".$fromtime."'";
		if($totime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')<='".$totime."'";

	$db->query($sql);
	$db->next_record();
	$totaltime = $db->Record['totaltime'];
	if($totaltime==0){
		echo("No log data found!");
	}
	else{
		if($idtopic ==0)
			$sql="select count(ld.idconcept) visitcount,sum(ld.timelength) visittime,c.general_title cname from LOGDATA ld,EXPLORATION e,CONCEPT c where ld.timelength is not null and ld.idconcept=c.idconcept and e.idexploration=ld.idexploration and e.place=".$place." and ld.idconcept is not null and ld.idexample is null";
		else
			$sql="select count(ld.idconcept) visitcount,sum(ld.timelength) visittime,c.general_title cname from LOGDATA ld,EXPLORATION e,CONCEPT c,CONCEPTINTOPIC tc where ld.timelength is not null and tc.idtopic=".$idtopic." and tc.idconcept=ld.idconcept and ld.idtopic=".$idtopic." and ld.idconcept=c.idconcept and e.idexploration=ld.idexploration and e.place=".$place." and ld.idconcept is not null and ld.idexample is null";
		if($fromtime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')>='".$fromtime."'";
		if($totime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')<='".$totime."'";

		$sql.=" group by ld.idconcept";
		$db->query($sql);		

?>
  <table width="80%" border="1" cellspacing="0" cellpadding="0">
    <tr> 
      <td colspan="5" class="tabletitle">
	  <p> 
          <?
	if($fromtime!=""){
?>
          <br>
          Logged on after: 
          <?=$fromtime?>
          <?
	}
	if($totime!=""){
?>
          <br>
          Logged on before: 
          <?=$totime?>
          <?
	}
?>
          <br>
          Total time using Compass: 
          <?=$totaltime?>
          second(s) <br>
        </p></td>
    </tr>
    <tr bgcolor="#E3EFFD" class="tabletitle"> 
      <td>Concept</td>
      <td>Total Time (s)</td>
      <td>Average Time (s)</td>
      <td>Time Proportion (%)</td>
      <td>Visit Count</td>
    </tr>
    <?php
	$bgcolor = "#FFFFDD";
	$count = true;
	while($db->next_record()){
		$bgcolor = ($count?"#FFFFFF":"#FFFFDD");
?>
    <tr align="center" bgcolor="<?= $bgcolor?>" class="f12b"> 
      <td height="22"> 
        <?= ($db->Record['cname']==null?"N/A":$db->Record['cname'])?>
      </td>
      <td> 
        <?= $db->Record['visittime']?>
      </td>
      <td> 
        <?= round($db->Record['visittime']/$db->Record['visitcount'])?>
      </td>
      <td> 
        <?= round($db->Record['visittime']/$totaltime*100,2)?>
      </td>
      <td> 
        <?=$db->Record['visitcount']?>
      </td>
    </tr>
    <?php
	$count = !$count;
	}
?>
    <tr > 
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr bgcolor="#E3EFFD" class="tabletitle"> 
      <td>Topic</td>
      <td>Total Time (s)</td>
      <td>Average Time (s)</td>
      <td>Time Proportion (%)</td>
      <td>Visit Count</td>
    </tr>
    <?php
		if($idtopic ==0)
			$sql="select count(ld.idtopic) visitcount,sum(ld.timelength) visittime,t.name tname from LOGDATA ld,EXPLORATION e,TOPIC t where ld.timelength is not null and ld.idtopic=t.idtopic and e.idexploration=ld.idexploration and e.place=".$place." and ld.idtopic is not null and ld.idexample is null and ld.idconcept is null";
		else
			$sql="select count(ld.idtopic) visitcount,sum(ld.timelength) visittime,t.name tname from LOGDATA ld,EXPLORATION e,TOPIC t where ld.timelength is not null and ld.idtopic=t.idtopic and e.idexploration=ld.idexploration and e.place=".$place." and ld.idtopic=".$idtopic." and ld.idexample is null and ld.idconcept is null";
		if($fromtime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')>='".$fromtime."'";
		if($totime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')<='".$totime."'";

		$sql.=" group by ld.idtopic";
		$db->query($sql);		
	$bgcolor = "#FFFFDD";
	$count = true;
	while($db->next_record()){
		$bgcolor = ($count?"#FFFFFF":"#FFFFDD");
?>
    <tr align="center" bgcolor="<?= $bgcolor?>" class="f12b"> 
      <td height="22"> 
        <?= ($db->Record['tname']==null?"N/A":$db->Record['tname'])?>
      </td>
      <td> 
        <?= $db->Record['visittime']?>
      </td>
      <td> 
        <?= round($db->Record['visittime']/$db->Record['visitcount'])?>
      </td>
      <td> 
        <?= round($db->Record['visittime']/$totaltime*100,2)?>
      </td>
      <td> 
        <?=$db->Record['visitcount']?>
      </td>
    </tr>
    <?php
	$count = !$count;
	}
?>
  </table>
  <?
	}
}
?>
  <p>&nbsp;</p>
  </center>
</body>
</html>
