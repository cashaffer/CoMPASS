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
//include "config.inc"; 
include "pager.inc"; 
	
$db = new DB_Sql;

$db->connect();

$db1 = new DB_Sql;

$db1->connect();

$type = null;
$orderby = null;
$searchname = null;

if(isset($_REQUEST['type'])){
$type = $_REQUEST['type'];}

if(isset($_REQUEST['orderby'])){
$orderby = $_REQUEST['orderby'];}

if(isset($_REQUEST['searchname'])){
$searchname = $_REQUEST['searchname'];}

if($searchname == null)
	$searchname = "";

if($orderby == null)
	$orderby = "name";

$sql = "select idexample,name from example ";
if($searchname != "")
	$sql=$sql."where name like '%".$searchname."%' ";
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
	MM_goToURL('self','examplelist.php?searchname=<?= $searchname?>&orderby='+column);
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
          <form name="form2" method="post" action="examplelist.php" onSubmit="return check()">
          <div align="right"> Locate Example: 
            <input name="searchname" type="text" size="12" maxlength="20">
          <input type="submit" name="Submit2" value="Go"></div>
          </form>
        </td>
    </tr>
  </table>
  <p> <span class="tabletitle">Example List 
    <?=($searchname==""?"":("(Filter String:".htmlentities($searchname).")"))?>
    </span></p>
  <table width="75%" border="1" cellspacing="0" cellpadding="0">
    <tr class="menutitle"> 
      <td width="27%"><a href="#" onClick="orderby('name');">Example Name</a></td>
      <td width="27%">Related Concepts</td>
      <td width="15%">Modify</td>
      <td width="12%">Delete</td>
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
          <?= ($db->Record['name']==""?"&nbsp;":htmlentities($db->Record['name']))?>
        </div></td>
      <td><div align="center"> 
          <?php
	$sql="select c.general_title cname from CONCEPT c,EXAMPLE_HAS_CONCEPT e where e.idconcept=c.idconcept and e.idexample=".$db->Record['idexample'];
	$db1->query($sql);
	$rc="";
	while($db1->next_record()){
    	$rc=$rc.($db1->Record['cname']==""?"&nbsp;":htmlentities($db1->Record['cname']))."<br>";
	}
	if($rc != "")
		$rc = substr($rc,0,strlen($rc)-4);
	else
		$rc ="&nbsp;";
	echo($rc);
?>
        </div></td>
      <td><div align="center"> <a href="#" onClick="MM_goToURL('self','modifyexample.php?id=<?=$db->Record['idexample']?>');return document.MM_returnValue">Go</a></div></td>
      <td><div align="center"><a href="#" onClick="if(confirm('Are you sure?')) self.location='deleteexample.php?id=<?=$db->Record['idexample']?>';">Go</a></div></td>
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
    <input name="Submit3" type="button" onClick="MM_goToURL('self','addexample.php');return document.MM_returnValue" value="Add New Example">
<?php
	if($searchname != ""){
?>
    &nbsp;&nbsp; <input name="Submit32" type="button" onClick="MM_goToURL('self','examplelist.php');return document.MM_returnValue" value="List All Examples">
<?php
	}
?>
  </p>
</center>
</body>
</html>
