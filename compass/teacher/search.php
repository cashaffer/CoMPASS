<?
session_start();

if ($_SESSION['loginname'] == null)
	header("location:/compass/error_code.php?code=001"); 
//	echo $_SESSION['loginname'];
else {
	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(1))
		header("location:/compass/error_code.php?code=004"); 
	else{	
		include "config_mt.inc"; 		
		include "db_mysql_mt.inc"; 
		$db = new DB_Sql;		
		$db->connect();
		$key =  $_REQUEST['key'] ;
		if ($key == "vector" || $key == "vectors")	
			$key = "force";
		if ($key == "weight")	
			$key = "gravity";
		if ($key == "height")	
			$key = "potential";
			
		$uid =  $_REQUEST['uid'] ;
		if (!$uid) {$uid = "20, 19, 18, 15, 13, 12";}
			$sql="select idtopic tid,name tname,idunit uid from TOPIC where name like '%".$key."%' and idunit in (" . $uid . ") order by idunit";
			$db->query($sql);
			if($db->next_record()){
				$tname=$db->Record['tname'];
				$tid=$db->Record['tid'];
				$uid=$db->Record['uid'];
?>
<SCRIPT type="text/javascript">
				window.parent.location="explore.php?uid="+ <?=$uid?> +"&tid=" + <?=$tid?>;			
//	parent.document.mapApplet.shareddata.setmap(<?=$uid?>,<?=$tid?>,null,2);
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
				<SCRIPT type="text/javascript">
				window.parent.location= window.parent.location + "&cid=" + <?=$cid?>;			
				
//		parent.document.mapApplet.shareddata.setmap(null,null,<?=$cid?>,2);
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
	parent.document.mapApplet.shareddata.setmap(null,null,<?=$cid?>,2);
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
	parent.document.mapApplet.shareddata.setmap(<?=$uid?>,null,null,2);
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
	idunit=document.form1.idunit.value;
	parent.document.mapApplet.shareddata.setmap(idunit,null,null,2);
}
function topicChanged()
{ 
	idunit=window.document.form1.idunit.value;
	idtopic=window.document.form1.idtopic.value;
	if(idtopic != '0'){
		window.parent.document.mapApplet.shareddata.setMap(idunit,idtopic,null,2);
//		self.location="nav.php?uid="+idunit+"&tid="+idtopic;
	}
}

function check(){
	desc=document.form1.key.value;
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
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</SCRIPT>
<body>
 <form name="form1" method="post" action="search.php"  onSubmit="return check()">
<table width="100%" border="0" cellpadding="0" cellspacing="5">
  <tr> 
    <td colspan="2"> <table class="topbar" width="100%" cellpadding="0" cellspacing="5">
        <tr> 
          <td height="24"> 
              <select name="idunit" onChange="unitChanged();">
                <option value="<?=(($uid==null)?0:$uid)?>">Change unit</option>
                <?
			//$sql="select idunit,name from UNIT order by name";
			// GWS - updated to display only the units for the current class
			$sql="select distinct unit.idunit, unit.name FROM unit, class_to_unit, takesclass, user where unit.idunit = class_to_unit.idunit and class_to_unit.idclass = takesclass.idclass and takesclass.idstudent = user.iduser and user.loginname = '" . $_SESSION['loginname'] . "' order by unit.name";
			$db->query($sql);
			while ($db->next_record()){
				$idunit = $db->Record['idunit'];
				$unitname = $db->Record['name'];
				
				$parenpos = strpos($unitname,"(");   //GWS 1/3/08 - removing parentheses and indeces from titles
				if ($parenpos !== false) {
				   $unitname = substr($unitname ,0,$parenpos);	
				} else { 
  				   $unitname = $unitname; 
	                        } 


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
          <td>  <select name="idtopic" onChange="topicChanged();">
              <option value="<?=(($tid==null)?0:$tid)?>">Change topic</option>
              <?
			$tname=null;
			if($uid != null){
				$sql="select idtopic,name from TOPIC where idunit=".$uid." order by name";
				$db->query($sql);
				while ($db->next_record()){
					$idtopic = $db->Record['idtopic'];
					$topicname = $db->Record['name'];

					$parenpos = strpos($topicname,"(");   //GWS 1/3/08 - removing parentheses and indeces from titles
					if ($parenpos !== false) {
					   $topicname = substr($topicname,0,$parenpos);	
					} else { 
  					   $topicname = $topicname;
	                      		} 

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
		<td> <span class="otherlabel"><a href="###" class="logout" onClick="MM_openBrWindow('history.php','loghistory','scrollbars=yes,resizable=yes,width=300,height=500')">History</a></span> 
            </td>
            <td> <span class="otherlabel"><a href="###" class="logout" onClick="MM_openBrWindow('navgraph.php','graph','scrollbars=yes,resizable=yes,width=1050,height=650')">Graph</a></span> 
            </td>
	    <td> <span class="otherlabel"><a class="logout" href="selectunit.php" TARGET="_parent">Top Page</a></span> 
          </td>
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
