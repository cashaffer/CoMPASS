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
//include "config.inc"; 
	
$db = new DB_Sql;

$db->connect();


$sql="select * from PRETEST_KEY order by idquestion";

$query = $db->query($sql);
$keys=array();
while($db->next_record()){
	$keys[$db->Record['idquestion']]=$db->Record['answer'];
}

//$answer=array("","A","B","C","D","E","F");
$answer=array("","1","2","3","4","5","6");
$gender=array("","Female","Male");

$sql="select * from PRETEST_ANSWER order by teachername,classname,studentname";

$query = $db->query($sql);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script language="JavaScript" type="text/JavaScript">
</script>
</head>
<link rel="stylesheet" href="../../css/compass.css" type="text/css" media=screen>
<body>
<center>
<p>&nbsp;</p>
  <p> <span class="tabletitle">Pretest Answer List</span></p>
  <table border="1" cellspacing="0" cellpadding="0">
    <tr class="menutitle"> 
      <td width="40" rowspan="2">Student</td>
      <td width="40" rowspan="2">Teacher</td>
      <td width="40" rowspan="2">Class</td>
      <td width="40" rowspan="2">Gender</td>
      <td width="40" rowspan="2">Time</td>
      <td colspan="21">Answer</td>
    </tr>
    <tr class="menutitle"> 
      <td width="8">1</td>
      <td width="8">2a</td>
      <td width="100">2b</td>
      <td width="8">3a</td>
      <td width="100">3b</td>
      <td width="8">4a</td>
      <td width="100">4b</td>
      <td width="8">5</td>
      <td width="8">6</td>
      <td width="100">7</td>
      <td width="8">8</td>
      <td width="8">9</td>
      <td width="8">10</td>
      <td width="8">11</td>
      <td width="8">12</td>
      <td width="8">13a</td>
      <td width="100">13b</td>
      <td width="8">14</td>
      <td width="8">15</td>
      <td width="8">16</td>
      <td width="8">17</td>
    </tr>
    <?php
	$bgcolor = "#FFFFDD";
	$count = true;
	while($db->next_record()){
		$answerstr="";
		$bgcolor = ($count?"#FFFFFF":"#FFFFDD");
?>
    <tr align="center" bgcolor="<?= $bgcolor?>"> 
      <td> 
        <?=$db->Record['studentname']?>
      </td>
      <td> 
        <?=$db->Record['teachername']?>
      </td>
      <td> 
        <?=$db->Record['classname']?>
      </td>
      <td>
        <?=$gender[$db->Record['gender']]?>
      </td>
      <td> <div align="center"> 
          <?=$db->Record['takingtime']?>
        </div></td>
      <td> <div align="center"> 
          <?php
		  echo($answer[$db->Record['Q1']]);
		  ?>
        </div></td>
      <td> 
        <?php
		  echo($answer[$db->Record['Q2a']]);
		  ?>
      </td>
      <td> 
        <?php
		  echo($db->Record['Q2b']);
		  ?>
      </td>
      <td> 
        <?php
		  echo($answer[$db->Record['Q3a']]);
		  ?>
      </td>
      <td> 
        <?php
		  echo($db->Record['Q3b']);
		  ?>
      </td>
      <td> 
        <?php
		  echo($answer[$db->Record['Q4a']]);
		  ?>
      </td>
      <td> 
        <?php
		  echo($db->Record['Q4b']);
		  ?>
      </td>
      <td> 
        <?php
		  echo($answer[$db->Record['Q5']]);
		  ?>
      </td>
      <td> 
        <?php
		  echo($answer[$db->Record['Q6']]);
		  ?>
      </td>
      <td> 
        <?php
		  echo($db->Record['Q7']);
		  ?>
      </td>
      <td> 
        <?php
		  echo($answer[$db->Record['Q8']]);
		  ?>
      </td>
      <td> 
        <?php
		  echo($answer[$db->Record['Q9']]);
		  ?>
      </td>
      <td> 
        <?php
		  echo($answer[$db->Record['Q10']]);
		  ?>
      </td>
      <td> 
        <?php
		  echo($answer[$db->Record['Q11']]);
		  ?>
      </td>
      <td> 
        <?php
		  echo($answer[$db->Record['Q12']]);
		  ?>
      </td>
      <td> 
        <?php
		  echo($answer[$db->Record['Q13a']]);
		  ?>
      </td>
      <td> 
        <?php
		  echo($db->Record['Q13b']);
		  ?>
      </td>
      <td> 
        <?php
		  echo($answer[$db->Record['Q14']]);
		  ?>
      </td>
      <td> 
        <?php
		  echo($answer[$db->Record['Q15']]);
		  ?>
      </td>
      <td> 
        <?php
		  echo($answer[$db->Record['Q16']]);
		  ?>
      </td>
      <td> 
        <?php
		  echo($answer[$db->Record['Q17']]);
		  ?>
      </td>
    </tr>
    <?php
	$count = !$count;
	}
