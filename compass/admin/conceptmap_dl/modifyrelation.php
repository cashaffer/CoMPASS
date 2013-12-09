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
include "pager.inc"; 

$cid1 = $_REQUEST['cid1'];
$cid2 = $_REQUEST['cid2'];
$tid = $_REQUEST['tid'];
	
$db = new DB_Sql;
$db -> connect();
$db1 = new DB_Sql;
$db1 -> connect();
$sql = "select idrelation,description,level from CONCEPTRELATION where conceptfrom=".$cid1." and conceptto=".$cid2." and idtopic=".$tid;
$db1->query($sql);		
if($db1->next_record()){
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
function check(){
	rtn = true;
	if(form1.cid1.value == form1.cid2.value){
		alert("Concept 1 and Concept 2 can not be the same one!");
		form1.cid1.focus();
		rtn=false;
	}
	return rtn;
}
function changeUnit(){
	self.location="addrelation.php?uid="+form1.uid.value;
}
function changeTopic(){
	self.location="addrelation.php?uid="+form1.uid.value+"&tid="+form1.tid.value;
}
</script>
</head>
<link rel="stylesheet"  href="../../css/compass.css" type="text/css" media=screen>
<body>
<center>
<p>&nbsp;</p>
  <p><span class="tabletitle">Modify Concept_Relation</span></p>
  <form name="form1" method="post" action="saverelationinfo.php" onSubmit="return check()">
    <table width="75%" border="0" cellspacing="0" cellpadding="0">
      <? 	if($tid != null){
?>
      <tr> 
        <td width="33%"><div align="right">Concept 1:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="63%"> <select name="cid1">
            <?
		$sql = "select c.idconcept cid,c.general_title cname from CONCEPTINTOPIC tc,CONCEPT c where tc.idconcept=c.idconcept and tc.idtopic=".$tid." order by c.general_title";
		$db->query($sql);
		while($db->next_record()){
			$selected="";
			if($cid1 != null){
				if($cid1==$db->Record['cid'])
					$selected="selected";
			}
?>
            <option value="<?= $db->Record['cid']?>" <?=$selected?>> 
            <?= $db->Record['cname']?>
            </option>
            <?
	}
?>
          </select> </td>
      </tr>
      <tr> 
        <td><div align="right">Concept 2:</div></td>
        <td>&nbsp;</td>
        <td> <select name="cid2">
            <?
	$db->seek(0);
	while($db->next_record()){
			$selected="";
			if($cid2 != null){
				if($cid2==$db->Record['cid'])
					$selected="selected";
			}
?>
            <option value="<?= $db->Record['cid']?>" <?=$selected?>> 
            <?= $db->Record['cname']?>
            </option>
            <?
	}
?>
          </select> </td>
      </tr>
      <tr> 
        <td><div align="right">Relation:</div></td>
        <td>&nbsp;</td>
        <td> <select name="rid">
            <?
	$sql = "select idrelation,name from RELATION order by name";
	$db->query($sql);
	while($db->next_record()){
			$selected="";
			if($db1->Record['idrelation']==$db->Record['idrelation'])
					$selected="selected";
?>
            <option value="<?= $db->Record['idrelation']?>" <?=$selected?>> 
            <?= $db->Record['name']?>
            </option>
            <?
	}
?>
          </select> </td>
      </tr>
      <tr> 
        <td><div align="right">Relation Level:</div></td>
        <td>&nbsp;</td>
        <td> <select name="rlevel">
            <option value="1" <?=($db1->Record['level']==1?"selected":"")?>>Loose</option>
            <option value="2" <?=($db1->Record['level']==2?"selected":"")?>>Normal</option>
            <option value="3" <?=($db1->Record['level']==3?"selected":"")?>>Tight</option>
          </select> </td>
      </tr>
      <tr> 
        <td><div align="right">Description:</div></td>
        <td>&nbsp;</td>
        <td><textarea name="description" cols="50" rows="6"><?= ($db1->Record['description']==null)?"":htmlentities($db1->Record['description'])?></textarea> </td>
      </tr>
      <?
}
?>
    </table>
    <p> 
      <input type="hidden" name="tid" value="<?=$tid?>">
      <input type="hidden" name="formercid1" value="<?=$cid1?>">
      <input type="hidden" name="formercid2" value="<?=$cid2?>">
      <input type="submit" name="Submit" value="Submit">
  </form>
  </p>
</center>
</body>
</html>
<?
}
else
		header("location:/compass/error_code.php?code=006"); 
?>