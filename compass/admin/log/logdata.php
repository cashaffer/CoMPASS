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
	
$db = new DB_Sql;

$db->connect();

$exploration = $_REQUEST['exploration'];

$sql = "select u.loginname username, c.name cname,u1.loginname teachername,e.time time,e.question question,e.place place, e.goal goal,e.leader leader from USER u,USER u1,CLASS c,EXPLORATION e where u.iduser=e.idstudent and e.idclass=c.idclass and c.idteacher=u1.iduser and e.idexploration=".$exploration;
$goal=array("","Homework","Project","Labs","Class work","Fun","Other");
$place=array("","School-During Science Class","School-Outside Science Class","Home","Other");

$query = $db->query($sql);
$db->next_record();
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
	MM_goToURL('self','classlist.php?orderby='+column);
	return document.MM_returnValue;
}
</script>
</head>
<link rel="stylesheet"  href="../../css/compass.css" type="text/css" media=screen>
<body>
<center>
<p>&nbsp;</p>
  <p class="tabletitle">Log Data</p>
  <table width="75%" border="0" cellpadding="0" cellspacing="0" class="f14b">
    <tr class="tabletitle"> 
      <td width="141"> <div align="right">User Name:</div></td>
      <td width="10">&nbsp;</td>
      <td width="626" align="left"> 
        <?=$db->Record['username']?>
      </td>
    </tr>
    <tr class="tabletitle"> 
      <td> <div align="right">Group Leader::</div></td>
      <td>&nbsp;</td>
      <td align="left"> 
        <?=$db->Record['leader']?>
      </td>
    </tr>
    <tr class="tabletitle"> 
      <td> <div align="right">Class:</div></td>
      <td>&nbsp;</td>
      <td align="left"> 
        <?=$db->Record['teachername'].": ".$db->Record['cname']?>
      </td>
    </tr>
    <tr class="tabletitle"> 
      <td> <div align="right">Start Time:</div></td>
      <td>&nbsp;</td>
      <td align="left"> 
        <?=$db->Record['time']?>
      </td>
    </tr>
    <tr class="tabletitle"> 
      <td> <div align="right">Question:</div></td>
      <td>&nbsp;</td>
      <td align="left"> 
        <?=($db->Record['question']==null?"N/A":$db->Record['question'])?>
      </td>
    </tr>
    <tr class="tabletitle"> 
      <td> <div align="right">Goal:</div></td>
      <td>&nbsp;</td>
      <td align="left"> 
        <?=$goal[$db->Record['goal']]?>
      </td>
    </tr>
    <tr class="tabletitle"> 
      <td> <div align="right">Place:</div></td>
      <td>&nbsp;</td>
      <td align="left"> 
        <?=$place[$db->Record['place']]?>
      </td>
    </tr>
  </table>
  <br>
<?php
	$source=array("Map","Text","NaviBar");
	$sql="select ld.time,ld.endtime endtime,ld.source source,c.general_title cname,t.name tname,u.name uname,e.name ename,ld.timelength timelength,dllink url from LOGDATA ld left join CONCEPT c on c.idconcept=ld.idconcept left join TOPIC t on ld.idtopic=t.idtopic left join UNIT u on ld.idunit=u.idunit left join EXAMPLE e on ld.idexample=e.idexample where ld.idexploration=".$exploration." order by ld.time";
	$query = $db->query($sql);
?>
  <table width="85%" border="1" cellspacing="0" cellpadding="0">
    <tr align="center" bgcolor="#E6F1FF" class="tabletitle"> 
      <td width="12%">Unit</td>
      <td width="13%">Topic</td>
      <td width="13%">Concept</td>
      <td width="14%">Example</td>
      <td width="12%">DL_link</td>
      <td width="12%">Source</td>
      <td width="14%">Entering Time</td>
      <td width="14%">Leaving Time</td>
      <td width="8%">Staying Time (Sec)</td>
    </tr>
    <?php
	$bgcolor = "#FFFFDD";
	$count = true;
	while($db->next_record()){
		$bgcolor = ($count?"#FFFFFF":"#FFFFDD");
?>
    <tr align="center" bgcolor="<?= $bgcolor?>" class="f12b"> 
      <td height="22"> 
        <?= ($db->Record['uname']==null?"N/A":$db->Record['uname'])?>
      </td>
      <td> 
        <?= ($db->Record['tname']==null?"N/A":$db->Record['tname'])?>
      </td>
      <td> 
        <?= ($db->Record['cname']==null?"N/A":$db->Record['cname'])?>
      </td>
      <td> 
        <?= ($db->Record['ename']==null?"N/A":$db->Record['ename'])?>
      </td>
      <td>
        <?= ($db->Record['url']==null?"N/A":$db->Record['url'])?>
      </td>
      <td> 
        <?=$source[$db->Record['source']]?>
      </td>
      <td> 
        <?= $db->Record['time']?>
      </td>
      <td> 
        <?= ($db->Record['endtime']==null?"N/A":$db->Record['endtime'])?>
      </td>
      <td> 
        <?= ($db->Record['timelength']==null?"N/A":$db->Record['timelength'])?>
      </td>
    </tr>
    <?php
	$count = !$count;
	}
?>
  </table>
  <p>&nbsp;</p>
</center>
</body>
</html>
