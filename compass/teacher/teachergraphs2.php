<?php
session_start();

if ($_SESSION['loginname'] == null)
	header("location:/compass/error_code.php?code=001"); 
//	echo $_SESSION['loginname'];
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(2))
		header("location:/compass/error_code.php?code=004"); 
	else{		
		include "db_mysql_mt.inc"; 
			
		$db = new DB_Sql;
		
		$db->connect();
		$sql="select * from exploration where idclass = '".$_REQUEST['Class']."' ORDER BY TIME DESC";
		$db->query($sql);
		//echo $_SESSION['iduser'];

	}
}



?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <form name="form1" action="navgraph.php" method="post"  onSubmit="return form1_validate(this);">
<strong>CoMPASS Navigation Graphs<strong>
<br><br>
<input type="hidden" name="Class" value="<?= $_REQUEST['Class'] ?>" />
<strong>Date: </strong>  
<SELECT NAME="selecteddate">
    
<?php
		while($db->next_record()){
			$lastdate = $date;
			$datetime = $db->Record['time'];	 
			$date = substr($datetime,0,10);

			if ($date != $lastdate) {

?>
  
  <option value="<?=$date?>"> <?=$date?></option>
  <?php
	}
}
?>
</SELECT>

<br><br>
</head>

 <input type="submit" name="Submit" value="Show Graphs"/>
</form>
</html>