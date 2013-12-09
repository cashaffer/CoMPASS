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
$transitions = $_REQUEST['trans'];
if ($transitions == null) $transitions = "";


		$t=array("Inclined plane" =>"IP","Lever" =>"L","Pulley" =>"P","Screw" =>"S","Wedge" =>"W","Wheel and Axle" =>"WA","Circular motion" =>"CM","Falling objects" =>"FO","Linear motion" =>"LM","Rotational motion" =>"RM","Projectile motion" =>"PM", 
		"Inclined Plane (1)" =>"IP","Lever (1)" =>"L","Pulley (1)" =>"P","Screw (1)" =>"S","Wedge (1)" =>"W","Wheel and Axle (1)" =>"WA",
		"Inclined Plane (2)" =>"IP","Lever (2)" =>"L","Pulley (2)" =>"P","Screw (2)" =>"S","Wedge (2)" =>"W","Wheel and Axle (2)" =>"WA",
		"Inclined Plane (dev)" =>"IP","Lever (dev)" =>"L","Pulley (dev)" =>"P","Screw (dev)" =>"S","Wedge (dev)" =>"W","Wheel and Axle (dev)" =>"WA",
		"Inclined Plane (3)" =>"IP","Lever (3)" =>"L","Pulley (3)" =>"P","Screw (3)" =>"S","Wedge (3)" =>"W","Wheel and Axle (3)" =>"WA");
		$tp=array("Inclined plane" =>"IP","Lever" =>"Lever","Pulley" =>"Pulley","Screw" =>"Screw","Wedge" =>"Wedge","Wheel and Axle" =>"WA","Circular motion" =>"CM","Falling objects" =>"FO","Linear motion" =>"LM","Rotational motion" =>"RM","Projectile motion" =>"PM",
		"Inclined Plane (1)" =>"IP","Lever (1)" =>"Lever","Pulley (1)" =>"Pulley","Screw (1)" =>"Screw","Wedge (1)" =>"Wedge","Wheel and Axle (1)" =>"WA",
		"Inclined Plane (2)" =>"IP","Lever (2)" =>"Lever","Pulley (2)" =>"Pulley","Screw (2)" =>"Screw","Wedge (2)" =>"Wedge","Wheel and Axle (2)" =>"WA",
		"Inclined Plane (dev)" =>"IP","Lever (dev)" =>"Lever","Pulley (dev)" =>"Pulley","Screw (dev)" =>"Screw","Wedge (dev)" =>"Wedge","Wheel and Axle (dev)" =>"WA",
		"Inclined Plane (3)" =>"IP","Lever (3)" =>"Lever","Pulley (3)" =>"Pulley","Screw (3)" =>"Screw","Wedge (3)" =>"Wedge","Wheel and Axle (3)" =>"WA");

$num_tables = 0;

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script src= "http://compassproject.net/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src= "jquery.md5.js" type="text/javascript"></script>
<script type="text/javascript">
selectrow = function(a) { 
	//console.log(a.parentNode.parentNode.getElementsByTagName('td')[1].innerHTML); 
	var tds = a.parentNode.parentNode.getElementsByTagName('td');
	var value1 = parseInt(tds[2].innerHTML);
	var value2 = parseInt(tds[3].innerHTML);
	var value3 = parseInt(tds[4].innerHTML);
	var value4 = parseInt(tds[5].innerHTML);
	var total1 = a.parentNode.parentNode.parentNode.getElementsByTagName('span')[0];
	var total2 = a.parentNode.parentNode.parentNode.getElementsByTagName('span')[1];
	var total3 = a.parentNode.parentNode.parentNode.getElementsByTagName('span')[2];
	var total4 = a.parentNode.parentNode.parentNode.getElementsByTagName('span')[3];
	if (a.checked) {
		// add to total
		total1.innerHTML = parseInt(total1.innerHTML) + value1;
		total2.innerHTML = parseInt(total2.innerHTML) + value2;
		total3.innerHTML = parseInt(total3.innerHTML) + value3;
		total4.innerHTML = parseInt(total4.innerHTML) + value4;
	} else {
		total1.innerHTML = parseInt(total1.innerHTML) - value1;
		total2.innerHTML = parseInt(total2.innerHTML) - value2;
		total3.innerHTML = parseInt(total3.innerHTML) - value3;
		total4.innerHTML = parseInt(total4.innerHTML) - value4;
	}
}

