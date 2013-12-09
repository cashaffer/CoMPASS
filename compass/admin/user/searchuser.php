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

$searchname = $_REQUEST['searchname'];
$orderby = $_REQUEST['orderby'];

if($orderby == null)
	$orderby = "loginname";

$typenames = array(1 => "Student", 2 => "Teacher", 4 => "Researcher", 8 => "Administrator");

$sql = "select * from USER where loginname like '%".$searchname."%' or lastname like '%".$searchname."%' or firstname like '%".$searchname."%' order by ".$orderby;

$query = $db->query($sql);

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
	MM_goToURL('self','searchuser.php?name=<?= $name?>&orderby='+column);
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
<link rel="stylesheet"  href="../../css/compass.css" type="text/css" media=screen>
<body>
<center>
<p>&nbsp;</p>
  <table width="75%" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td width="49%"> 
        <form name="form1" method="post" action="userlist.php">
       List All 
        <select name="type">
          <option value="1">Students</option>
          <option value="2">Teachers</option>
          <option value="4">Researchers</option>
          <option value="8">Administrators</option>
        </select> &nbsp;&nbsp; <input type="submit" name="Submit" value="Go"> 
        </form>
      </td>
      <td width="2%">&nbsp; </td>
      <td width="49%">
          <form name="form2" method="post" action="searchuser.php"  onSubmit="return check()"><div align="right">
          Locate User: 
          <input name="searchname" type="text" size="12" maxlength="20">
          <input type="submit" name="Submit2" value="Go"></div>
          </form>
        </td>
    </tr>
  </table>
  <p class="tabletitle"> Result List </p>
  <table width="75%" border="1" cellspacing="0" cellpadding="0">
    <tr class="menutitle"> 
      <td><a href="###" onClick="orderby('loginname');">Login Name</a></td>
      <td><a href="###" onClick="orderby('firstname');">First Name</a></td>
      <td><a href="###" onClick="orderby('lastname');">Last Name</a></td>
      <td><a href="###" onClick="orderby('usertype');">User Type</a></td>
      <td><a href="###" onClick="orderby('status');">Status</a></td>
      <td>Modify</td>
    </tr>
    <?php
	$bgcolor = "#FFFFDD";
	$count = true;
	while($db->Record = $query->getrow()){
		$bgcolor = ($count?"#FFFFFF":"#FFFFDD");
?>
    <tr bgcolor="<?= $bgcolor?>"> 
      <td><div align="center"> 
          <?= $db->Record['loginname']?>
        </div></td>
      <td><div align="center"> 
          <?= $db->Record['firstname']?>
        </div></td>
      <td><div align="center"> 
          <?= $db->Record['lastname']?>
        </div></td>
      <td><div align="center"><?= $typenames[$db->Record['usertype']]?></div></td>
      <td><div align="center"> 
          <?= (($db->Record['status']==0)?"Normal":"Frozen")?>
        </div></td>
      <td><div align="center"> <a href="###" onClick="MM_goToURL('self','modifyuser.php?uid=<?=$db->Record['iduser']?>');return document.MM_returnValue">Go</a></div></td>
    </tr>
    <?php
	}
?>
  </table>
  <p>&nbsp; </p>
</center>
</body>
</html>
