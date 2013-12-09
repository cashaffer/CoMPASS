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

$idteacher = (isset($_REQUEST['idteacher'])==null?0:$_REQUEST['idteacher']);
$idclass = (isset($_REQUEST['idclass'])==null?0:$_REQUEST['idclass']);
$idgroup = (isset($_REQUEST['idgroup'])==null?0:$_REQUEST['idgroup']);
$idstudent = (isset($_REQUEST['idstudent'])==null?0:$_REQUEST['idstudent']);
$fromtime = (isset($_REQUEST['fromtime'])==null?"":$_REQUEST['fromtime']);
$totime = (isset($_REQUEST['totime'])==null?"":$_REQUEST['totime']);
$idtopic = (isset($_REQUEST['idtopic'])==null?0:$_REQUEST['idtopic']);
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
function teacherChanged()
{ 
	idteacher=document.form1.idteacher.value;
//	idclass=document.form1.idclass.value;
//	idgroup=document.form1.idgroup.value;
//	idstudent=document.form1.idstudent.value;
	fromtime=document.form1.fromtime.value;
	totime=document.form1.totime.value;
	idtopic=document.form1.idtopic.value;
	self.location="query.php?idteacher="+idteacher+"&fromtime="+fromtime+"&totime="+totime+"&idtopic="+idtopic;
}
function classChanged()
{ 
	idteacher=document.form1.idteacher.value;
	idclass=document.form1.idclass.value;
//	idgroup=document.form1.idgroup.value;
//	idstudent=document.form1.idstudent.value;
	fromtime=document.form1.fromtime.value;
	totime=document.form1.totime.value;
	idtopic=document.form1.idtopic.value;
	self.location="query.php?idteacher="+idteacher+"&idclass="+idclass+"&fromtime="+fromtime+"&totime="+totime+"&idtopic="+idtopic;
}
function check(){
	str=document.form2.searchname.value;
	rtn = true;
	if(str == ""){
		alert("Please input name first!");
		form2.searchname.focus();
		rtn=false;
	}
	else if(str.length<=2){
		alert("String you input is too short!");
		form2.searchname.focus();
		rtn=false;
	}
	else
		rtn = true;
	return rtn;
}
</script>
</head>
<link rel="stylesheet" href="../../css/compass.css" type="text/css" media=screen>
<body>
<center>
  <table border=0 cellpadding=0 cellspacing=10 width="700">
    <tr> 
      <td> <table border=0 cellpadding=5 width="100%">
          <tr> 
            <td valign=top> <p class="tabletitle"> Please make sure to fill in 
                the following fields to complete the statistic work. Thank you. 
              <P> 
              <form name="form1" action="queryresult.php" method="POST">
                <TABLE WIDTH="100%" BORDER="1" CELLPADDING="4">
                  <tr> 
                    <td ALIGN=RIGHT>Topic:</td>
                    <td><select name="idtopic">
                        <option value="0">All topics</option>
                        <?php
 	$sql = "select name tname, idtopic tid from TOPIC order by name";
			$db->query($sql);
			while ($db->next_record()){
				$tid = $db->Record['tid'];
				$tname = $db->Record['tname'];
				$select = "";
				if($tid==$idtopic)
					$select = "selected";
		?>
                        <option value="<?= $tid?>" <?=$select?>> 
                        <?= htmlentities($tname)?>
                        </option>
                        <?php
			}
		?>
                      </select></td>
                  </tr>
                  <TR> 
                    <TD Align=RIGHT>Teacher:</TD>
                    <TD><select name="idteacher" onChange="teacherChanged();">
                        <option value="0">All teachers</option>
                        <?php

 $sql = "select distinct(USER.loginname) teachername,USER.iduser idt from USER,CLASS where USER.usertype=2 and USER.iduser=CLASS.idteacher order by loginname";
			$db->query($sql);
			while ($db->next_record()){
				$idt = $db->Record['idt'];
				$teachername = $db->Record['teachername'];
				$select = "";
				if($idt==$idteacher)
					$select = "selected";
		?>
                        <option value="<?= $idt?>" <?=$select?>> 
                        <?= htmlentities($teachername)?>
                        </option>
                        <?php
			}
		?>
                      </select></td>
                  </tr>
                  <?php
 if($idteacher !=0){
?>
                  <TR> 
                    <TD Align=RIGHT>Class:</TD>
                    <TD><select name="idclass" onChange="classChanged();">
                        <option value="0">All classes</option>
                        <?php
 	$sql = "select u.loginname teachername, c.name classname,c.idclass idc from CLASS c,USER u where c.idteacher=u.iduser and c.idteacher=".$idteacher." order by name";
			$db->query($sql);
			while ($db->next_record()){
				$idc = $db->Record['idc'];
				$classname = $db->Record['classname'];
				$select = "";
				if($idc==$idclass)
					$select = "selected";
		?>
                        <option value="<?= $idc?>" <?=$select?>> 
                        <?= htmlentities($classname."(".$db->Record['teachername'].")")?>
                        </option>
                        <?php
			}
		?>
                      </select></td>
                  </tr>
                  <?php
 }
 if($idclass !=0){
 ?>
                  <tr> 
                    <TD Align=RIGHT>Group:</TD>
                    <TD><select name="idstudent">
                        <option value="0">All groups</option>
                        <?php
 	$sql = "select u.loginname studentname, u.iduser ids from TAKESCLASS tc, USER u where tc.idstudent=u.iduser and tc.idclass=".$idclass." order by u.loginname";
			$db->query($sql);
			while ($db->next_record()){
				$ids = $db->Record['ids'];
				$studentname = $db->Record['studentname'];
				$select = "";
				if($ids==$idstudent)
					$select = "selected";
		?>
                        <option value="<?= $ids?>" <?=$select?>> 
                        <?= htmlentities($studentname)?>
                        </option>
                        <?php
			}
		?>
                      </select>
                      &nbsp; &nbsp; &nbsp; 
                      <input type="checkbox" name="bysession" value="1">
                      By Session</td>
                  </tr>
                  <?php
}
?>
                  <tr>
                    <td ALIGN=RIGHT>Place:</td>
                    <td><select name="place">
                        <option value="1">School-During Science Class</option>
                        <option value="2">School-Outside Science Class</option>
                        <option value="3">Home</option>
                        <option value="4">Other</option>
                      </select></td>
                  </tr>
                  <tr> 
                    <td ALIGN=RIGHT>From Date:</td>
                    <td> <input name="fromtime" type="text" value="<?=$fromtime?>" size="8">
                      (YYYYMMDD)</td>
                  </tr>
                  <tr> 
                    <td ALIGN=RIGHT> To Date: </td>
                    <td> <input name="totime" type="text" value="<?=$totime?>" size="8">
                      (YYYYMMDD) </td>
                  </tr>
                </table>
                <center>
                  <input type="submit" name="send" value="    Submit    ">
                </center>
              </form></td>
          </tr>
        </table></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  </center>
</body>
</html>