function exportcsv(id, login, leader, starttime, question, cname, tname) {
	var tableid = 'table' + id;
	var tab = document.getElementById (tableid);
	var trs = tab.getElementsByClassName('f12b');
	var str = '';
	for (var i=0;i<trs.length;i++) { 
		if (trs[i].getElementsByTagName('input')[0].checked ) {
			var tds = trs[i].getElementsByTagName('td');
			var node = tds[1].innerHTML.replace(/\n\s*/, '').replace(/\s+$/,"");
			var totaltime = tds[2].innerHTML.replace(/\n\s*/, '').replace(/\s+$/,"");
			var avgtime = tds[3].innerHTML.replace(/\n\s*/, '').replace(/\s+$/,"");
			var proportion = tds[4].innerHTML.replace(/\n\s*/, '').replace(/\s+$/,"");
			var visits = tds[5].innerHTML.replace(/\n\s*/, '').replace(/\s+$/,"");
			str += node + ',' + totaltime + ',' +avgtime + ',' + proportion + ',' + visits + '\n';
		}
	}
	if (str) {
		var totaltds = tab.getElementsByClassName('total')[0].getElementsByTagName('td');
		str = 'Node,Total Time,Avg Time,Proportion,Visits\n' + str;
		totalstr = 'TOTAL,' + totaltds[2].innerHTML.replace(/\n\s*/, '').replace(/\s+$/,"") + ',' + totaltds[3].innerHTML.replace(/\n\s*/, '').replace(/\s+$/,"") + ','+  totaltds[4].innerHTML.replace(/\n\s*/, '').replace(/\s+$/,"") + ','+ totaltds[5].innerHTML.replace(/\n\s*/, '').replace(/\s+$/,"") + '\n';

		totalstr = totalstr.replace('<span>', '', 'g').replace('</span>', '', 'g');
		str = str + totalstr;
	}
	var hashedname = $.md5(str);
	$.post("exportcsv.php", {data:str, filename:hashedname}, 
		function (retdata) {
			//console.log(retdata);
			var d = $('#div' + id);
			d.append('<br/><a href="csvexports/'+hashedname+'.csv" target=_blank>Download exported file: '+hashedname+' </a>');
			
		}
	);
	//alert(str);
}

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
	<table id="table<?=++$num_tables?>" width="80%" border="1" cellspacing="0" cellpadding="0">
    <tr> 
      <td colspan="6" class="tabletitle"> <p>Group Name: 
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
			<td onclick="selectall()">Select</td>
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
			<td>
				<input type="checkbox" onclick="selectrow(this);"/>
			</td>

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

		<tr align="center" class="total" style="background-color:#cda">
			<td> <b>|</b> </td>
			<td><b> Total </b></td>
			<td><span> 0 </span></td>
			<td><span> 0 </span></td>
			<td><span> 0 </span></td>
			<td><span> 0 </span></td>
		</tr>
    <tr > 
			<td colspan="4">&nbsp;</td>
			<td colspan="2"><input type = "button" onclick="exportcsv(<?=$num_tables?>,  '<?=$loginname?>', '<?=$leader?>', '<?=$starttime?>', '<?=$question?>', '<?=$cname?>', '<?=$tname?>'   )" value="Export selected rows"></input></td>
		</tr>
		<tr>
			<td colspan="3"></td>
			<td colspan="3"><div id="div<?=$num_tables?>">  </div></td>
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

		$sql = "select ld.idconcept c,ld.idtopic t ,ld.idunit u from LOGDATA ld where ld.idexploration=" . $idexploration;
		$db->query($sql);
		$total_trans = 0;
		$one_hops =0;
		$prev_c = 0; $prev_t = 0; $prev_u = 0;
		while($db->next_record()) {
			$curr_c = $db->Record['c']; if ($curr_c == null) { continue; }
			$curr_t = $db->Record['t']; if ($curr_t == null) { $curr_t = 0; }
			$curr_u = $db->Record['u']; if ($curr_u == null) { $curr_u = 0; }

			$total_trans++;

			if ($prev_u == $curr_u && $prev_t == $curr_t) {
				$str = ':' . $prev_c . '_' . $curr_c;
				if (strpos($transitions, $str) !== FALSE) {
					$one_hops++;
				}
			}
			$prev_c = $curr_c;
			$prev_t = $curr_t;
			$prev_u = $curr_u;
		}
		$total_trans--;
		$percent = 0.00;
		if ($total_trans != 0) {
			$percent = round($one_hops / $total_trans, 2) * 100;
		}

		$sql="select concat(IFNULL(ld.idunit,0),'_',IFNULL(ld.idtopic,0),'_',IFNULL(ld.idconcept,0)) ids, count(ld.timelength) visitcount,sum(ld.timelength) visittime,c.general_title cname,t.name tname,u.name uname from LOGDATA ld left join CONCEPT c on c.idconcept=ld.idconcept left join TOPIC t on ld.idtopic=t.idtopic left join UNIT u on ld.idunit=u.idunit ,EXPLORATION e where ld.timelength is not null and e.idexploration=ld.idexploration and e.idexploration=".$idexploration." and ld.idexample is null group by ids order by ids";
		$db->query($sql);		

