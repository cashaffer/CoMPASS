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
	
$db = new DB_Sql;
$db->connect();
$db1 = new DB_Sql;
$db1 -> connect();

$type = $_REQUEST['type'];
$orderby = $_REQUEST['orderby'];
$searchname = $_REQUEST['searchname'];
if($searchname == null)
	$searchname = "";

if($orderby == null)
	$orderby = "topic.name";

$sql = "select topic.idtopic tid,topic.name tname, topic.idunit uid,unit.name uname from topic,unit where unit.idunit=topic.idunit ";
if($searchname != "")
	$sql=$sql."and topic.name like '%".$searchname."%' ";
$sql=$sql."order by ".$orderby;

if ( isset($_GET['page']) )
{
   $page = (int)$_GET['page'];
}
else
{
   $page = 1;
} 
$pager_option = array(
       "sql" => $sql,
       "PageSize" => PageSize,
       "CurrentPageID" => $page
); 
if ( isset($_GET['numItems']) )
{
   $pager_option['numItems'] = (int)$_GET['numItems'];
} 
$pager = new Pager($pager_option); 

if ( $pager->isFirstPage )
{
   $turnover = "";
}
else
{
   $turnover = "<a href='?orderby=".$orderby."&page=1&numItems=".$pager->numItems."&searchname=".$searchname."'>First</a> | <a href='?orderby=".$orderby."&page=".$pager->PreviousPageID."&numItems=".$pager->numItems."&searchname=".$searchname."'>Last Page</a> | ";
} 
if ( $pager->isLastPage )
{
   $turnover .= "";
}
else
{
   $turnover .= "<a href='?orderby=".$orderby."&page=".$pager->NextPageID."&numItems=".$pager->numItems."&searchname=".$searchname."'>Next Page</a> | <a href='?orderby=".$orderby."&page=".$pager->numPages."&numItems=".$pager->numItems."&searchname=".$searchname."'>End</a>";
}

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
	MM_goToURL('self','topiclist.php?searchname=<?= $searchname?>&orderby='+column);
	return document.MM_returnValue;
}
function check(){
	str=document.form2.searchname.value;
	rtn = true;
	if(str == ""){
		alert("Please input name first!");
		form2.searchname.focus();
		rtn=false;
	}
	else if(str.length<=2){
		alert("String you input is too short!");
		form2.searchname.focus();
		rtn=false;
	}
	else
		rtn = true;
	return rtn;
}
</script>
</head>
<link rel="stylesheet" href="../../css/compass.css" type="text/css" media=screen>
<body>
<center>
<p>&nbsp;</p>
  <table width="75%" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td width="49%">&nbsp; 
      </td>
      <td width="2%">&nbsp; </td>
      <td width="49%">
          <form name="form2" method="post" action="topiclist.php" onSubmit="return check()">
          <div align="right"> Locate Topic: 
            <input name="searchname" type="text" size="12" maxlength="20">
          <input type="submit" name="Submit2" value="Go"></div>
          </form>
        </td>
    </tr>
  </table>
  <p> <span class="tabletitle">Topic List 
    <?=($searchname==""?"":("(Filter String:".htmlentities($searchname).")"))?>
    </span></p>
  <table width="75%" border="1" cellspacing="0" cellpadding="0">
    <tr class="menutitle">
      <td width="27%"><a href="#" onClick="orderby('topic.name');">Topic Name</a></td>
      <td width="27%"><a href="#" onClick="orderby('unit.name');">Unit Name</a></td>
      <td width="15%">Operation</td>
    </tr>
    <?php
	$bgcolor = "#FFFFDD";
	$count = true;
	$pager->getDataLink();
	while($db->next_record()){
		$sql = "select count(*) ifexist from ADDITIONALINFO where idunit=".$db->Record['uid']." and idconcept=0 and idtopic=".$db->Record['tid']." and idexample=0";
		$db1->query($sql);		
		$db1->next_record();
		$ifexist = $db1->Record['ifexist'];
		$bgcolor = ($count?"#FFFFFF":"#FFFFDD");
?>
    <tr bgcolor="<?= $bgcolor?>">
      <td><div align="center"> 
          <?= ($db->Record['tname']==""?"&nbsp;":htmlentities($db->Record['tname']))?>
        </div></td>
      <td><div align="center"> 
          <?= ($db->Record['uname']==""?"&nbsp;":htmlentities($db->Record['uname']))?>
        </div></td>
      <td><div align="center"> 
<?
 	if($ifexist == 0){
?>
      <a href="#" onClick="MM_goToURL('self','addtopic.php?tid=<?=$db->Record['tid']?>&uid=<?=$db->Record['uid']?>');return document.MM_returnValue">Add</a>
 <?
	}
	else{
?>
      <a href="#" onClick="MM_goToURL('self','modifytopic.php?tid=<?=$db->Record['tid']?>&uid=<?=$db->Record['uid']?>');return document.MM_returnValue">Modify</a>
<?
	}
?>
     </div></td>
    </tr>
    <?php
	$count = !$count;
	}
?>
  </table>
	<br>
    <br>
	<?=$turnover?>
  <p>
<?
	if($searchname != ""){
?>
    		<input name="Submit32" type="button" onClick="MM_goToURL('self','topiclist.php');return document.MM_returnValue" value="List All Topics">
<?
	}
?>
  </p>
</center>
</body>
</html>
