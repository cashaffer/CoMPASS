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

$sql = "SELECT * FROM error_reports e order by time desc limit 100";
$result = $db->query($sql);
?>
<html>
<body>
<center>
	<table  border="1" cellspacing="0" cellpadding="0">
	<tr>
		<th>Error_id</th>
		<th>Name</th>
		<th>Class</th>
		<th>Teacher_name</th>
		<th>Time</th>
		<th>IPAddr</th>
		<th>Browser_info</th>
		<th>Report</th>
		<th>Misc_details</th>
	</tr>
<?php
while($db->next_record()){
?>
		<tr> 
			<td><?= $db->Record['error_id']?></td> 
			<td><?= $db->Record['name']?></td> 
			<td><?= $db->Record['class']?></td> 
			<td><?= $db->Record['teacher_name']?></td> 
			<td><?= $db->Record['time']?></td> 
			<td><?= $db->Record['ipaddr']?></td> 
			<td><?= substr($db->Record['browser_info'], 0, 60)?></td> 
			<td><?= $db->Record['report']?></td> 
			<td><?= $db->Record['misc_details']?></td> 
		</tr>
<?php
}
?>
</table>
</center>
</body>
</html>
