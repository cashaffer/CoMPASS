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
			
		$id = $_REQUEST['id'];
		$db = new DB_Sql;		
		$db->connect();
		$sql="select idconcept from EXAMPLE_HAS_CONCEPT where idexample=".$id;
		$db->query($sql);
		$i=0;
		$cids=array();
		while($db->next_record()){
			$cids[$i]=$db->Record['idconcept'];
			$i++;
		}
		$sql = "select name, description from EXAMPLE where idexample=".$id;
		$db->query($sql);
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
function orderby(column){
	MM_goToURL('self','userlist.php?type=<?= $type?>&orderby='+column);
	return document.MM_returnValue;
}
function check(){
	str=document.form1.examplename.value;
	desc=document.form1.description.value;
	rtn = true;
	if(str == ""){
		alert("Please input Example Name first!");
		form1.unitname.focus();
		rtn=false;
	}
	else if(desc == ""){
		alert("Please input Description!");
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
<p>&nbsp;</p>
  <p><span class="tabletitle">Modify Example</span> </p>
  <form name="form1" method="post" action="saveexampleinfo.php"  onSubmit="return check()">
    <table width="75%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td width="33%"><div align="right">Example Name <font color="#FF0000">*</font>:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="63%"><input name="examplename" type="text" value="<?= ($db->Record['name']==null)?"":htmlentities($db->Record['name'])?>" size="50" maxlength="250"> 
        </td>
      </tr>
      <tr> 
        <td height="164"> 
          <div align="right">Description:</div></td>
        <td>&nbsp;</td>
        <td><textarea name="description" cols="80" rows="15"><?= ($db->Record['description']==null)?"":htmlentities($db->Record['description'])?></textarea> </td>
      </tr>
    </table>
    <table width="75%" border="0" cellpadding="0" cellspacing="0">
      <tr> 
        <td width="33%" valign="top">
<div align="right">Related Concepts:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="63%"><select name="concepts[]" size="10" multiple="multiple">
<?php
		$sql = "select idconcept cid, general_title cname from CONCEPT order by cname";
		$db->query($sql);
	while($db->next_record()){
		$selected="";		
		if(in_array ($db->Record['cid'],$cids))
			$selected="selected";
			
?>
            <option value="<?=$db->Record['cid']?>" <?=$selected?>><?=htmlentities($db->Record['cname'])?></option>
<?php
	}
?>
          </select> </td>
      </tr>
    </table>
    <p>
      <input type="hidden" name="id" value="<?=$id?>">
      <input type="submit" name="Submit" value="Submit">
  </form>
  </p>
</center>
</body>
</html>
<?php
	}
	else
		header("location:/compass/error_code.php?code=006"); 		
  }
}
?>