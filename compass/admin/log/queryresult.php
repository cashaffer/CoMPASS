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
$idstudent = ($_REQUEST['idstudent']==null?0:$_REQUEST['idstudent']);
$bysession = ($_REQUEST['bysession']==null?0:$_REQUEST['bysession']);
$fromtime = ($_REQUEST['fromtime']==null?"":$_REQUEST['fromtime']);
$totime = ($_REQUEST['totime']==null?"":$_REQUEST['totime']);
//$idtopic = ($_REQUEST['idtopic']==null?0:$_REQUEST['idtopic']);
$place = ($_REQUEST['place']==null?1:$_REQUEST['place']);

		$t=array("Inclined plane" =>"IP","Lever" =>"L","Pulley" =>"P","Screw" =>"S","Wedge" =>"W","Wheel and Axle" =>"WA","Circular motion" =>"CM","Falling objects" =>"FO","Linear motion" =>"LM","Rotational motion" =>"RM","Projectile motion" =>"PM", 
		"Inclined Plane (1)" =>"IP","Lever (1)" =>"L","Pulley (1)" =>"P","Screw (1)" =>"S","Wedge (1)" =>"W","Wheel and Axle (1)" =>"WA",
		"Inclined Plane (2)" =>"IP","Lever (2)" =>"L","Pulley (2)" =>"P","Screw (2)" =>"S","Wedge (2)" =>"W","Wheel and Axle (2)" =>"WA",
		"Inclined Plane (3)" =>"IP","Lever (3)" =>"L","Pulley (3)" =>"P","Screw (3)" =>"S","Wedge (3)" =>"W","Wheel and Axle (3)" =>"WA");
		$tp=array("Inclined plane" =>"IP","Lever" =>"Lever","Pulley" =>"Pulley","Screw" =>"Screw","Wedge" =>"Wedge","Wheel and Axle" =>"WA","Circular motion" =>"CM","Falling objects" =>"FO","Linear motion" =>"LM","Rotational motion" =>"RM","Projectile motion" =>"PM",
		"Inclined Plane (1)" =>"IP","Lever (1)" =>"Lever","Pulley (1)" =>"Pulley","Screw (1)" =>"Screw","Wedge (1)" =>"Wedge","Wheel and Axle (1)" =>"WA",
		"Inclined Plane (2)" =>"IP","Lever (2)" =>"Lever","Pulley (2)" =>"Pulley","Screw (2)" =>"Screw","Wedge (2)" =>"Wedge","Wheel and Axle (2)" =>"WA",
		"Inclined Plane (3)" =>"IP","Lever (3)" =>"Lever","Pulley (3)" =>"Pulley","Screw (3)" =>"Screw","Wedge (3)" =>"Wedge","Wheel and Axle (3)" =>"WA");

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
if($idstudent!=0 && $bysession==0){
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
		$sql="select c.name cname,u.loginname tname from CLASS c,TAKESCLASS tc,USER u  where c.idclass=".$idclass." and c.idteacher=u.iduser";
		$db->query($sql);
		$db->next_record();
		$cname=$db->Record['cname'];
		$tname=$db->Record['tname'];
		$sql="select concat(IFNULL(ld.idunit,0),'_',IFNULL(ld.idtopic,0),'_',IFNULL(ld.idconcept,0)) ids, count(ld.timelength) visitcount,sum(ld.timelength) visittime,c.general_title cname,t.name tname,u.name uname from LOGDATA ld left join CONCEPT c on c.idconcept=ld.idconcept left join TOPIC t on ld.idtopic=t.idtopic left join UNIT u on ld.idunit=u.idunit ,EXPLORATION e where ld.timelength is not null and e.idexploration=ld.idexploration and e.idstudent=".$idstudent." and e.idclass=".$idclass." and e.place=".$place." and ld.idexample is null";
		if($fromtime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')>='".$fromtime."'";
		if($totime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')<='".$totime."'";

		$sql.=" group by ids order by ids";
		$db->query($sql);		

?>
  <table width="80%" border="1" cellspacing="0" cellpadding="0">
    <tr> 
      <td colspan="5" class="tabletitle"> <p>Group Name: 
          <?=$loginname?>
          <br>
          Class Name: 
          <?=$cname?>
          &nbsp;&nbsp;(Teacher: 
          <?=$tname?>
          )
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
          second(s)<br>
        </p></td>
    </tr>
    <tr bgcolor="#E3EFFD" class="tabletitle"> 
      <td>Node</td>
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
				$nodename="";
				if($db->Record['uname']!=null && $db->Record['tname']==null && $db->Record['cname']==null){
					if($db->Record['uname']=="Forces and Motion")
						$nodename="FM";
					else
						$nodename="SM";
				}
				else if($db->Record['tname']!=null){
					if($db->Record['cname']==null){
						$nodename=$tp[$db->Record['tname']];
					}
					else{
						$nodename=$db->Record['cname']."_".$t[$db->Record['tname']];
					}
				}
				else{
					$nodename=$db->Record['cname'];
				}

?>
    <tr align="center" bgcolor="<?= $bgcolor?>" class="f12b"> 
      <td height="22"> 
        <?= $nodename?>
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
  </table>
<?
	}
}
else if($bysession==1){
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
		$sql="select c.name cname,u.loginname tname from CLASS c,TAKESCLASS tc,USER u  where c.idclass=".$idclass." and c.idteacher=u.iduser";
		$db->query($sql);
		$db->next_record();
		$cname=$db->Record['cname'];
		$tname=$db->Record['tname'];
		
		$db1 = new DB_Sql;
		$db1->connect();
		$sql="select e.leader leader, e.time time, e.question question, e.idexploration idexploration, sum(ld.timelength) totaltime from EXPLORATION e, LOGDATA ld where idstudent=".$idstudent." and place=".$place." and idclass=".$idclass." and e.idexploration=ld.idexploration";
		if($fromtime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')>='".$fromtime."'";
		if($totime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')<='".$totime."'";
 		$sql.=" group by ld.idexploration";
		$db1->query($sql);		
	while($db1->next_record()){
		$idexploration=$db1->Record['idexploration'];
		$totaltime = $db1->Record['totaltime'];
		$leader=$db1->Record['leader'];
		$starttime=$db1->Record['time'];
		$question=$db1->Record['question'];

		$sql="select concat(IFNULL(ld.idunit,0),'_',IFNULL(ld.idtopic,0),'_',IFNULL(ld.idconcept,0)) ids, count(ld.timelength) visitcount,sum(ld.timelength) visittime,c.general_title cname,t.name tname,u.name uname from LOGDATA ld left join CONCEPT c on c.idconcept=ld.idconcept left join TOPIC t on ld.idtopic=t.idtopic left join UNIT u on ld.idunit=u.idunit ,EXPLORATION e where ld.timelength is not null and e.idexploration=ld.idexploration and e.idexploration=".$idexploration." and ld.idexample is null group by ids order by ids";
		$db->query($sql);		

?>
  <table width="80%" border="1" cellspacing="0" cellpadding="0">
    <tr> 
      <td colspan="5" class="tabletitle"> <p>Group Name: 
          <?=$loginname?>
          <br>
Leader Name: 
          <?=$leader?>
          <br>          
Start time: 
          <?=$starttime?>
          <br>
Question: 
          <?=$question?>
          <br>
		  Class Name: 
          <?=$cname?>
          &nbsp;&nbsp;(Teacher: 
          <?=$tname?>
          )
          <br>
        </p></td>
    </tr>
    <tr bgcolor="#E3EFFD" class="tabletitle"> 
      <td>Node</td>
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
				$nodename="";
				if($db->Record['uname']!=null && $db->Record['tname']==null && $db->Record['cname']==null){
					if($db->Record['uname']=="Forces and Motion")
						$nodename="FM";
					else
						$nodename="SM";
				}
				else if($db->Record['tname']!=null){
					if($db->Record['cname']==null){
						$nodename=$tp[$db->Record['tname']];
					}
					else{
						$nodename=$db->Record['cname']."_".$t[$db->Record['tname']];
					}
				}
				else{
					$nodename=$db->Record['cname'];
				}

?>
    <tr align="center" bgcolor="<?= $bgcolor?>" class="f12b"> 
      <td height="22"> 
        <?= $nodename?>
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
  </table>
  <br><br>
<?
	}
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
		$sql="select concat(IFNULL(ld.idunit,0),'_',IFNULL(ld.idtopic,0),'_',IFNULL(ld.idconcept,0)) ids, count(ld.timelength) visitcount,sum(ld.timelength) visittime,c.general_title cname,t.name tname,u.name uname from LOGDATA ld left join CONCEPT c on c.idconcept=ld.idconcept left join TOPIC t on ld.idtopic=t.idtopic left join UNIT u on ld.idunit=u.idunit,EXPLORATION e where ld.timelength is not null and e.idexploration=ld.idexploration and e.idclass=".$idclass." and e.place=".$place." and ld.idexample is null";
		if($fromtime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')>='".$fromtime."'";
		if($totime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')<='".$totime."'";

		$sql.=" group by ids order by ids";
		$db->query($sql);		

?>
  <table width="80%" border="1" cellspacing="0" cellpadding="0">
    <tr> 
      <td colspan="5" class="tabletitle">
	  <p> Class Name: 
          <?=$cname?>
          &nbsp;&nbsp;(Teacher: 
          <?=$tname?>
          )
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
      <td>Node</td>
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
				$nodename="";
				if($db->Record['uname']!=null && $db->Record['tname']==null && $db->Record['cname']==null){
					if($db->Record['uname']=="Forces and Motion")
						$nodename="FM";
					else
						$nodename="SM";
				}
				else if($db->Record['tname']!=null){
					if($db->Record['cname']==null){
						$nodename=$tp[$db->Record['tname']];
					}
					else{
						$nodename=$db->Record['cname']."_".$t[$db->Record['tname']];
					}
				}
				else{
					$nodename=$db->Record['cname'];
				}

?>
    <tr align="center" bgcolor="<?= $bgcolor?>" class="f12b"> 
      <td height="22"> 
        <?= ($nodename)?>
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

		$sql="select concat(IFNULL(ld.idunit,0),'_',IFNULL(ld.idtopic,0),'_',IFNULL(ld.idconcept,0)) ids, count(ld.timelength) visitcount,sum(ld.timelength) visittime,c.general_title cname,t.name tname,u.name uname from LOGDATA ld left join CONCEPT c on c.idconcept=ld.idconcept left join TOPIC t on ld.idtopic=t.idtopic left join UNIT u on ld.idunit=u.idunit,EXPLORATION e,CLASS cs where ld.timelength is not null and e.idexploration=ld.idexploration and e.idclass=cs.idclass and e.place=".$place." and cs.idteacher=".$idteacher." and ld.idexample is null";
		if($fromtime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')>='".$fromtime."'";
		if($totime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')<='".$totime."'";

		$sql.=" group by ids order by ids";
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
      <td>Node</td>
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
				$nodename="";
				if($db->Record['uname']!=null && $db->Record['tname']==null && $db->Record['cname']==null){
					if($db->Record['uname']=="Forces and Motion")
						$nodename="FM";
					else
						$nodename="SM";
				}
				else if($db->Record['tname']!=null){
					if($db->Record['cname']==null){
						$nodename=$tp[$db->Record['tname']];
					}
					else{
						$nodename=$db->Record['cname']."_".$t[$db->Record['tname']];
					}
				}
				else{
					$nodename=$db->Record['cname'];
				}

?>
    <tr align="center" bgcolor="<?= $bgcolor?>" class="f12b"> 
      <td height="22"> 
        <?= ($nodename)?>
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
		
		$sql="select concat(IFNULL(ld.idunit,0),'_',IFNULL(ld.idtopic,0),'_',IFNULL(ld.idconcept,0)) ids, count(ld.timelength) visitcount,sum(ld.timelength) visittime,c.general_title cname,t.name tname,u.name uname from LOGDATA ld left join CONCEPT c on c.idconcept=ld.idconcept left join TOPIC t on ld.idtopic=t.idtopic left join UNIT u on ld.idunit=u.idunit,EXPLORATION e where ld.timelength is not null and e.idexploration=ld.idexploration and e.place=".$place." and ld.idexample is null";
		if($fromtime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')>='".$fromtime."'";
		if($totime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')<='".$totime."'";

		$sql.=" group by ids order by ids";
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
      <td>Node</td>
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
				$nodename="";
				if($db->Record['uname']!=null && $db->Record['tname']==null && $db->Record['cname']==null){
					if($db->Record['uname']=="Forces and Motion")
						$nodename="FM";
					else
						$nodename="SM";
				}
				else if($db->Record['tname']!=null){
					if($db->Record['cname']==null){
						$nodename=$tp[$db->Record['tname']];
					}
					else{
						$nodename=$db->Record['cname']."_".$t[$db->Record['tname']];
					}
				}
				else{
					$nodename=$db->Record['cname'];
				}
?>
    <tr align="center" bgcolor="<?= $bgcolor?>" class="f12b"> 
      <td height="22"> 
        <?= ($nodename)?>
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
  </table>
  <?
	}
}
?>
  <p>&nbsp;</p>
  </center>
</body>
</html>
