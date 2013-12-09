<?php
session_start();

function deldir($dir)
{
  $handle = opendir($dir);
  while (false!==($FolderOrFile = readdir($handle)))
  {
     if($FolderOrFile != "." && $FolderOrFile != "..") 
     {  
       if(is_dir("$dir/$FolderOrFile")) 
       { deldir("$dir/$FolderOrFile"); }  // recursive
       else
       { unlink("$dir/$FolderOrFile"); }
     }  
  }
  closedir($handle);
  if(rmdir($dir))
  { $success = true; }
  return $success;  
} 


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
		$db1 = new DB_Sql;
		$db1->connect();
		
		$folderpath=$_REQUEST['folderpath'];
		$pf=$_REQUEST['pf'];
		if($pf==null)
			$pf=0;
		$fromtime = ($_REQUEST['fromtime']==null?"":$_REQUEST['fromtime']);
		$totime = ($_REQUEST['totime']==null?"":$_REQUEST['totime']);
		
		$rp = realpath(".")."\\".$folderpath;
//clear the folder
		if(file_exists($rp)){
			deldir($rp);
	  	}
		mkdir($rp);
//clearing useless data
		$sql =	"select idexploration ide from exploration group by idexploration";
		$db->query($sql);
		while ($db->next_record()){
			$ide = $db->Record['ide'];
			$sql="select count(*) cnt from logdata where idexploration=".$ide;
			$db1->query($sql);
			$db1->next_record();
			$cnt = $db1->Record['cnt'];
			if($cnt==0){
				$sql="delete from exploration where idexploration=".$ide;
				$db1->query($sql);
			}
		}
		$sql =	"select idexploration ide,count(*) cnt from logdata group by idexploration";
		$db->query($sql);
		while ($db->next_record()){
			$ide = $db->Record['ide'];
			$cnt = $db->Record['cnt'];
			if($cnt<3){
				$sql="delete from EXPLORATION where idexploration=".$ide;
				$db1->query($sql);
				$sql="delete from LOGDATA where idexploration=".$ide;
				$db1->query($sql);
			}
		}
