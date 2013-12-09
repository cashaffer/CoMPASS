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
		$sql="select idclass,name from class where idteacher = '".$_SESSION['iduser']."'";
		$db->query($sql);
		//echo $_SESSION['iduser'];

	}
}



?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <form name="form1" action="teachergraphs2.php" method="post"  onSubmit="return form1_validate(this);">
<strong>CoMPASS Navigation Graphs<strong>
<br><br>
<strong>Class: </strong>  
<SELECT NAME="Class">
    
<?php
		while($db->next_record()){
			$classname = $db->Record['name'];	 

?>
  
  <option value="<?=$db->Record['idclass']?>"> <?=$db->Record['name']?></option>
  <?php
	}
?>
</SELECT>

<br><br>
</head>

 <input type="submit" name="Submit" value="Select"/>
 <br><br><br><br>
</strong>
 <a href="selectunit.php">return to menu</a>
</form>
</html>