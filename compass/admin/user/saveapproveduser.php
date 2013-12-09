<?php
session_start();

if ($_SESSION['loginname'] == null)
//	header("location:/compass/error_code.php?code=001"); 
	echo $_SESSION['loginname'];
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(8))
		header("location:/compass/error_code.php?code=004"); 
	else{		
		include "db_mysql_mt.inc"; 
			
		$db = new DB_Sql;
		
		$db->connect();

//Researcher as default		
		$usertype = 4;
		$rid = $_REQUEST['rid'];
		$loginname = $_REQUEST['loginname'];
		$passwd = $_REQUEST['passwd'];
		$lastname = $_REQUEST['lastname'];
		$firstname = $_REQUEST['firstname'];
		$status = 0;
		
		$sql = "insert into user(loginname,lastname,firstname,passwd,usertype,status) values('"
			.$loginname."','".$lastname."','".$firstname."','".$passwd."',".$usertype.",".$status.")";
		
		$query = $db->query($sql);
		$sql = "update REQUEST set status=1 where idrequest=".$rid;
		$query = $db->query($sql);
		$sql = "select firstname,lastname,email from REQUEST where idrequest=".$rid;
		$query = $db->query($sql);
		$db->next_record();
		$lastname = $db->Record['lastname'];
		$firstname = $db->Record['firstname'];
		$email = $db->Record['email'];
		$message = "Hi ".$firstname." ".$lastname.",\r\nWe have created an account for you. Here is your account information.\r\nUsername: ".$loginname."\r\nPassword: ".$passwd."\r\n\r\nThis is an automatic email. Please do not reply it.Thanks!\r\nCoMPASS Administrator";

/* and now mail it */
		require_once 'Mail.php';

		$conf['mail'] = array(
			'host' => 'smtp.126.com', 
			'auth' => true, 
			'username' => 'cyclone.wisc', 
			'password' => 'shenjian' 
		);

		$headers['From'] = 'cyclone.wisc@126.com';
		$headers['To'] = $email; 
		$headers['Subject'] = "Compass Account"; 
		$mail_object = &Mail::factory('smtp', $conf['mail']);

		$mail_res = $mail_object->send($headers['To'], $headers, $message);

		if( Pear::isError($mail_res) ){ //?¨¬2a¡ä¨ª?¨®
			die($mail_res->getMessage());
		}
		
?>
<html>
<head>

<link rel="stylesheet"  href="../../css/compass.css" type="text/css" media=screen>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
</head>

<body marginheight=0 marginwidth=0 topmargin=0 leftmargin=0>
<br>
<br>
<br>
<table width=528 cellspacing=1 cellpadding=4 border=0 align=center class=bgcolor5>
	<tr class=bgcolor2>
	<td align=center nowrap class=f14w>
	<b>[ User Info ]</b>&nbsp;
	</td>
	</tr>
	<tr>
	<td colspan=2 height=150 align=center class=bgcolor1> <p>
        <?= "User ".$loginname." is added successfully!"?>
        <br>E-mail has been sent to the applicant.
      </p>
	</td>
	</tr>
	<tr>
	<td align=center colspan=2 class=bgcolor3><input name="Submit" type="button" onClick="MM_goToURL('self','requestlist.php');return document.MM_returnValue" value="Continue to deal requests"> 
    </td>
	</tr>
</table>

</body>
</html>
<? 
	}
}
?>