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
$uid = $_REQUEST['uid'];

$typenames = array(1 => "Student", 2 => "Teacher", 4 => "Researcher", 8 => "Administrator");

$sql = "select * from USER where iduser=".$uid;

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
	MM_goToURL('self','userlist.php?type=<?= $type?>&orderby='+column);
	return document.MM_returnValue;
}
function check(){
	str=document.form1.loginname.value;
	rtn = true;
	if(str == ""){
		alert("Please input username first!");
		form1.loginname.focus();
		rtn=false;
	}
	else if(str.length<=2){
		alert("String you input is too short!");
		form1.loginname.focus();
		rtn=false;
	}
	else if(fucPWDchk(str)==0){
		alert("String you input includes special characters!");
		form1.loginname.focus();
		rtn=false;	
	}
	else
		rtn = true;
	return rtn;
}

function fucPWDchk(str)
{
  var strSource ="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
  var ch;
  var i;
  var temp;
  
  for (i=0;i<=(str.length-1);i++)
  {
  
    ch = str.charAt(i);
    temp = strSource.indexOf(ch);
    if (temp==-1) 
    {
     return 0;
    }
  }
  if (strSource.indexOf(ch)==-1)
  {
    return 0;
  }
  else
  {
    return 1;
  } 
}
</script>
</head>
<link rel="stylesheet"  href="../../css/compass.css" type="text/css" media=screen>
<body>
<center>
<p>&nbsp;</p>
  <p><span class="tabletitle">Modify User Info.
    <?= $typenames[$db ->Record['usertype']]?>
    </span> </p>
  <form name="form1" method="post" action="saveuserinfo.php"  onSubmit="return check()">
    <table width="75%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td width="48%"><div align="right">User Name:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="48%"><input name="loginname" type="text" value="<?= $db->Record['loginname']?>" size="12" maxlength="15"></td>
      </tr>
      <tr> 
        <td width="48%" height="22"> <div align="right">Lastname::</div></td>
        <td width="4%">&nbsp;</td>
        <td width="48%"><input name="lastname" type="text" size="12" value="<?= $db->Record['lastname']?>" maxlength="15"></td>
      </tr>
      <tr> 
        <td width="48%"><div align="right">Firstname:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="48%"><input name="firstname" type="text" value="<?= $db->Record['firstname']?>" size="12" maxlength="15"></td>
      </tr>
      <tr> 
        <td><div align="right">User Type::</div></td>
        <td>&nbsp;</td>
        <td><input name="utype" type="radio" value="1" <?=($db->Record['usertype']==1?"checked":"")?>>
          Student&nbsp;&nbsp; <input name="utype" type="radio" value="2" <?=($db->Record['usertype']==2?"checked":"")?>>
          Teacher&nbsp; 
          <input name="utype" type="radio" value="4" <?=($db->Record['usertype']==4?"checked":"")?>>
          Researcher&nbsp; 
          <input name="utype" type="radio" value="8" <?=($db->Record['usertype']==8?"checked":"")?>>
          Administrator</td>
      </tr>
      <tr> 
        <td width="48%"><div align="right">Status:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="48%"><input name="status" type="radio" value="0" <?=($db->Record['status']==0?"checked":"")?>>
          Normal &nbsp;&nbsp; <input type="radio" name="status" value="1" <?=($db->Record['status']==1?"checked":"")?>>
          Halt</td>
      </tr>
    </table>
    <p>
      <input type="hidden" name="uid" value="<?=$uid?>">
      <input type="submit" name="Submit" value="Submit">
  </form>
  </p>
</center>
</body>
</html>