?>
  </table>
  <p>&nbsp;</p>
  <p class="tabletitle">Binary marks for Pretest Multiple-choice Answer</p>
  <center>
    <table border="1" cellspacing="0" cellpadding="0">
      <tr class="menutitle"> 
        <td width="40" rowspan="2">Student</td>
        <td width="40" rowspan="2">Teacher</td>
        <td width="40" rowspan="2">Class</td>
        <td width="40" rowspan="2">Gender</td>
        <td width="40" rowspan="2">Time</td>
        <td colspan="16">Answer</td>
      </tr>
      <tr class="menutitle"> 
        <td width="8">1</td>
        <td width="8">2a</td>
        <td width="8">3a</td>
        <td width="8">4a</td>
        <td width="8">5</td>
        <td width="8">6</td>
        <td width="8">8</td>
        <td width="8">9</td>
        <td width="8">10</td>
        <td width="8">11</td>
        <td width="8">12</td>
        <td width="8">13a</td>
        <td width="8">14</td>
        <td width="8">15</td>
        <td width="8">16</td>
        <td width="8">17</td>
      </tr>
      <?php
	$bgcolor = "#FFFFDD";
	$count = true;
	$db->seek(0);
	while($db->next_record()){
		$answerstr="";
		$bgcolor = ($count?"#FFFFFF":"#FFFFDD");
?>
      <tr align="center" bgcolor="<?= $bgcolor?>"> 
        <td> 
          <?=$db->Record['studentname']?>
        </td>
        <td> 
          <?=$db->Record['teachername']?>
        </td>
        <td> 
          <?=$db->Record['classname']?>
        </td>
        <td>
          <?=$gender[$db->Record['gender']]?>
        </td>
        <td> <div align="center"> 
            <?=$db->Record['takingtime']?>
          </div></td>
        <td> <div align="center"> 
            <?php
		  if($db->Record['Q1'] == $keys['Q1'])
		  		$answerstr="1";
			else
		  		$answerstr="0";
		  echo($answerstr);
		  ?>
          </div></td>
        <td> 
          <?php
		  if($db->Record['Q2a'] == $keys['Q2a'])
		  		$answerstr="1";
			else
		  		$answerstr="0";
		  echo($answerstr);
		  ?>
        </td>
        <td> 
          <?php
		  if($db->Record['Q3a'] == $keys['Q3a'])
		  		$answerstr="1";
			else
		  		$answerstr="0";
		  echo($answerstr);
		  ?>
        </td>
        <td> 
          <?php
		  if($db->Record['Q4a'] == $keys['Q4a'])
		  		$answerstr="1";
			else
		  		$answerstr="0";
		  echo($answerstr);
		  ?>
        </td>
        <td> 
          <?php
		  if($db->Record['Q5'] == $keys['Q5'])
		  		$answerstr="1";
			else
		  		$answerstr="0";
		  echo($answerstr);
		  ?>
        </td>
        <td> 
          <?php
		  if($db->Record['Q6'] == $keys['Q6'])
		  		$answerstr="1";
			else
		  		$answerstr="0";
		  echo($answerstr);
		  ?>
        </td>
        <td> 
          <?php
		  if($db->Record['Q8'] == $keys['Q8'])
		  		$answerstr="1";
			else
		  		$answerstr="0";
		  echo($answerstr);
		  ?>
        </td>
        <td> 
          <?php
		  if($db->Record['Q9'] == $keys['Q9'])
		  		$answerstr="1";
			else
		  		$answerstr="0";
		  echo($answerstr);
		  ?>
        </td>
        <td> 
          <?php
		  if($db->Record['Q10'] == $keys['Q10'])
		  		$answerstr="1";
			else
		  		$answerstr="0";
		  echo($answerstr);
		  ?>
        </td>
        <td> 
          <?php
		  if($db->Record['Q11'] == $keys['Q11'])
		  		$answerstr="1";
			else
		  		$answerstr="0";
		  echo($answerstr);
		  ?>
        </td>
        <td> 
          <?php
		  if($db->Record['Q12'] == $keys['Q12'])
		  		$answerstr="1";
			else
		  		$answerstr="0";
		  echo($answerstr);
		  ?>
        </td>
        <td> 
          <?php
		  if($db->Record['Q13a'] == $keys['Q13a'])
		  		$answerstr="1";
			else
		  		$answerstr="0";
		  echo($answerstr);
		  ?>
        </td>
        <td> 
          <?php
		  if($db->Record['Q14'] == $keys['Q14'])
		  		$answerstr="1";
			else
		  		$answerstr="0";
		  echo($answerstr);
		  ?>
        </td>
        <td> 
          <?php
		  if($db->Record['Q15'] == $keys['Q15'])
		  		$answerstr="1";
			else
		  		$answerstr="0";
		  echo($answerstr);
		  ?>
        </td>
        <td> 
          <?php
		  if($db->Record['Q16'] == $keys['Q16'])
		  		$answerstr="1";
			else
		  		$answerstr="0";
		  echo($answerstr);
		  ?>
        </td>
        <td> 
          <?php
		  if($db->Record['Q17'] == $keys['Q17'])
		  		$answerstr="1";
			else
		  		$answerstr="0";
		  echo($answerstr);
		  ?>
        </td>
      </tr>
      <?php
	$count = !$count;
	}
