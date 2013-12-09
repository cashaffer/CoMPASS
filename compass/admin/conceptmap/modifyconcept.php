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
		$id = $_REQUEST['id'];
		$sql = "select * from CONCEPT where idconcept=".$id;
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
  <p><span class="tabletitle">Modify Concept </span> </p>
  <form name="form1" method="post" action="saveconceptinfo.php"  onSubmit="return check()">
    <table width="75%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td width="33%"><div align="right">Concept Name <font color="#FF0000">*</font>:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="63%"><input name="general_title" type="text" value="<?= ($db->Record['general_title']==null)?"":htmlentities($db->Record['general_title'])?>" size="50" maxlength="250"> 
        </td>
      </tr>
      <tr> 
        <td><div align="right">General Identifier:</div></td>
        <td>&nbsp;</td>
        <td><input name="general_identifier" type="text" value="<?= ($db->Record['general_identifier']==null)?"":htmlentities($db->Record['general_identifier'])?>" size="50" maxlength="250"> 
        </td>
      </tr>
      <tr> 
        <td width="33%"><div align="right">General Catalog:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="63%"><input name="general_catalog" value="<?= ($db->Record['general_catalog']==null)?"":htmlentities($db->Record['general_catalog'])?>" type="text" size="20" maxlength="24"></td>
      </tr>
      <tr> 
        <td><div align="right">General Entry:</div></td>
        <td>&nbsp;</td>
        <td><input name="general_entry" type="text" value="<?= ($db->Record['general_entry']==null)?"":htmlentities($db->Record['general_entry'])?>" size="20" maxlength="45"></td>
      </tr>
      <tr> 
        <td width="33%"><div align="right">Language:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="63%"><input name="general_language" type="text" value="<?= ($db->Record['general_language']==null)?"":htmlentities($db->Record['general_language'])?>" size="20" maxlength="20"></td>
      </tr>
      <tr> 
        <td width="33%" height="22"> <div align="right">General Description::</div></td>
        <td width="4%">&nbsp;</td>
        <td width="63%"><textarea name="general_description" cols="40"><?= ($db->Record['general_description']==null)?"":htmlentities($db->Record['general_description'])?></textarea></td>
      </tr>
      <tr> 
        <td width="33%"><div align="right">Keyword:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="63%"><input name="general_keyword" value="<?= ($db->Record['general_keyword']==null)?"":htmlentities($db->Record['general_keyword'])?>" type="text" size="50" maxlength="250"></td>
      </tr>
      <tr> 
        <td><div align="right">General Coverage:</div></td>
        <td>&nbsp;</td>
        <td><input name="general_coverage" value="<?= ($db->Record['general_coverage']==null)?"":htmlentities($db->Record['general_coverage'])?>" type="text" size="50" maxlength="250"></td>
      </tr>
      <tr> 
        <td><div align="right">General Contribute Role:</div></td>
        <td>&nbsp;</td>
        <td><input name="general_contribute_role" value="<?= ($db->Record['general_contribute_role']==null)?"":htmlentities($db->Record['general_contribute_role'])?>" type="text" size="50" maxlength="250"></td>
      </tr>
      <tr> 
        <td><div align="right">General Contribute Date:</div></td>
        <td>&nbsp;</td>
        <td><input name="general_contribute_date" value="<?= ($db->Record['general_contribute_date']==null)?"":htmlentities($db->Record['general_contribute_date'])?>" type="text" size="10" maxlength="10">
          (yyyymmdd or yyyy-mm-dd or yyyy/mm/dd) </td>
      </tr>
      <tr> 
        <td><div align="right">Technical Format:</div></td>
        <td>&nbsp;</td>
        <td><input name="technical_format" type="text"  value="<?= ($db->Record['technical_format']==null)?"":htmlentities($db->Record['technical_format'])?>" size="20" maxlength="20"></td>
      </tr>
      <tr> 
        <td><div align="right">Technical Size:</div></td>
        <td>&nbsp;</td>
        <td><input name="technical_size" value="<?= ($db->Record['technical_size']==null)?"":htmlentities($db->Record['technical_size'])?>" type="text" size="20" maxlength="20"></td>
      </tr>
      <tr> 
        <td><div align="right">Technical Location</div></td>
        <td>&nbsp;</td>
        <td><input name="technical_location" value="<?= ($db->Record['technical_location']==null)?"":htmlentities($db->Record['technical_location'])?>" type="text" size="50" maxlength="250"></td>
      </tr>
      <tr> 
        <td><div align="right">Technical Duration</div></td>
        <td>&nbsp;</td>
        <td><input name="technical_duration" value="<?= ($db->Record['technical_duration']==null)?"":htmlentities($db->Record['technical_duration'])?>" type="text" size="20" maxlength="20"></td>
      </tr>
      <tr> 
        <td><div align="right">Educational Interactivity Type</div></td>
        <td>&nbsp;</td>
        <td><input name="educational_interactivitytype" value="<?= ($db->Record['educational_interactivitytype']==null)?"":htmlentities($db->Record['educational_interactivitytype'])?>" type="text" size="20" maxlength="20"></td>
      </tr>
      <tr> 
        <td><div align="right">Educational Learning Resource Type</div></td>
        <td>&nbsp;</td>
        <td><input name="educational_learningresourceType" value="<?= ($db->Record['educational_learningresourceType']==null)?"":htmlentities($db->Record['educational_learningresourceType'])?>" type="text" size="50" maxlength="250"></td>
      </tr>
      <tr> 
        <td><div align="right">Educational Interactivity Level</div></td>
        <td>&nbsp;</td>
        <td><input name="educational_interactivitylevel" value="<?= ($db->Record['educational_interactivitylevel']==null)?"":htmlentities($db->Record['educational_interactivitylevel'])?>" type="text" size="50" maxlength="250"></td>
      </tr>
      <tr> 
        <td height="22"> <div align="right">Educational Semantic Density</div></td>
        <td>&nbsp;</td>
        <td><input name="educational_semanticdensity" value="<?= ($db->Record['educational_semanticdensity']==null)?"":htmlentities($db->Record['educational_semanticdensity'])?>" type="text" size="50" maxlength="250"></td>
      </tr>
      <tr> 
        <td><div align="right">Educational Intended End User Role</div></td>
        <td>&nbsp;</td>
        <td><input name="educational_intendedenduserrole" value="<?= ($db->Record['educational_intendedenduserrole']==null)?"":htmlentities($db->Record['educational_intendedenduserrole'])?>" type="text" size="50" maxlength="250"></td>
      </tr>
      <tr> 
        <td><div align="right">Educational Context</div></td>
        <td>&nbsp;</td>
        <td><input name="educational_context" value="<?= ($db->Record['educational_context']==null)?"":htmlentities($db->Record['educational_context'])?>" type="text" size="50" maxlength="250"></td>
      </tr>
      <tr> 
        <td><div align="right">Educational Typical Age Min</div></td>
        <td>&nbsp;</td>
        <td><input name="educational_typicalagemin" value="<?= ($db->Record['educational_typicalagemin']==null)?"":htmlentities($db->Record['educational_typicalagemin'])?>" type="text" size="2" maxlength="2"></td>
      </tr>
      <tr> 
        <td><div align="right">Educational Typical Age Max</div></td>
        <td>&nbsp;</td>
        <td><input name="educational_typicalagemax" value="<?= ($db->Record['educational_typicalagemax']==null)?"":htmlentities($db->Record['educational_typicalagemax'])?>" type="text" size="2" maxlength="2"></td>
      </tr>
      <tr> 
        <td height="22">
