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

$type = $_REQUEST['type'];
$orderby = $_REQUEST['orderby'];
$searchname = $_REQUEST['searchname'];
if($searchname == null)
	$searchname = "";

if($orderby == null)
	$orderby = "u.name,t.name";

$db1 = new DB_Sql;
$db1->connect();
$sql = "select t.idtopic tid,t.name tname,u.name uname from TOPIC t,UNIT u where t.idunit=u.idunit order by u.name,t.name";
$db1->query($sql);

$sql = "select c1.idconcept cid1,c2.idconcept cid2,t.idtopic tid,u.idunit uid,c1.general_title cfrom, c2.general_title cto,t.name tname,u.name uname,r.name rname "
		."from CONCEPTRELATION cr,CONCEPT c1,CONCEPT c2,UNIT u,TOPIC t,RELATION r "
		."where cr.conceptfrom=c1.idconcept and cr.conceptto=c2.idconcept and cr.idtopic=t.idtopic and t.idunit=u.idunit and cr.idrelation=r.idrelation ";
if($searchname != "")
	$sql=$sql."and t.idtopic=".$searchname;
$sql=$sql." order by ".$orderby;


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
	MM_goToURL('self','relationlist.php?searchname=<?= $searchname?>&orderby='+column);
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
          <form name="form2" method="post" action="relationlist.php">
          <div align="right"> Locate in Topic: 
            <select name="searchname">
              <?
	while($db1->next_record()){
?>
              <option value="<?= $db1->Record['tid']?>">
              <?= $db1->Record['uname']?>
              =&gt;
              <?= $db1->Record['tname']?>
              </option>
              <?
	}
?>
            </select>
            <input type="submit" name="Submit2" value="Go"></div>
          </form>
        </td>
    </tr>
  </table>
  <p> <span class="tabletitle">Concept_Relation List</span></p>
  <table width="90%" border="1" cellspacing="0" cellpadding="0">
    <tr class="menutitle"> 
      <td width="15%" height="20"><a href="#" onClick="orderby('c1.general_title');">From</a></td>
      <td width="15%"><a href="#" onClick="orderby('c2.general_title');">To</a></td>
      <td width="20%"><a href="#" onClick="orderby('t.name');">Topic Name</a></td>
      <td width="16%"><a href="#" onClick="orderby('u.name');">Unit Name</a></td>
      <td width="15%"><a href="#" onClick="orderby('r.name');">Relation</a></td>
      <td width="9%">Modify</td>
      <td width="10%">Delete</td>
    </tr>
    <?php
	$bgcolor = "#FFFFDD";
	$count = true;
	$pager->getDataLink();
	while($db->next_record()){
		$bgcolor = ($count?"#FFFFFF":"#FFFFDD");
?>
    <tr bgcolor="<?= $bgcolor?>"> 
      <td><div align="center"> 
          <?= ($db->Record['cfrom']==""?"&nbsp;":htmlentities($db->Record['cfrom']))?>
        </div></td>
      <td><div align="center"> 
          <?= ($db->Record['cto']==""?"&nbsp;":htmlentities($db->Record['cto']))?>
        </div></td>
      <td> 
        
        <div align="center"><?= ($db->Record['tname']==""?"&nbsp;":htmlentities($db->Record['tname']))?></div></td>
      <td> 
        
        <div align="center"><?= ($db->Record['uname']==""?"&nbsp;":htmlentities($db->Record['uname']))?></div></td>
      <td><div align="center">
          <?= ($db->Record['rname']==""?"&nbsp;":htmlentities($db->Record['rname']))?>
        </div></td>
      <td> <div align="center"><a href="#" onClick="MM_goToURL('self','modifyrelation.php?cid1=<?=$db->Record['cid1']?>&cid2=<?=$db->Record['cid2']?>&tid=<?=$db->Record['tid']?>');return document.MM_returnValue">Go</a></div></td>
      <td><div align="center"><a href="#" onClick="MM_goToURL('self','deleterelation.php?cid1=<?=$db->Record['cid1']?>&cid2=<?=$db->Record['cid2']?>&tid=<?=$db->Record['tid']?>');return document.MM_returnValue">Go</a></div></td>
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
    <input name="Submit3" type="button" onClick="MM_goToURL('self','addrelation.php');return document.MM_returnValue" value="Add New Concept_Relation">
<?
	if($searchname != ""){
?>
    &nbsp;&nbsp; <input name="Submit32" type="button" onClick="MM_goToURL('self','relationlist.php');return document.MM_returnValue" value="List All Concept_Relations">
<?
	}
?>
  </p>
</center>
</body>
</html>
