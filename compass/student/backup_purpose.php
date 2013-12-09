<?php
session_start();
if ($_SESSION['loginname'] == null)
	header("location:/compass/error_code.php?code=001"); 
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(1))
		header("location:/compass/error_code.php?code=004"); 
}	

include "db_mysql_mt.inc"; 
include "config_mt.inc"; 
	
$db = new DB_Sql;

$db->connect();

$sql = "select c.idclass idclass,c.name cname from TAKESCLASS tc,CLASS c where tc.idclass=c.idclass and tc.idstudent=".$_SESSION['iduser'];
$db->query($sql);


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
<link rel="stylesheet" href="../css/compass.css" type="text/css" media=screen>
<body>
<center>
  <p class="tabletitle">Welcome! 
    <?=$_SESSION['loginname']?>
  </p>
  <form name="form1" method="post" action="startexploration.php">
    <table width="80%" border="1" cellspacing="1" cellpadding="1">
<?
$idclass=0;
if($db->next_record())
	$idclass=$db->Record['idclass'];
/*
?>
      <tr> 
        <td><p class="bgcolor5">Your Class is :</p>
          <p> 
            <?
	$i=0;
		while($db->next_record()){
?>
            <input name="idclass" type="radio" value="<?=$db->Record['idclass']?>" <?=($i==0?"checked":"")?>>
            <?=$db->Record['cname']?>
            <?
		$i++;
	}
?>
          </p></td>
      </tr>
<?
*/
?>
      <tr> 
        <td><p class="bgcolor5">Who is your group leader today? (If you are using CoMPASS individually, put in your name.)</p>
          <p> 
            <input name="leader" type="text" size="50">
            <input type="hidden" name="idclass" value="<?=$idclass?>">
          </p></td>
      </tr>
      <tr> 
        <td><p class="bgcolor5">what topic are you working on?</p>
            <input name="question" type="text" size="50">
          <div align="center"> </div></td>
      </tr>
      <tr> 
        <td><p class="bgcolor5">Where are you logging in from :</p>
          <p> 
            <input name="place" type="radio" value="1" checked>
            School-During Science Class<br>
            <input type="radio" name="place" value="2">
            School-Outside Science Class <br>
            <input type="radio" name="place" value="3">
            Home<br>
            <input name="place" type="radio" value="4">
            Other </p></td>
      </tr>
      <tr> 
        <td><p class="bgcolor5">What's your goal for using Compass today :</p>
          <p> 
            <input name="goal" type="radio" value="1" checked>
            Homework <br>
            <input type="radio" name="goal" value="2">
            Project <br>
            <input type="radio" name="goal" value="3">
            Labs <br>
            <input type="radio" name="goal" value="4">
            Class work <br>
            <input type="radio" name="goal" value="5">
            Fun <br>
            <input type="radio" name="goal" value="6">
            Other</p></td>
      </tr>
    </table>
  <p>
    <input type="submit" name="Submit" value="Submit">
  </p>
  </form>
</center>
</body>
</html>
