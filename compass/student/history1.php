<?php
session_start();

if ($_SESSION['loginname'] == null)
	header("location:/compass/error_code.php?code=001"); 
//	echo $_SESSION['loginname'];
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(1))
		header("location:/compass/error_code.php?code=004"); 
	else{		
		include "db_mysql_mt.inc"; 
  		$idexploration=$_SESSION['idexploration'];
		$db = new DB_Sql;		
		$db->connect();
	$sql="select c.general_title cname,t.name tname,u.name uname,e.name ename,ld.idconcept idc,ld.idtopic idt,ld.idunit idu, ld.idexample ide from LOGDATA ld left join CONCEPT c on c.idconcept=ld.idconcept left join TOPIC t on ld.idtopic=t.idtopic left join UNIT u on ld.idunit=u.idunit left join EXAMPLE e on ld.idexample=e.idexample where ld.idexploration=".$idexploration." order by ld.time";
		$db->query($sql);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<link rel="stylesheet" href="../css/compass.css" type="text/css" media=screen>

<body>

<p><span class="tabletitle">You have read about the following topics and concepts</span>: 
</p> 
  
<?
		$idx=1;
		while ($db->next_record()){
			$uname=$db->Record['uname'];
			$parenpos = strpos($uname,"(");   //GWS 1/3/08 - removing parentheses and indeces from titles
			if ($parenpos !== false) $uname = substr($uname,0,$parenpos);	
			$tname=$db->Record['tname'];
			$parenpos = strpos($tname,"(");   //GWS 1/3/08 - removing parentheses and indeces from titles
			if ($parenpos !== false) $tname = substr($tname,0,$parenpos);	
			$cname=$db->Record['cname'];
			$ename=$db->Record['ename'];
			$idc=$db->Record['idc'];
			$idt=$db->Record['idt'];
			$idu=$db->Record['idu'];
			$ide=$db->Record['ide'];
?>
<table width="90%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="10%"><?=$idx?></td>
    <td width="90%"> 
      <?
		if($ename !=null)
			echo "Example: ".$ename."<br>";
		else if($cname!=null){
			if($tname!=null)
				echo "<a href=\"###\" onClick=\"window.opener.parent.document.location='explore.php?uid=".$idu."&tid=".$idt."&cid=".$idc."';window.close();\">".$cname." in ".$tname."</a><br>";
			else
				echo "<a href=\"###\" onClick=\"window.opener.parent.document.location='explore.php?cid=".$idc."';window.close();\">Definition of ".$cname."</a><br>";
		}else if($tname!=null)
				echo "<a href=\"###\" onClick=\"window.opener.parent.document.location='explore.php?uid=".$idu."&tid=".$idt."';window.close();\">".$tname."</a><br>";
		else if($uname!=null)
				echo "<a href=\"###\" onClick=\"window.opener.parent.document.location='explore.php?uid=".$idu."';window.close();\">".$uname."</a><br>";
		else
			;					
	?>
      </td>
  </tr>
<?
	$idx++;
}
?>
</table><br>
How will this information help you in completing your challenge? Have you discussed this with your group members? <br><br>

What other concepts are related to the ones that you have read? Use the maps! The maps will help you figure out related concepts.  <br><br>
After your discussion, please close this window to resume your work on CoMPASS.
</body>
</html>
<?		  	
	}
}
?>
