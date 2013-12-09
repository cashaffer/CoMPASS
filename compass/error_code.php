<?php
//define error code and corresponding text
if ($GLOBALS['errorcode'] == null){
	$error_code['000'] = "There is something wrong here. Click <a href='index.htm'>here</a> to login";
	$error_code['001'] = "You did not login yet or inactive for a long while. Click <a href='index.htm'>here</a> to login";
	$error_code['002'] = "Password is incorrect. Click <a href='index.htm'>here</a> to login";
	$error_code['003'] = "Username does't exist. Click <a href='index.htm'>here</a> to login";
	$error_code['004'] = "You have not enough power to open this page. Click <a href='#' onclick='history.back();'>here</a> to go back";
	$error_code['005'] = "Record already exists in Database. Click <a href='#' onclick='history.back();'>here</a> to go back";
	$error_code['006'] = "Record DOES NOT exist in Database. Click <a href='#' onclick='history.back();'>here</a> to go back";
	$error_code['007'] = "Fail to update CONCEPT XML file. Please check the database!";
	$error_code['008'] = "Fail to update RELATION XML file. Please check the database!";
	$error_code['009'] = "Fail to update EXAMPLE XML file. Please check the database!";
	$GLOBALS['errorcode'] = $error_code;
}
?> 
<html>
<head>
<title>Error Page</title>
<link rel="stylesheet" href="./css/compass.css" type="text/css" media=screen>
</head>

<body marginheight=0 marginwidth=0 topmargin=0 leftmargin=0>
<br>
<br>
<br>
<table width=528 cellspacing=1 cellpadding=4 border=0 align=center class=bgcolor5>
	<tr class=bgcolor2>
	<td align=center nowrap class=f14w>
	<b>[ Error Info ]</b>&nbsp;
	</td>
	</tr>
	<tr>
	<td colspan=2 height=150 align=center class=bgcolor1>
	<p><?= $GLOBALS['errorcode'][$_REQUEST['code']]?></p>
	</td>
	</tr>
	<tr>
	<td align=center colspan=2 class=bgcolor3>&nbsp; </td>
	</tr>
</table>

</body>
</html>