?>
    </table>
    <p>&nbsp;</p><p class="tabletitle">READING SURVEY </p>
    <table border="1" cellspacing="0" cellpadding="0">
      <tr class="menutitle"> 
        <td width="40" rowspan="2">Student</td>
        <td width="40" rowspan="2">Teacher</td>
        <td width="40" rowspan="2">Class</td>
        <td width="40" rowspan="2">Gender</td>
        <td width="40" rowspan="2">Time</td>
        <td colspan="50">Answer</td>
      </tr>
      <tr class="menutitle"> 
<?php
	for($count=1;$count<=50;$count++){
?>
        <td width="8"><?= $count?></td>
<?php
	}
?>
      </tr>
      <?php
	$bgcolor = "#FFFFDD";
	$count = true;
	$sql="select * from SURVEY_ANSWER order by teachername,classname,studentname";
	$query = $db->query($sql);
	while($db->next_record()){
		$answerstr=$db->Record['answer'];
		$bgcolor = ($count?"#FFFFFF":"#FFFFDD");
?>
      <tr align="center" bgcolor="<?= $bgcolor?>"> 
        <td> 
          <?=$db->Record['studentname']?>
        </td>
        <td> 
          <?=$db->Record['teachername']?>
        </td>
        <td> 
          <?=$db->Record['classname']?>
        </td>
        <td> 
          <?=$gender[$db->Record['gender']]?>
        </td>
        <td> <div align="center"> 
            <?=$db->Record['takingtime']?>
          </div></td>
<?php
for($count=0;$count<50;$count++){
?>
        <td> <div align="center"> 
            <?php
		  echo(substr($answerstr,$count,1));
		  ?>
          </div></td>
<?php
}
?> 
      </tr>
      <?php
	$count = !$count;
	}
?>
    </table>
    <p>&nbsp;</p>
  </center>
</center>
</body>
</html>
