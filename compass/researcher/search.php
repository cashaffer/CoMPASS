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
		include "config_mt.inc"; 		
		include "db_mysql_mt.inc"; 
		$db = new DB_Sql;		
		$db->connect();
		$key = $_REQUEST['key'];
			$sql="select idtopic tid,name tname,idunit uid from TOPIC where name like '%".$key."%'";
			$db->query($sql);
			if($db->next_record()){
				$tname=$db->Record['tname'];
				$tid=$db->Record['tid'];
				$uid=$db->Record['uid'];
?>
<SCRIPT LANGUAGE="JavaScript">
	window.parent.document.mapApplet.shareddata.setmap(<?=$uid?>,<?=$tid?>,null,2);
</SCRIPT>
<?
		}
		else{
			$sql="select idconcept cid,general_title cname from CONCEPT where general_title like '%".$key."%'";
			$db->query($sql);
			if($db->next_record()){
				$cname=$db->Record['cname'];
				$cid=$db->Record['cid'];
				if($cid==114)
					$cid=112;
	?>
	<SCRIPT LANGUAGE="JavaScript">
		window.parent.document.mapApplet.shareddata.setmap(null,null,<?=$cid?>,2);
//		window.parent.url="/";
	</SCRIPT>
	<?
			}
		else{

		$sql="select idconcept cid,general_title cname from CONCEPT where general_title like '".$key."%'";
		$db->query($sql);
		if($db->next_record()){
			$cname=$db->Record['cname'];
			$cid=$db->Record['cid'];
			if($cid==114)
				$cid=112;
?>
<SCRIPT LANGUAGE="JavaScript">
	window.parent.document.mapApplet.shareddata.setMap(null,null,<?=$cid?>,2);
</SCRIPT>
<?
			}
			else{
				$sql="select idunit uid,name uname from UNIT where name like '%".$key."%'";
				$db->query($sql);
				if($db->next_record()){
					$uname=$db->Record['uname'];
					$uid=$db->Record['uid'];
?>
<SCRIPT LANGUAGE="JavaScript">
	window.parent.document.mapApplet.shareddata.setmap(<?=$uid?>,null,null,2);
</SCRIPT>
<?
				}
				else{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">
<!--
.para {
	text-align: justify;
	margin-top: 0in;
}
.otherlabel {
	font-size: small;
}
.topic {
	font-size: small;
}
.otheroptions {
	background-color: #CCCCFF;
}
.concept {
	color: #990000;
}
.heading {
	font-family: "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
	font-size: 24px;
	font-weight: bold;
	margin-top: .5em;
	margin-bottom: .3em;
}
.unit {
	font-size: 10px;
}
body {
	margin: 0px;
}
.topbar {
	color: #FFFFFF;
	background-color: #000066;
}

a:link.logout, a:visited.logout {
	color: #FFFFFF;
}

a:hover.logout {
	color: #FFFF00;
}

a:active.logout {
	color: #FF0000;
}

-->
</style>
</head>
<SCRIPT LANGUAGE="JavaScript">
function unitChanged()
{ 
	idunit=window.document.form1.idunit.value;
	window.parent.document.mapApplet.shareddata.setMap(idunit,null,null,2);
//	self.location="nav.php?uid="+idunit;
}

function check(){
	desc=window.document.form1.key.value;
	rtn = true;
	if(desc == ""){
		alert("Please input Educational Description!");
		form1.key.focus();
		rtn=false;
	}
	else
		rtn = true;
	return rtn;
}
</SCRIPT>
<body>
 <form name="form1" method="post" action="search.php"  onSubmit="return check()">
<table width="100%" border="0" cellpadding="0" cellspacing="5">
  <tr> 
    <td colspan="2"> <table class="topbar" width="100%" cellpadding="0" cellspacing="5">
          <tr>
            <td> <select name="idunit" onChange="unitChanged();">
                <option value="<?=(($uid==null)?0:$uid)?>">Change unit</option>
                <?
			$sql="select idunit,name from UNIT order by name";
			$db->query($sql);
			while ($db->next_record()){
				$idunit = $db->Record['idunit'];
				$unitname = $db->Record['name'];
				$select = "";
				if($idunit!=$uid){
		?>
                <option value="<?= $idunit?>"> 
                <?= htmlentities($unitname)?>
                </option>
                <?
				}
			}
		?>
              </select></td>
            <td> <select name="idtopic" onChange="topicChanged();">
                <option value="<?=(($tid==null)?0:$tid)?>">Change topic</option>
                <?
			$tname=null;
			if($uid != null){
				$sql="select idtopic,name from TOPIC where idunit=".$uid." order by name";
				$db->query($sql);
				while ($db->next_record()){
					$idtopic = $db->Record['idtopic'];
					$topicname = $db->Record['name'];
					$select = "";
					if($idtopic!=$tid){
			?>
                <option value="<?= $idtopic?>" > 
                <?= htmlentities($topicname)?>
                </option>
                <?
				  }
				  else
				  $tname=$topicname;
				}
			}
		?>
              </select> </td>
            <td> <span class="otherlabel">Search</span> <input name="key" type="text" class="unit" size="15"> 
              <input type="submit" name="Submit" value="Go"> </td>
            <td> <span class="otherlabel"><a class="logout" href="">Logout</a></span> 
            </td>
          </tr>
        </table>
</td>
  </tr>
  <tr valign="top"> 
    <td width="50%" colspan="2" class="otheroptions"> Record <font color="#CC0000">Not 
      </font>Found! Please try another keyword or select one unit. </td>
        </tr>
      </table></td>
  </tr>
</table>
</form>
</body>
</html>
<?				
		}
				}		
			}
		}
	}
}
?>	
