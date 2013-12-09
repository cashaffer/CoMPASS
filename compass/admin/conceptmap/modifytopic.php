<?php
session_start();
if ($_SESSION['loginname'] == null)
	header("location:/compass/error_code.php?code=001"); 
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(8))
		header("location:/compass/error_code.php?code=004"); 
	else{		
		include "db_mysql_mt.inc"; 
			
		$db = new DB_Sql;		
		$db->connect();
		$db1 = new DB_Sql;		
		$db1->connect();
		$sql = "select * from unit order by name";
		$query1 = $db1->query($sql);		
		$id = $_REQUEST['id'];
		$sql = "select topic.idtopic tid,topic.name tname, topic.idunit uid,topic.description descp from topic,unit where unit.idunit=topic.idunit and topic.idtopic=".$id;
		$query = $db->query($sql);
		if($db->next_record()){	

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
function check(){
	str=document.form1.general_title.value;
	desc=document.form1.educational_description.value;
	rtn = true;
	if(str == ""){
		alert("Please input Concept Name first!");
		form1.general_title.focus();
		rtn=false;
	}
	else if(desc == ""){
		alert("Please input Educational Description!");
		form1.educational_description.focus();
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
  <p>&nbsp; </p>
  <p><span class="tabletitle">Modify Topic</span> </p>
  <form name="form1" method="post" action="savetopicinfo.php"  onSubmit="return check()">
    <table width="75%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td width="33%"><div align="right">Topic Name <font color="#FF0000">*</font>:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="63%"><input name="topicname" type="text" value="<?= ($db->Record['tname']==null)?"":htmlentities($db->Record['tname'])?>" size="50" maxlength="250"> 
        </td>
      </tr>
      <tr> 
        <td><div align="right">Unit <font color="#FF0000">*</font></div></td>
        <td>&nbsp;</td>
        <td><select name="idunit">
            <?php
            
	while($db1->next_record()){
            $select = "";
		if($db1->Record['idunit']==$db->Record['uid'])
			$select = "selected";
?>
            <option value="<?= $db1->Record['idunit']?>" <?= $select?>> 
            <?= htmlentities($db1->Record['name'])?>
            </option>
            <?php
	}
?>
          </select></td>
      </tr>
      <tr> 
        <td><div align="right"> Description <font color="#FF0000">*</font></div></td>
        <td>&nbsp;</td>
        <td><textarea name="description" cols="50" rows="6"><?= ($db->Record['descp']==null)?"":htmlentities($db->Record['descp'])?></textarea> 
        </td>
      </tr>
    </table>
    <input type="hidden" name="id" value="<?=$id?>">
    <p>
    <input type="submit" name="Submit" value="Submit">
  </form>
  </p>
</center>
</body>
</html>
<?php }
  }
}
?>