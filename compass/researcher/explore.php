<?php
session_start();

if ($_SESSION['loginname'] == null)
	header("location:/compass/error_code.php?code=001"); 
//	echo $_SESSION['loginname'];
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(4))
		header("location:/compass/error_code.php?code=004"); 
	else{	
		include "config_mt.inc"; 
                $uid = null;
                $tid = null;	
		$cid = null;
		$suid = null;
                
		if(isset($_REQUEST['uid'])){
                $uid = $_REQUEST['uid'];}
                
                if(isset($_REQUEST['tid'])){
                $tid = $_REQUEST['tid'];}
                
                if(isset($_REQUEST['cid'])){
                $cid = $_REQUEST['cid'];}
                
                if(isset($_REQUEST['suid'])){
                $suid = $_REQUEST['suid'];}
                
		if($uid == null && $tid != null){
			include "db_mysql_mt.inc"; 		
			$db = new DB_Sql;
			$db->connect();
			$sql = "select idunit from TOPIC where idtopic=".$tid;
			$db->query($sql);
			if($db->next_record())
				$uid = $db->Record['idunit'];
		}
		if($uid == null)
			$uid="";
		if($tid == null)
			$tid="";
		if($cid == null)
			$cid="";
		if ($suid == null)
			$suid = "";
		
		$sub = "map.php?uid=".$uid."&suid=".$suid."&tid=".$tid."&cid=".$cid;
		$sub1 = "nav.php?uid=".$uid."&suid=".$suid."&tid=".$tid."&cid=".$cid;

//		$testing = false;
//		if ($_SESSION['loginname'] == 'testtest') {
//			$testing = true;
//		}
//		if ($testing) {
//			$sub1 = "nav2.php?uid=".$uid."&suid=".$suid."&tid=".$tid."&cid=".$cid;
//		}


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>CoMPASS</title>
<SCRIPT LANGUAGE="JavaScript">

function closewindow()
{ 
//	  window.location = "logout.php"
	//  if(basefrm.popup)
	//{
	// if(!basefrm.popup.closed)
	//    basefrm.popup.close();
	// }
	// window.location = "logout.asp"
}
function maximizeWin() { 
	if (window.screen)
	 { var aw = screen.availWidth; 
	   var ah = screen.availHeight; 
	   window.moveTo(0, 0);
	   window.resizeTo(aw, ah);
	 } 
} 
function dyniframesizeWidth(iframename) {
	return;
  var pTar = null;
  if (document.getElementById){
    pTar = document.getElementById(iframename);
  }
  else{
    eval('pTar = ' + iframename + ';');
  }
  if (pTar && !window.opera){
    //begin resizing iframe
    pTar.style.display="block"
    
    if (pTar.contentDocument && pTar.contentDocument.body.offsetWidth){
      //ns6 syntax
      pTar.width = pTar.contentDocument.body.offsetWidth; 
    }
    else if (pTar.Document && pTar.Document.body.scrollWidth){
      //ie5+ syntax
      pTar.width = pTar.Document.body.scrollWidth;
    }
  }
}

function dyniframesizeHeight(iframename) {
 var pTar = null;
  if (document.getElementById){
    pTar = document.getElementById(iframename);
  }
  else{
    eval('pTar = ' + iframename + ';');
  }
  if (pTar && !window.opera){
    //begin resizing iframe
    pTar.style.display="block"
    
    if (pTar.contentDocument && pTar.contentDocument.body.offsetHeight){
      //ns6 syntax
      pTar.height = pTar.contentDocument.body.offsetHeight; 
    }
    else if (pTar.Document && pTar.Document.body.scrollHeight){
      //ie5+ syntax
      pTar.height = pTar.Document.body.scrollHeight;
    }
  }
}

</script>
</head>
<body onLoad = "maximizeWin()">
<center>
  <table border="0" cellspacing="0" cellpadding="0" width="100%" height="100%">
    <tr>
<td colspan="3">
        <IFRAME id="nav" name="nav" onload="javascript:{dyniframesizeHeight('nav');dyniframesizeWidth('nav');}" src="wait.htm" hspace="0" vspace="0" marginwidth=0 marginheight=0 frameborder=0 width=100% height=100% scrolling=no></IFRAME>	
</td>
</tr>
<tr>
      <td width="450" height="100%" valign="top"> 
        <applet code="com.compass.conceptmap.CompassApplet.class"
			codebase="/compass/conceptmap/classes"
			width="450" height="430" style="" name="mapApplet">
			<param name="textField" value="label"/>
			<param name="urlPrefix" value="http://<?=$_SERVER['SERVER_NAME']?>/compass/researcher/"/>
			<param name="concepts" value="http://<?=$_SERVER['SERVER_NAME']?>/compass/xmls/concepts.xml"/>
			<param name="relations" value="http://<?=$_SERVER['SERVER_NAME']?>/compass/xmls/relation<?=$uid?>.xml"/>
			<param name="examples" value="http://<?=$_SERVER['SERVER_NAME']?>/compass/xmls/examples.xml"/>
<?php
	if($uid!=null){
?>
			<param name="focusUnit" value="<?=$uid?>"/>
<?php
}
	if($suid!=null){
?>
			<param name="focusSubUnit" value="<?=$suid?>"/>
<?php
}
	if($tid!=null){
?>
			<param name="focusTopic" value="<?=$tid?>"/>
<?php
}
	if($cid!=null){
?>
			<param name="focusConcept" value="<?=$cid?>"/>
<?php
}
?>
			If you can read this text, the applet is not working. Perhaps you don't
			have the Java web plug-in installed, you can get it from <a href="http://java.com/en/download/index.jsp">here</a>?
		</applet>
	</td>
	  <td width="20">&nbsp;</td>
	<td height="100%" valign="top"><br>
        <IFRAME id="content" name="content" onload="javascript:{dyniframesizeHeight('content');dyniframesizeWidth('content');}" src="wait.htm" hspace="0" vspace="0" marginwidth=0 marginheight=0 frameborder=0 width=100% height=100% scrolling=no></IFRAME>	
	</td>
	</tr>

</table>
</center>
</body>
</html>
<?php
	}
}
?>