?>
  <table id="table<?=++$num_tables?>" width="80%" border="1" cellspacing="0" cellpadding="0">
    <tr> 
      <td colspan="6" class="tabletitle"> <p>Group Name: 
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
<br>-------------------------------------------------------------<br/>
	<b> Total transitions : <?=$total_trans?>.</b><br/>
	<b> Total selected transitions : <?=$one_hops?>. </b><br/>
	<b> Percentage of one-hops : <?= $percent ?>%</b>
<br/>-------------------------------------------------------------<br/>
        </p></td>
    </tr>
		<tr bgcolor="#E3EFFD" class="tabletitle"> 
			<td onclick="selectall()">Select</td>
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
			<td>
				<input type="checkbox" onclick="selectrow(this);"/>
			</td>
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
		<tr align="center" class="total" style="background-color:#cda">
			<td> <b>|</b> </td>
			<td><b> Total </b></td>
			<td><span> 0 </span></td>
			<td><span> 0 </span></td>
			<td><span> 0 </span></td>
			<td><span> 0 </span></td>
		</tr>
    <tr > 
			<td colspan="4">&nbsp;</td>
			<td colspan="2"><input type = "button" onclick="exportcsv(<?=$num_tables?>,  '<?=$loginname?>', '<?=$leader?>', '<?=$starttime?>', '<?=$question?>', '<?=$cname?>', '<?=$tname?>'   )" value="Export selected rows"></input></td>
		</tr>
		<tr>
			<td colspan="3"></td>
			<td colspan="3"><div id="div<?=$num_tables?>">  </div></td>
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
  <table id="table<?=++$num_tables?>" width="80%" border="1" cellspacing="0" cellpadding="0">
    <tr> 
      <td colspan="6" class="tabletitle">
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
			<td onclick="selectall()">Select</td>
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
			<td>
				<input type="checkbox" onclick="selectrow(this);"/>
			</td>
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
		<tr align="center" class="total" style="background-color:#cda">
			<td> <b>|</b> </td>
			<td><b> Total </b></td>
			<td><span> 0 </span></td>
			<td><span> 0 </span></td>
			<td><span> 0 </span></td>
			<td><span> 0 </span></td>
		</tr>
    <tr > 
			<td colspan="4">&nbsp;</td>
			<td colspan="2"><input type = "button" onclick="exportcsv(<?=$num_tables?>,  '<?=$loginname?>', '<?=$leader?>', '<?=$starttime?>', '<?=$question?>', '<?=$cname?>', '<?=$tname?>'   )" value="Export selected rows"></input></td>
		</tr>
		<tr>
			<td colspan="3"></td>
			<td colspan="3"><div id="div<?=$num_tables?>">  </div></td>
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
  <table id="table<?=++$num_tables?>"  width="80%" border="1" cellspacing="0" cellpadding="0">
    <tr> 
      <td colspan="6" class="tabletitle">
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
			<td onclick="selectall()">Select</td>
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
			<td>
				<input type="checkbox" onclick="selectrow(this);"/>
			</td>
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
		<tr align="center" class="total" style="background-color:#cda">
			<td> <b>|</b> </td>
			<td><b> Total </b></td>
			<td><span> 0 </span></td>
			<td><span> 0 </span></td>
			<td><span> 0 </span></td>
			<td><span> 0 </span></td>
		</tr>
    <tr > 
			<td colspan="4">&nbsp;</td>
			<td colspan="2"><input type = "button" onclick="exportcsv(<?=$num_tables?>,  '<?=$loginname?>', '<?=$leader?>', '<?=$starttime?>', '<?=$question?>', '<?=$cname?>', '<?=$tname?>'   )" value="Export selected rows"></input></td>
		</tr>
		<tr>
			<td colspan="3"></td>
			<td colspan="3"><div id="div<?=$num_tables?>">  </div></td>
		</tr>

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
  <table id="table<?=++$num_tables?>"  width="80%" border="1" cellspacing="0" cellpadding="0">
    <tr> 
      <td colspan="6" class="tabletitle">
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
			<td onclick="selectall()">Select</td>
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
			<td>
				<input type="checkbox" onclick="selectrow(this);"/>
			</td>
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
		<tr align="center" class="total" style="background-color:#cda">
			<td> <b>|</b> </td>
			<td><b> Total </b></td>
			<td><span> 0 </span></td>
			<td><span> 0 </span></td>
			<td><span> 0 </span></td>
			<td><span> 0 </span></td>
		</tr>
    <tr > 
			<td colspan="4">&nbsp;</td>
			<td colspan="2"><input type = "button" onclick="exportcsv(<?=$num_tables?>,  '<?=$loginname?>', '<?=$leader?>', '<?=$starttime?>', '<?=$question?>', '<?=$cname?>', '<?=$tname?>'   )" value="Export selected rows"></input></td>
		</tr>
		<tr>
			<td colspan="3"></td>
			<td colspan="3"><div id="div<?=$num_tables?>">  </div></td>
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
