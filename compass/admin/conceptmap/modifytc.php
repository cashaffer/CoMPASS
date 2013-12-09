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
			
		$db1 = new DB_Sql;
		$db1->connect();
		$sql = "select t.idtopic tid,t.name tname,u.name uname from TOPIC t,UNIT u where t.idunit=u.idunit order by u.name,t.name";
		$db1->query($sql);
		$db = new DB_Sql;		
		$db->connect();
		$cid = $_REQUEST['cid'];
		$tid = $_REQUEST['tid'];
		$sql = "select c.general_title cname, tc.description descp from CONCEPTINTOPIC tc,CONCEPT c where tc.idconcept=c.idconcept and tc.idconcept=".$cid." and tc.idtopic=".$tid;
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
	desc=document.form1.description.value;
	rtn = true;
	if(desc == ""){
		alert("Please input Educational Description!");
		form1.description.focus();
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
	<p><span class="tabletitle">Modify Topic_Concept</span>	&nbsp;&nbsp;&nbsp;&nbsp; (Tip: <a target=_blank href="MozillaRichText.htm">HTML editor for Mozilla</a>)
	</p>
  <form name="form1" method="post" action="savetcinfo.php"  onSubmit="return check()">
    <table width="75%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td width="33%" height="37"> 
          <div align="right">Concept Name:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="63%"><font color="#FF0000"><?= htmlentities($db->Record['cname'])?></font> </td>
      </tr>
      <tr> 
        <td><div align="right">Topic <font color="#FF0000">*</font></div></td>
        <td>&nbsp;</td>
        <td><select name="idtopic">
            <?php
	while($db1->next_record()){
		$select = "";
		if($db1->Record['tid']==$tid)
			$select = "selected";
?>
            <option value="<?= $db1->Record['tid']?>" <?=$select?>> 
            <?= htmlentities($db1->Record['uname'])?>
            =&gt; 
            <?= htmlentities($db1->Record['tname'])?>
            </option>
            <?php
	}
?>
          </select></td>
      </tr>
      <tr> 
        <td><div align="right"> Description <font color="#FF0000">*</font></div></td>
        <td>&nbsp;</td>
        <td><textarea name="description" cols="86" rows="30"><?= ($db->Record['descp']==null)?"":htmlentities($db->Record['descp'])?></textarea> 
        </td>
      </tr>
    </table>
    <input type="hidden" name="idconcept" value="<?=$cid?>">
    <input type="hidden" name="formeridtopic" value="<?=$tid?>">
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
