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
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script language="JavaScript" type="text/JavaScript">
function check(){
	str=document.form1.folderpath.value;
	rtn = true;
	if(str == ""){
		alert("Please input folder path name first!");
		form1.folderpath.focus();
		rtn=false;
	}
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
                the following fields to pack up log files. Thank you. 
              <P> 
              <form name="form1" action="exportlogfile_concept_only.php" method="POST" onSubmit="return check()">
                <TABLE WIDTH="100%" BORDER="1" CELLPADDING="4">
                  <tr> 
                    <td width="36%" ALIGN=RIGHT>Log Folder Path Name</td>
                    <td width="64%"><input type="text" name="folderpath"></td>
                  </tr>
                  <tr> 
                    <td ALIGN=RIGHT>From Date:</td>
                    <td> <input name="fromtime" type="text" size="8">
                      (YYYYMMDD)</td>
                  </tr>
                  <tr> 
                    <td ALIGN=RIGHT> To Date: </td>
                    <td> <input name="totime" type="text" size="8">
                      (YYYYMMDD) </td>
                  </tr>
                </table>
                <center>
                  <input type="checkbox" name="pf" value="1">
                  Export to Pathfinder Logs &nbsp;&nbsp;&nbsp;&nbsp; 
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