//		$goal=array("","Homework","Project","Labs","Class work","Fun","Other");
//		$place=array("","School-During Science Class","School-Outside Science Class","Home","Other");
		$t=array("Inclined plane" =>"IP","Lever" =>"L","Pulley" =>"P","Screw" =>"S","Wedge" =>"W","Wheel and Axle" =>"WA","Circular motion" =>"CM","Falling objects" =>"FO","Linear motion" =>"LM","Rotational motion" =>"RM","Projectile motion" =>"PM", 
		"Inclined Plane (1)" =>"IP","Lever (1)" =>"L","Pulley (1)" =>"P","Screw (1)" =>"S","Wedge (1)" =>"W","Wheel and Axle (1)" =>"WA",
		"Inclined Plane (2)" =>"IP","Lever (2)" =>"L","Pulley (2)" =>"P","Screw (2)" =>"S","Wedge (2)" =>"W","Wheel and Axle (2)" =>"WA",
		"Inclined Plane (3)" =>"IP","Lever (3)" =>"L","Pulley (3)" =>"P","Screw (3)" =>"S","Wedge (3)" =>"W","Wheel and Axle (3)" =>"WA");
		$tp=array("Inclined plane" =>"IP","Lever" =>"Lever","Pulley" =>"Pulley","Screw" =>"Screw","Wedge" =>"Wedge","Wheel and Axle" =>"WA","Circular motion" =>"CM","Falling objects" =>"FO","Linear motion" =>"LM","Rotational motion" =>"RM","Projectile motion" =>"PM",
		"Inclined Plane (1)" =>"IP","Lever (1)" =>"Lever","Pulley (1)" =>"Pulley","Screw (1)" =>"Screw","Wedge (1)" =>"Wedge","Wheel and Axle (1)" =>"WA",
		"Inclined Plane (2)" =>"IP","Lever (2)" =>"Lever","Pulley (2)" =>"Pulley","Screw (2)" =>"Screw","Wedge (2)" =>"Wedge","Wheel and Axle (2)" =>"WA",
		"Inclined Plane (3)" =>"IP","Lever (3)" =>"Lever","Pulley (3)" =>"Pulley","Screw (3)" =>"Screw","Wedge (3)" =>"Wedge","Wheel and Axle (3)" =>"WA");
		$source=array("Map","Text","NaviBar");
		// GWS: changed on 10/4/11 $sql = "select e.idexploration ide,u.loginname username, c.name cname,u1.loginname teachername,DATE_FORMAT(e.time,'%Y%m%d') time,e.question question,e.leader leader from USER u ,USER u1,CLASS c,EXPLORATION e where e.place=1 and u.iduser=e.idstudent and e.idclass=c.idclass and c.idteacher=u1.iduser";
		$sql = "select e.idexploration ide,u.loginname username,c.name cname,u1.loginname teachername,DATE_FORMAT(e.time,'%Y%m%d') time,e.question question,e.place place, e.goal goal,e.leader leader from USER u,USER u1,CLASS c,EXPLORATION e where u.iduser=e.idstudent and e.idclass=c.idclass and c.idteacher=u1.iduser";
		
		if($fromtime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')>='".$fromtime."'";
		if($totime !="")
			$sql.=" and DATE_FORMAT(e.time,'%Y%m%d')<='".$totime."'";
		$db->query($sql);
		while ($db->next_record()){
			$teacherfolder=$rp."\\".$db->Record['teachername'];
			if(!file_exists($teacherfolder))
				mkdir($teacherfolder);
			$classfolder=$teacherfolder."\\".$db->Record['cname'];
			if(!file_exists($classfolder))
				mkdir($classfolder);
			$logfile=$classfolder."\\".$db->Record['time'].".txt";
			$handle = fopen ($logfile, "a");
			if($pf==0){
				$loghead="\r\n\r\n\r\nUser\tLeader\tQuestion\r\n".$db->Record['username']."\t".($db->Record['leader']==null?"N/A":$db->Record['leader'])."\t".($db->Record['question']==null?"N/A":$db->Record['question'])."\r\n";
				fwrite($handle,$loghead);
//write table labels
				$tablelabels="\r\nGroup\tNode\tSource\tStaying Time(Sec)\r\n";
				fwrite($handle,$tablelabels);
			}
			$ide=$db->Record['ide'];

			$sql="select ld.time,ld.endtime endtime,ld.source source,c.general_title cname,t.name tname,u.name uname,e.name ename,ld.timelength timelength from LOGDATA ld left join CONCEPT c on c.idconcept=ld.idconcept left join TOPIC t on ld.idtopic=t.idtopic left join UNIT u on ld.idunit=u.idunit left join EXAMPLE e on ld.idexample=e.idexample where ld.idexploration=".$ide." order by ld.time";
			$db1->query($sql);
			$previousNode=null;
			while($db1->next_record()){
				$nodename="";
				if($db1->Record['uname']!=null && $db1->Record['tname']==null && $db1->Record['cname']==null){
					if($db1->Record['uname']=="Forces and Motion")
						$nodename="FM";
					else
						$nodename="SM";
				}
				else if($db1->Record['tname']!=null){
					if($db1->Record['cname']==null){
						$nodename=$tp[$db1->Record['tname']];
					}
					else{
						$nodename=$db1->Record['cname']."_".$t[$db1->Record['tname']];
					}
				}
				else{
					$nodename=$db1->Record['cname'];
				}
				if($pf==0){
					$actions=$db->Record['username']."\t";
					$actions.=$nodename."\t";
					$actions.=$source[$db1->Record['source']]."\t";
					$actions.=($db1->Record['timelength']==null?"N/A":$db1->Record['timelength'])."\r\n";
					fwrite($handle,$actions);
				} else {
					if($previousNode != $nodename){
						$actions=$db->Record['username']."\t";
						$actions.=$nodename."\r\n";
						fwrite($handle,$actions);
					}
				}
				$previousNode = $nodename;
			}
			fclose($handle);
		}
		$zipfile=$rp.".zip";
		if(file_exists($zipfile))
			unlink($zipfile);
		$command="\"C:\Program Files\WinRAR\Rar.exe\" a ".$folderpath.".zip ".$folderpath;
		exec($command);
		deldir($rp);
?>
<html>
<head>
<link rel="stylesheet"  href="../../css/compass.css" type="text/css" media=screen>
</head>

<body marginheight=0 marginwidth=0 topmargin=0 leftmargin=0>
<div align="center">
  <p>&nbsp;</p>
  <p><font size="5">Log files are successfully exported! <br>
    Click <a href="<?=$folderpath?>.zip">here</a> to download the zip file.</font></p>
</div>
</body>
</html>
<? 
	}
}
?>