<div align="right">Educational Difficulty</div></td>
        <td>&nbsp;</td>
        <td><input name="educational_difficulty" value="<?= ($db->Record['educational_difficulty']==null)?"":htmlentities($db->Record['educational_difficulty'])?>" type="text" size="20" maxlength="20"></td>
      </tr>
      <tr> 
        <td><div align="right">Educational Typical Learning Time</div></td>
        <td>&nbsp;</td>
        <td><input name="educational_typicallearningtime" value="<?= ($db->Record['educational_typicallearningtime']==null)?"":htmlentities($db->Record['educational_typicallearningtime'])?>" type="text" size="20" maxlength="20"></td>
      </tr>
      <tr> 
        <td><div align="right">Educational Description <font color="#FF0000">*</font></div></td>
        <td>&nbsp;</td>
        <td><textarea name="educational_description" cols="50" rows="6"><?= ($db->Record['educational_description']==null)?"":htmlentities($db->Record['educational_description'])?></textarea> 
        </td>
      </tr>
      <tr> 
        <td><div align="right">Educational Language:</div></td>
        <td>&nbsp;</td>
        <td><input name="educational_language" type="text" value="<?= ($db->Record['educational_language']==null)?"":htmlentities($db->Record['educational_language'])?>" size="20" maxlength="20"></td>
      </tr>
      <tr> 
        <td><div align="right">Rights Cost:</div></td>
        <td>&nbsp;</td>
        <td><input name="rights_cost" value="<?= ($db->Record['rights_cost']==null)?"":htmlentities($db->Record['rights_cost'])?>" type="text"size="3" maxlength="3"></td>
      </tr>
      <tr> 
        <td><div align="right">Rights Copyright & Other Restrictions</div></td>
        <td>&nbsp;</td>
        <td><input name="rights_copyrightandotherrestrictions" type="text" value="<?= ($db->Record['rights_copyrightandotherrestrictions']==null)?"":htmlentities($db->Record['rights_copyrightandotherrestrictions'])?>" size="3" maxlength="3"></td>
      </tr>
      <tr> 
        <td><div align="right">Rights Description</div></td>
        <td>&nbsp;</td>
        <td><textarea name="rights_description" cols="40"><?= ($db->Record['rights_description']==null)?"":htmlentities($db->Record['rights_description'])?></textarea></td>
      </tr>
      <tr> 
        <td><div align="right">Annotation Date</div></td>
        <td>&nbsp;</td>
        <td><input name="annotation_date" type="text" value="<?= ($db->Record['annotation_date']==null)?"":htmlentities($db->Record['annotation_date'])?>" size="10" maxlength="10">
          (yyyymmdd or yyyy-mm-dd or yyyy/mm/dd) </td>
      </tr>
      <tr> 
        <td><div align="right">Annotation Entity</div></td>
        <td>&nbsp;</td>
        <td><input name="annotation_entity" value="<?= ($db->Record['annotation_entity']==null)?"":htmlentities($db->Record['annotation_entity'])?>" type="text" size="20" maxlength="45"></td>
      </tr>
      <tr> 
        <td><div align="right">Annotation Description</div></td>
        <td>&nbsp;</td>
        <td><textarea name="annotation_description" cols="40"><?= ($db->Record['annotation_description']==null)?"":htmlentities($db->Record['annotation_description'])?></textarea></td>
      </tr>
      <tr> 
        <td width="33%"><div align="right">Status:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="63%"><input type="text" name="general_status" value="<?= ($db->Record['general_status']==null)?"":htmlentities($db->Record['general_status'])?>"></td>
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