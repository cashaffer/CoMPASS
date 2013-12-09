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

$sql = "select * from REQUEST order by status";

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
	MM_goToURL('self','userlist.php?type=<?= $type?>&orderby='+column);
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
  <p> <span class="tabletitle">Request List </span></p>
  <table width="75%" border="1" cellspacing="0" cellpadding="0">
    <tr class="menutitle"> 
      <td>Name</td>
      <td>Profession</td>
      <td>Organization</td>
      <td>E-mail</td>
      <td>Telephone</td>
      <td>Reason</td>
      <td>Status</td>
      <td>Approve</td>
    </tr>
    <?php
	$bgcolor = "#FFFFDD";
	$count = true;
	while($db->next_record()){
		$bgcolor = ($count?"#FFFFFF":"#FFFFDD");
?>
    <tr bgcolor="<?= $bgcolor?>"> 
      <td><div align="center"> 
          <?= $db->Record['lastname'].",".$db->Record['firstname']?>
        </div></td>
      <td><div align="center"> 
          <?= $db->Record['profession']?>
        </div></td>
      <td><div align="center"> 
          <?= $db->Record['organization']?>
        </div></td>
      <td> 
        
        <div align="center"><?= $db->Record['email']?></div></td>
      <td><div align="center"> 
          <?= (($db->Record['telephone']==null)?"N/A":$db->Record['telephone'])?>
        </div></td>
      <td><div align="center">
          <?= (($db->Record['reason']==null)?"N/A":$db->Record['reason'])?>
        </div></td>
      <td> 
        <div align="center">
          <?= (($db->Record['status']==0)?"Not approved":"Approved")?>
        </div></td>
      <td><div align="center"> 
	  <?php
	  if($db->Record['status']==0){
	  ?>
	  <a href="###" onClick="MM_goToURL('self','approve.php?rid=<?=$db->Record['idrequest']?>&firstname=<?=$db->Record['firstname']?>&lastname=<?=$db->Record['lastname']?>');return document.MM_returnValue;">Go</a>
	  <?php
	  }else
	  	echo("&nbsp;");
	  ?>
	  </div></td>
    </tr>
    <?php
	$count = !$count;
	}
?>
  </table>
</center>
</body>
</html>
