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
include "config.inc"; 
include "pager.inc"; 

$uid = $_REQUEST['uid'];
$tid = $_REQUEST['tid'];
	
$db = new DB_Sql;
$db->connect();
$sql = "select idunit,name from UNIT order by name";
$db->query($sql);
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
	rtn = true;
	if(form1.cid1.value == form1.cid2.value){
		alert("Concept 1 and Concept 2 can not be the same one!");
		form1.cid1.focus();
		rtn=false;
	}
	return rtn;
}
function changeUnit(){
	self.location="addrelation.php?uid="+form1.uid.value;
}
function changeTopic(){
	self.location="addrelation.php?uid="+form1.uid.value+"&tid="+form1.tid.value;
}

function sendRequest(url,callback,postData) {
	var req = createXMLHTTPObject();
	if (!req) return;
	var method = (postData) ? "POST" : "GET";
	req.open(method,url,true);
	req.setRequestHeader('User-Agent','XMLHTTP/1.0');
	if (postData)
		req.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	req.onreadystatechange = function () {
		if (req.readyState != 4) return;
		if (req.status != 200 && req.status != 304) {
//			alert('HTTP error ' + req.status);
			return;
		}
		callback(req);
	}
	if (req.readyState == 4) return;
	req.send(postData);
}

var XMLHttpFactories = [
	function () {return new XMLHttpRequest()},
	function () {return new ActiveXObject("Msxml2.XMLHTTP")},
	function () {return new ActiveXObject("Msxml3.XMLHTTP")},
	function () {return new ActiveXObject("Microsoft.XMLHTTP")}
];

function createXMLHTTPObject() {
	var xmlhttp = false;
	for (var i=0;i<XMLHttpFactories.length;i++) {
		try {
			xmlhttp = XMLHttpFactories[i]();
		}
		catch (e) {
			continue;
		}
		break;
	}
	return xmlhttp;
}

var newRel = "";

function relationAdded(req) {
	if (!req || !req.responseText) return;
	var sel = document.form1.rid;
	var opt = document.createElement("option");
	opt.value = req.responseText;
	opt.innerHTML = newRel;
	sel.appendChild(opt);
	opt.selected=true;
}


function sanitize(str) {
	var sanitized="";
	for (var i = 0, len = str.length; i < len; i++) {
		var ch = str.charAt(i);
		if ( (ch <= 'z' && ch >= 'a') || (ch <= 'Z' && ch >='A') ||
			(ch <= '9' && ch >= '0') || ch == ' ') {
				sanitized += ch;
			}
	}
	return sanitized;
}

function addRelation() {
	var r = prompt("New Relation");
	if (!r) return;
	newRel = sanitize(r);
	var url = "add_new_relation.php?rname="+newRel;
	sendRequest(url, relationAdded);
}

</script>
</head>
<link rel="stylesheet"  href="../../css/compass.css" type="text/css" media=screen>
<body>
<center>
<p>&nbsp;</p>
  <p><span class="tabletitle">Add a New Concept_Relation</span></p>
  <form name="form1" method="post" action="savenewrelation.php" onSubmit="return check()">
    <table width="75%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td width="33%"><div align="right">Unit:</div></td>
        <td width="4%">&nbsp;</td>
        <td width="63%"><select name="uid" onChange="changeUnit()">
<?
	$i=0;
	while($db->next_record()){
		$selected="";
		if($uid != null){
			if($uid==$db->Record['idunit'])
				$selected="selected";
		}
		else if($i==0){
			$uid = $db->Record['idunit'];
		}
		$i++;
				
?>
            <option value="<?= $db->Record['idunit']?>" <?=$selected?>> 
            <?= $db->Record['name']?>
            </option>
<?
	}
?>
          </select> </td>
      </tr>
      <tr> 
        <td><div align="right">Topic</div></td>
        <td>&nbsp;</td>
        <td><select name="tid" onChange="changeTopic()">
<?
	$sql="select idtopic,name from TOPIC where idunit=".$uid." order by name";
	$db->query($sql);
	$i=0;
	while($db->next_record()){
		$selected="";
		if($tid != null){
			if($tid==$db->Record['idtopic'])
				$selected="selected";
		}
		else if($i==0){
			$tid = $db->Record['idtopic'];
		}
		$i++;
?>
            <option value="<?= $db->Record['idtopic']?>" <?=$selected?>> 
            <?= $db->Record['name']?>
            </option>
            <?
	}
?>
          </select></td>
      </tr>
<? 	if($tid != null){
?>
      <tr> 
        <td><div align="right">Concept 1:</div></td>
        <td>&nbsp;</td>
        <td> <select name="cid1">
<?
		$sql = "select c.idconcept cid,c.general_title cname from CONCEPTINTOPIC tc,CONCEPT c where tc.idconcept=c.idconcept and tc.idtopic=".$tid." order by c.general_title";
		$db->query($sql);
		while($db->next_record()){
?>
            <option value="<?= $db->Record['cid']?>"> 
            <?= $db->Record['cname']?>
            </option>
            <?
	}
?>
          </select> </td>
      </tr>
      <tr> 
        <td><div align="right">Concept 2:</div></td>
        <td>&nbsp;</td>
        <td> <select name="cid2">
            <?
	$db->seek(0);
	while($db->next_record()){
?>
            <option value="<?= $db->Record['cid']?>"> 
            <?= $db->Record['cname']?>
            </option>
            <?
	}
?>
          </select> </td>
      </tr>
      <tr> 
        <td><div align="right">Relation:</div></td>
        <td>&nbsp;</td>
        <td> <select name="rid">
            <?
	$sql = "select idrelation,name from RELATION order by name";
	$db->query($sql);
	while($db->next_record()){
?>
            <option value="<?= $db->Record['idrelation']?>"> 
            <?= $db->Record['name']?>
            </option>
            <?
	}
?>
	    <option value="" style="display:none" id="rop"></option>
	  </select> 
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button onclick="addRelation();return false;">Add New Relation</button>
	</td>
      </tr>
      <tr> 
        <td><div align="right">Relation Level:</div></td>
        <td>&nbsp;</td>
        <td> <select name="rlevel">
            <option value="1">Loose</option>
            <option value="2" selected>Normal</option>
            <option value="3">Tight</option>
          </select> </td>
      </tr>
      <tr> 
        <td><div align="right">Description:</div></td>
        <td>&nbsp;</td>
        <td><textarea name="description" cols="50" rows="6"></textarea> </td>
      </tr>
<?
}
?>
    </table>
    <p>
<?
if($tid != null){
?>
    <input type="submit" name="Submit" value="Submit">
<?
}
?>
  </form>
  </p>
</center>
</body>
</html>
