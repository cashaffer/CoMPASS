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

include "db_mysql_mt.inc"; 
	
$db = new DB_Sql;

$db->connect();

$sql = "select iduser,loginname,firstname,lastname from USER where usertype=2 order by loginname";

$query = $db->query($sql);

// need a new database connection, because doing the query in the same conn deletes the previous records
$db2 = new DB_Sql;
$db2->connect();
$sql2 = "select idunit, name from UNIT u order by u.idunit";
$query2 = $db2->query($sql2);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<script language="JavaScript" type="text/JavaScript">
<!--

	function processCheckboxes() {
		try {
		var d = document.getElementById("unitsdiv");
		var hidden = d.getElementById("hiddeninput");
		var checkboxes = d.getElementsByTagName("input");
		for (var c = checkboxes.length, i =0; i<c; i++) {
			if (checkboxes[i].checked) hidden.value += "," + checkboxes[i].value;
		}
		}catch(e) {alert(e);}
	}
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
function orderby(column){
	MM_goToURL('self','classlist.php?orderby='+column);
	return document.MM_returnValue;
}
function check(){
	str=document.form1.classname.value;
	rtn = true;
	if(str == ""){
		alert("Please input a classname");
		form1.classname.focus();
		rtn=false;
	}
	else if(str.length<=2){
		alert("Classname should be atleast 3 characters");
		form1.classname.focus();
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
  <p><span class="tabletitle">Add a New Class </span> </p>
  <form name="form1" method="post" action="savenewclass.php"  onSubmit="return check()">
    <table width="75%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td width="48%"><div align="right">Class Name:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="48%"><input name="classname" type="text" size="15" maxlength="25"></td>
      </tr>
      <tr> 
        <td width="48%" height="22"> <div align="right">Description::</div></td>
        <td width="4%">&nbsp;</td>
        <td width="48%"><textarea name="description" cols="12" rows="5"></textarea></td>
      </tr>
      <tr> 
        <td height="22"> <div align="right">Teacher:</div></td>
        <td>&nbsp;</td>
        <td> 
          <select name="teacher">
<?php
	while($i = mysql_fetch_row($query)){
?>
            <option value="<?=$i[0]?>"><?=$i[1]?> (<?=$i[2]?> <?=$i[3]?>)</option>
	<?php
	}
	mysql_free_result($query);
?>
          </select></td>
      </tr>
      <tr> 
        <td width="48%"><div align="right">Status:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="48%"><input name="status" type="radio" value="0" checked>
          Normal &nbsp;&nbsp; <input type="radio" name="status" value="1">
          Halt</td>
      </tr>
	<tr style="background-color:lightgray">
        <td height="22"> <div align="right">Add Units:</div></td>
        <td>&nbsp;</td>
	<td>
	<div id="unitsdiv">
		<?php
		 while ($j = mysql_fetch_row($query2) ) {
		?>
			<input type="checkbox" value="<?=$j[0]?>" 
			<?php if ($j[0] == 11 || $j[0] == 18) { ?>
			checked
			<?php } ?>
                	/> <?=$j[1]?> <br/>
		<?php
		 }
		?>
	</div>
	<input id="hiddeninput" name="units" type="text" style="display:none"/>
	</td>
	</tr>


    </table>
    <p> 
      <input type="submit" name="Submit" value="Submit">
      &nbsp;&nbsp; 
      <input name="Submit2" type="button" onClick="processCheckboxes();MM_goToURL('self','classlist.php');return document.MM_returnValue" value="Cancel">
  </form>
  </p>
</center>
</body>
</html>
