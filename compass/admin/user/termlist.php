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

$orderby = null;

if(isset($_REQUEST['orderby'])){
$orderby = $_REQUEST['orderby'];}

if($orderby == null)
	$orderby = "name";

$sql = "select idterm,name from term";
$query = $db->query($sql);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Group List</title>
<script language="JavaScript" type="text/JavaScript">

<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->


</script>
</head>
<link rel="stylesheet"  href="../../css/compass.css" type="text/css" media=screen>
<body>
<center>
<p>&nbsp;</p>


  <p class="tabletitle">Term List </p>
  <table width="50%" >
    <tr align="center"> 
    <td align="center"><select name ="term">
              <?php
	
	while($db->next_record()){
?>
            <option value="<?=$db->Record['idterm']?>">
            <?=$db->Record['name']?>
           
            </option>
            <?php
	}
?>
          </select></td>
    </tr>
    
	 </table>
    
  <p>
    <input name="Submit4" type="button"  value="Add New Term" onClick="MM_goToURL('self','addnewterm.php');return document.MM_returnValue">
 </p>


<br>
  
</center>

</body>
</html>
