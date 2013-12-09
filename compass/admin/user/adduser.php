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
$type = $_REQUEST['type'];
$typenames = array(1 => "Student", 2 => "Teacher", 4 => "Researcher", 8 => "Administrator");

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
	passwd=document.form1.passwd.value;
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
	else if(passwd == ""){
		alert("Please input password!");
		form1.passwd.focus();
		rtn=false;
	}
	else if(passwd.length<=2){
		alert("Password you input is too short!");
		form1.passwd.focus();
		rtn=false;
	}
	else if(passwd != document.form1.passwd1.value){
		alert("Passwords you input twice are different!");
		form1.passwd.value="";
		form1.passwd1.value="";
		form1.passwd.focus();
		rtn=false;
	}
	else
		rtn = true;


	var shouldloop = document.form1.from.value;
	if (shouldloop.length < 1)
	  document.form1.shouldloop.value=null;
	else 
	  document.form1.shouldloop.value = 1;

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

function fillin() {
	var str = document.getElementById('loginname').value;
	document.getElementById('passwd').value = str;
	document.getElementById('passwd1').value = str;
}

</script>
</head>
<link rel="stylesheet"  href="../../css/compass.css" type="text/css" media=screen>
<body>
<center>
<p>&nbsp;</p>
  <p><span class="tabletitle">Add a New 
    <?= $typenames[$type]?>
		</span> </p> (Tip: If you want to add a lot of accounts, use <a href="add_users_in_bulk.php?type=<?=$type ?>">this bulk edit page</a>).<br/>
  <form name="form1" method="post" action="savenewuser.php"  onSubmit="return check()">
  <table width="75%" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td width="48%"><div align="right">User Name:</div></td>
      <td width="4%">&nbsp;</td>
      <td width="48%"><input id="loginname" name="loginname" type="text" size="12" maxlength="15"></td>
    </tr>
    <tr> 
      <td width="48%"><div align="right">Password:</div></td>
      <td width="4%">&nbsp;</td>
      <td width="48%"><input name="passwd" id="passwd" type="password" size="12" maxlength="15" onfocus="fillin()"></td>
    </tr>
    <tr> 
      <td width="48%"><div align="right">Rewrite Password:</div></td>
      <td width="4%">&nbsp;</td>
      <td width="48%"><input name="passwd1" id="passwd1" type="password" size="12" maxlength="15"></td>
    </tr>
    <tr> 
      <td width="48%" height="22"> <div align="right">Lastname::</div></td>
      <td width="4%">&nbsp;</td>
      <td width="48%"><input name="lastname" type="text" size="12" maxlength="15"></td>
    </tr>
    <tr> 
      <td width="48%"><div align="right">Firstname:</div></td>
      <td width="4%">&nbsp;</td>
      <td width="48%"><input name="firstname" type="text" size="12" maxlength="15"></td>
    </tr>
    <tr> 
      <td width="48%"><div align="right">Status:</div></td>
      <td width="4%">&nbsp;</td>
      <td width="48%"><input name="status" type="radio" value="0" checked>
        Normal &nbsp;&nbsp; 
        <input type="radio" name="status" value="1">
        Halt</td>
    </tr>
  </table>
    <input type="hidden" name="utype" value="<?=$type?>">
    <input type="hidden" name="shouldloop"/>
    <p>
    <br/>
    <div style="border:1px solid gray;color:gray">
    <b> Optional: To create lot of users.</b><br/>For example, to add users "ABC21" through "ABC34", enter "ABC" in the user name field above and enter "21" and "34" in the "from" and "to" fields below.<br/>Note: the "password" that you type above is ignored, and the full login name (ABCxx) is set as the password.
    <br/>
    From:<input name="from" size="4"/><br/>
    To:<input name="to" size="4"/><br/><br/>
    </div>
    <input type="submit" name="Submit" value="Submit">
  </form>
  </p>
</center>
</body>
</html>
