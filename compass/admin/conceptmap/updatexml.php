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
		
		$db1 = new DB_Sql;
		$db1->connect();

		$db2 = new DB_Sql;
		$db2->connect();
		
		$xml = new DOMDocument();
		$root = $xml->CreateElement("concepts");
		$xml->appendChild($root);
		
		$sql = "select distinct(tc.idconcept) cid,c.general_title cname from CONCEPTINTOPIC tc, CONCEPT c where tc.idconcept=c.idconcept";
		$db->query($sql);
		while($db->next_record()){
			$record = $xml->CreateElement("concept","");
			$record->setAttribute("id",(string) $db->Record['cid']);
			$record->setAttribute("label",$db->Record['cname']);
			$root->appendChild($record);
		}
		$xmlcontent = $xml->saveXML();
		$rp = realpath("../../xmls/concepts.xml");
		if ($fh=fopen($rp,"w")) { 
		  fputs($fh,$xmlcontent); 
		  fclose($fh); 
		} else { 
		  header("location:/compass/error_code.php?code=007"); 
		} 

		$xml = new DOMDocument();
		$root = $xml->CreateElement("relation");
		$xml->appendChild($root);
		
		$sql = "select distinct(t.idunit) uid,u.name uname from TOPIC t, UNIT u where u.idunit=t.idunit order by uid";
		$db->query($sql);
		while($db->next_record()){
			$record = $xml->CreateElement("unit","");
			$record->setAttribute("id",(string) $db->Record['uid']);
			$uname = $db->Record['uname'];
			$parenpos = strpos($uname,"(");   //GWS 1/3/08 - removing parentheses and indeces from titles
			if ($parenpos !== false) $uname = substr($uname,0,$parenpos);	
			$record->setAttribute("label",$uname);
			$root->appendChild($record);
			$sql = "select idtopic tid,name tname from TOPIC where idunit=".$db->Record['uid']." order by tid";
			$db1->query($sql);
			while($db1->next_record()){
				$record1 = $xml->CreateElement("topic","");
				$record1->setAttribute("id",(string) $db1->Record['tid']);
				$tname = $db1->Record['tname'];
				$parenpos = strpos($tname,"(");   //GWS 1/3/08 - removing parentheses and indeces from titles
				if ($parenpos !== false) $tname = substr($tname,0,$parenpos);	
				$record1->setAttribute("label",$tname);
				$record->appendChild($record1);
				$sql = "select cr.conceptfrom cid1,cr.conceptto cid2,r.name rname from CONCEPTRELATION cr,RELATION r where cr.idrelation=r.idrelation and cr.idtopic=".$db1->Record['tid'];
				$db2->query($sql);
				while($db2->next_record()){
					$record2 = $xml->CreateElement("edge","");
					$record2->setAttribute("source",(string) $db2->Record['cid1']);
					$record2->setAttribute("target",$db2->Record['cid2']);
					$record2->setAttribute("label",$db2->Record['rname']);
					$record1->appendChild($record2);
				}		
			}		
		}
		$xmlcontent = $xml->saveXML();
		$rp = realpath("../../xmls/relation.xml");
		if ($fh=fopen($rp,"w")) { 
		  fputs($fh,$xmlcontent); 
		  fclose($fh); 
		} else { 
		  header("location:/compass/error_code.php?code=008"); 
		} 

		$xml = new DOMDocument();
		$root = $xml->CreateElement("examples");
		$xml->appendChild($root);
		$sql = "select idexample eid,name ename from EXAMPLE order by eid";
		$db->query($sql);
		while($db->next_record()){
			$record = $xml->CreateElement("example","");
			$record->setAttribute("id",(string) $db->Record['eid']);
			$record->setAttribute("label",$db->Record['ename']);
			$root->appendChild($record);
			$sql = "select idconcept cid from EXAMPLE_HAS_CONCEPT where idexample=".$db->Record['eid']." order by cid";
			$db1->query($sql);
			while($db1->next_record()){
				$record1 = $xml->CreateElement("concept","");
				$record1->setAttribute("id",(string) $db1->Record['cid']);
				$record->appendChild($record1);
			}
		}
		$xmlcontent = $xml->saveXML();
		echo $xmlcontent;

		$rp = realpath("../../xmls/examples.xml");
		if ($fh=fopen($rp,"w")) { 
		  fputs($fh,$xmlcontent); 
		  fclose($fh); 
		} else { 
		  header("location:/compass/error_code.php?code=009"); 
		} 

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
	<td align=center nowrap class=f14w> <b>[ XML File Info ]</b>&nbsp; </td>
	</tr>
	<tr>
	<td colspan=2 height=150 align=center class=bgcolor1> <table width="80%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><div align="center"><a href="/compass/xmls/concepts.xml" target="_blank">Concept 
              XML File</a></div></td>
        </tr>
        <tr> 
          <td><div align="center"><a href="/compass/xmls/relation.xml" target="_blank">Relation 
              XML File</a></div></td>
        </tr>
        <tr> 
          <td><div align="center"><a href="/compass/xmls/examples.xml" target="_blank">Example 
              XML File</a></div></td>
        </tr>
      </table>
      <p> <br>
      </p>
	</td>
	</tr>
	<tr>
	<td align=center colspan=2 class=bgcolor3>Files updated SUCCESSFULLY</td>
	</tr>
</table>

</body>
</html>
<?php 
	}
}
?>