<?
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
		$uid = $_REQUEST['uid'];	
		$suid = $_REQUEST['suid'];	
		$tid = $_REQUEST['tid'];	
		$cid = $_REQUEST['cid'];
?>
<html>

<head>
<meta http-equiv="Content-Style-Type" content="text/css" />
</head>

<body><table border="1" cellspacing="1" cellpadding="1">
  <tr>
    <td>
		        <applet code="com.compass.conceptmap.CompassApplet.class"
			codebase="/compass/conceptmap/classes"
			width="520" height="500" style="">
			<param name="textField" value="label"/>
			<param name="concepts" value="http://<?=$_SERVER['SERVER_NAME']?>/compass/xmls/concepts.xml"/>
			<param name="relations" value="http://<?=$_SERVER['SERVER_NAME']?>/compass/xmls/relation.xml"/>
			<param name="examples" value="http://<?=$_SERVER['SERVER_NAME']?>/compass/xmls/examples.xml"/>
			<param name="urlPrefix" value="http://<?=$_SERVER['SERVER_NAME']?>/compass/researcher/"/>
			<param name="homePic" value="http://<?=$_SERVER['SERVER_NAME']?>/compass/images/home.gif"/>
<?
	if($uid!=null){
?>
			<param name="focusUnit" value="<?=$uid?>"/>
<?
}
  	if($suid!=null) {
?>
			<param name="focusSubUnit" value="<?=$suid?>"/>
<?
}
	if($tid!=null){
?>
			<param name="focusTopic" value="<?=$tid?>"/>
<?
}
	if($cid!=null){
?>
			<param name="focusConcept" value="<?=$cid?>"/>
<?
}
?>			If you can read this text, the applet is not working. Perhaps you don't
			have the Java 1.4 (or later) web plug-in installed?
		</applet>
   </td>
  </tr>
</table>

</body>
<html>
<?
	}
}
?>
