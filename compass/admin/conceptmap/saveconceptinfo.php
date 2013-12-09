<?php
session_start();

if ($_SESSION['loginname'] == null)
//	header("location:/compass/error_code.php?code=001"); 
	echo $_SESSION['loginname'];
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(8))
		header("location:/compass/error_code.php?code=004"); 
	else{		
		include "db_mysql_mt.inc"; 
			
		$db = new DB_Sql;
		
		$db->connect();
		$sql = "update CONCEPT set";
		$general_title = $_REQUEST['general_title'];
		$sql = $sql. " general_title='".($general_title)."'";
		$educational_description = $_REQUEST['educational_description'];
		if($educational_description != null)
			$sql = $sql. ",educational_description='".($educational_description)."'";
		$general_identifier = $_REQUEST['general_identifier'];
		if($general_identifier != null)
			$sql = $sql. ",general_identifier='".($general_identifier)."'";
		$general_catalog = $_REQUEST['general_catalog'];
		if($general_catalog != null)
			$sql = $sql. ",general_catalog='".($general_catalog)."'";
		$general_entry = $_REQUEST['general_entry'];
		if($general_entry != null)
			$sql = $sql. ",general_entry='".($general_entry)."'";
		$general_language = $_REQUEST['general_language'];
		if($general_language != null)
			$sql = $sql. ",general_language='".($general_language)."'";
		$general_description = $_REQUEST['general_description'];
		if($general_description != null)
			$sql = $sql. ",general_description='".($general_description)."'";
		$general_keyword = $_REQUEST['general_keyword'];
		if($general_keyword != null)
			$sql = $sql. ",general_keyword='".($general_keyword)."'";
		$general_coverage = $_REQUEST['general_coverage'];
		if($general_coverage != null)
			$sql = $sql. ",general_coverage='".($general_coverage)."'";
		$general_status = $_REQUEST['general_status'];
		if($general_status != null)
			$sql = $sql. ",general_status='".($general_status)."'";
		$general_contribute_role= $_REQUEST['general_contribute_role'];
		if($general_contribute_role != null)
			$sql = $sql. ",general_contribute_role='".($general_contribute_role)."'";
		$general_contribute_date = $_REQUEST['general_contribute_date'];
		$technical_format = $_REQUEST['technical_format'];
		if($technical_format != null)
			$sql = $sql. ",technical_format='".($technical_format)."'";
		$technical_size = $_REQUEST['technical_size'];
		if($technical_size != null)
			$sql = $sql. ",technical_size='".($technical_size)."'";
		$technical_location = $_REQUEST['technical_location'];
		if($technical_location != null)
			$sql = $sql. ",technical_location='".($technical_location)."'";
		$technical_duration = $_REQUEST['technical_duration'];
		if($technical_duration != null)
			$sql = $sql. ",technical_duration='".($technical_duration)."'";
		$educational_interactivitytype = $_REQUEST['educational_interactivitytype'];
		if($educational_interactivitytype != null)
			$sql = $sql. ",educational_interactivitytype='".($educational_interactivitytype)."'";
		$educational_learningresourceType = $_REQUEST['educational_learningresourceType'];
		if($educational_learningresourceType != null)
			$sql = $sql. ",educational_learningresourceType='".($educational_learningresourceType)."'";
		$educational_interactivitylevel = $_REQUEST['educational_interactivitylevel'];
		if($educational_interactivitylevel != null)
			$sql = $sql. ",educational_interactivitylevel='".($educational_interactivitylevel)."'";
		$educational_semanticdensity = $_REQUEST['educational_semanticdensity'];
		if($educational_semanticdensity != null)
			$sql = $sql. ",educational_semanticdensity='".($educational_semanticdensity)."'";
		$educational_intendedenduserrole = $_REQUEST['educational_intendedenduserrole'];
		if($educational_intendedenduserrole != null)
			$sql = $sql. ",educational_intendedenduserrole='".($educational_intendedenduserrole)."'";
		$educational_context = $_REQUEST['educational_context'];
		if($educational_context != null)
			$sql = $sql. ",educational_context='".($educational_context)."'";
		$educational_difficulty = $_REQUEST['educational_difficulty'];
		if($educational_difficulty != null)
			$sql = $sql. ",educational_difficulty='".($educational_difficulty)."'";
		$educational_typicallearningtime = $_REQUEST['educational_typicallearningtime'];
		if($educational_typicallearningtime != null)
			$sql = $sql. ",educational_typicallearningtime='".($educational_typicallearningtime)."'";
		$educational_language = $_REQUEST['educational_language'];
		if($educational_language != null)
			$sql = $sql. ",educational_language='".($educational_language)."'";
		$rights_cost = $_REQUEST['rights_cost'];
		if($rights_cost != null)
			$sql = $sql. ",rights_cost='".($rights_cost)."'";
		$rights_copyrightandotherrestrictions = $_REQUEST['rights_copyrightandotherrestrictions'];
		if($rights_copyrightandotherrestrictions != null)
			$sql = $sql. ",rights_copyrightandotherrestrictions='".($rights_copyrightandotherrestrictions)."'";
		$rights_description = $_REQUEST['rights_description'];
		if($rights_description != null)
			$sql = $sql. ",rights_description='".($rights_description)."'";
		$annotation_entity = $_REQUEST['annotation_entity'];
		if($annotation_entity != null)
			$sql = $sql. ",annotation_entity='".($annotation_entity)."'";
		$annotation_description = $_REQUEST['annotation_description'];
		if($annotation_description != null)
			$sql = $sql. ",annotation_description='".($annotation_description)."'";

		$educational_typicalagemin = $_REQUEST['educational_typicalagemin'];
		if($annotation_description != null)
			$sql = $sql. ",educational_typicalagemin=".$educational_typicalagemin;
		$educational_typicalagemax = $_REQUEST['educational_typicalagemax'];
		if($educational_typicalagemax != null)
			$sql = $sql. ",educational_typicalagemax=".$educational_typicalagemax;
		
		$general_contribute_date = $_REQUEST['general_contribute_date'];
		if($general_contribute_date != null)
			$sql = $sql. ",general_contribute_date='".$general_contribute_date."'";
		$annotation_date = $_REQUEST['annotation_date'];
		if($annotation_date != null)
			$sql = $sql. ",annotation_date='".$annotation_date."'";
			
		$id = $_REQUEST['id'];
		$sql = $sql. " where idconcept=".$id;
		$query = $db->query($sql);
?>
<html>
<head>
<link rel="stylesheet"  href="../../css/compass.css" type="text/css" media=screen>
</head>

<body marginheight=0 marginwidth=0 topmargin=0 leftmargin=0>
<br>
<br>
<br>
<table width=528 cellspacing=1 cellpadding=4 border=0 align=center class=bgcolor5>
	<tr class=bgcolor2>
	<td align=center nowrap class=f14w> <b>[ Concept Info ]</b>&nbsp; </td>
	</tr>
	<tr>
	<td colspan=2 height=150 align=center class=bgcolor1> <p> 
        <?= "Concept ".$general_title." info is updated successfully!<br> Click <a href='conceptlist.php'>here</a> to continue"?>
        <br>
      </p>
	</td>
	</tr>
	<tr>
	<td align=center colspan=2 class=bgcolor3>&nbsp; </td>
	</tr>
</table>

</body>
</html>
<? 
	}
}
?>