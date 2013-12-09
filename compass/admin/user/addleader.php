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
$gid = $_REQUEST['idgroup'];


$sql = "select * from GROUPMEMBERS where idgroup=".$gid;

$query = $db->query($sql);
$db->next_record();
$status = $db->Record['status'];
$idstudent = $db->Record['idstudent'];
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
	MM_goToURL('self','studentlist1.php?orderby='+column);
	return document.MM_returnValue;
}

</script>
</head>
<link rel="stylesheet"  href="../../css/compass.css" type="text/css" media=screen>
<body>
<center>
<p>&nbsp;</p>
  <p><span class="tabletitle">Modify Group Info. </span> </p>
  <form name="form1" method="post" action="saveleaderinfo.php"  onSubmit="return check()">
    <table width="75%" border="0" cellspacing="0" cellpadding="0">
      
     
      <tr> 
        <td height="22"> <div align="right">Group Leader</div></td>
        <td>&nbsp;</td>
        <td> <select name="leader">
            <?php
	$sql = "select iduser,loginname,firstname,lastname,g.isleader isleader,g.idstudent idstudent from USER,GROUPMEMBERS g where iduser=g.idstudent and g.idgroup=".$gid." order by loginname";

	$query = $db->query($sql);
	while($db->next_record()){
?>
            <option value="<?=$db->Record['iduser']?>" <?=($db->Record['isleader']==1)?"selected":" "?>>
            <?=$db->Record['loginname']?>
            (
            <?=$db->Record['firstname']?>
            <?=$db->Record['lastname']?>
            )</option>
            <?php
	}
?>
          </select></td>
      </tr>   
      
    </table>

    <p> 
      <input type="hidden" name="gid" value="<?=$gid?>">
      <input type="submit" name="Submit" value="Submit">
      &nbsp;&nbsp; 
      <input name="Submit2" type="button" onClick="MM_goToURL('self','studentlist1.php?gid=<?=$gid?>');return document.MM_returnValue" value="Cancel">
  </form>
  </p>
</center>
</body>
</html>


