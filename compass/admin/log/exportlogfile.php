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
echo 'here';

if (is_null($_SESSION['loginname'])) {
	header("location:/compass/error_code.php?code=001"); 
}else {


	include "priority.php";
	$priority = new priority;
	if(!$priority->checkPage(8)){
           
		//header("location:/compass/error_code.php?code=004"); 
	}else{		
		include "db_mysql_mt.inc"; 
			
		$db = new DB_Sql;
		$db->connect();
		$db1 = new DB_Sql;
		$db1->connect();
		
		$folderpath=$_REQUEST['folderpath'];
		$fromtime = ($_REQUEST['fromtime']==null?"":$_REQUEST['fromtime']);
		$totime = ($_REQUEST['totime']==null?"":$_REQUEST['totime']);
		
		$rp = realpath(".")."\\".$folderpath;
		//$rp = $folderpath;

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
		$goal=array("","Homework","Project","Labs","Class work","Fun","Other");
		$place=array("","School-During Science Class","School-Outside Science Class","Home","Other");
		$source=array("Map","Text","NaviBar");
		//gws: CHANGED ON 10/4/11 $sql = "select e.idexploration ide,u.loginname username,g.name gname, c.name cname,u1.loginname teachername,DATE_FORMAT(e.time,'%Y%m%d') time,e.question question,e.place place, e.goal goal,e.leader leader from USER u left join GROUPMEMBERS gm on u.iduser=gm.idstudent,USER u1,STUDYGROUP g,CLASS c,EXPLORATION e where u.iduser=e.idstudent and e.idclass=c.idclass and c.idclass=g.idclass and g.idgroup=gm.idgroup and c.idteacher=u1.iduser";
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
			$loghead="\r\n\r\n\r\nUser\tGroup\tLeader\tQuestion\tGoal\tPlace\r\n".$db->Record['username']."\t".$db->Record['gname']."\t".($db->Record['leader']==null?"N/A":$db->Record['leader'])."\t".($db->Record['question']==null?"N/A":$db->Record['question'])."\t".$goal[$db->Record['goal']]."\t".$place[$db->Record['place']]."\r\n";
			fwrite($handle,$loghead);
			$ide=$db->Record['ide'];
//write table labels
			$tablelabels="\r\nUnit\tTopic\tConcept\tExample\tSource\tEntering Time\tLeaving Time\tStaying Time(Sec)\r\n";
			fwrite($handle,$tablelabels);

			$sql="select ld.time,ld.endtime endtime,ld.source source,c.general_title cname,t.name tname,u.name uname,e.name ename,ld.timelength timelength from LOGDATA ld left join CONCEPT c on c.idconcept=ld.idconcept left join TOPIC t on ld.idtopic=t.idtopic left join UNIT u on ld.idunit=u.idunit left join EXAMPLE e on ld.idexample=e.idexample where ld.idexploration=".$ide." order by ld.time";
			$db1->query($sql);
			while($db1->next_record()){
				$actions=($db1->Record['uname']==null?"N/A":$db1->Record['uname'])."\t";
				$actions.=($db1->Record['tname']==null?"N/A":$db1->Record['tname'])."\t";
				$actions.=($db1->Record['cname']==null?"N/A":$db1->Record['cname'])."\t";
				$actions.=($db1->Record['ename']==null?"N/A":$db1->Record['ename'])."\t";
				$actions.=$source[$db1->Record['source']]."\t";
				$actions.=$db1->Record['time']."\t";
				$actions.=($db1->Record['endtime']==null?"N/A":$db1->Record['endtime'])."\t";
				$actions.=($db1->Record['timelength']==null?"N/A":$db1->Record['timelength'])."\r\n";
				fwrite($handle,$actions);
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