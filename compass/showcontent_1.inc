<?php

include "config.inc";

class showcontent_1 { 
	var $uid;
	var $suid;
	var $tid;
	var $cid;
	var $eid;
	var $title;
	var $title_formatted;

	function showcontent_1(){ 
	}

/**
	check whether or not the last action is the same as this one. If return value is true, the action is new, and log should be updated.
*/	
	function setids($ids){
		$this->uid=$ids['uid'];
		$this->suid=$ids['suid'];
		$this->tid=$ids['tid'];
		$this->cid=$ids['cid'];
		$this->eid=$ids['eid'];
	}

/**
	get "description" of the node from database
*/
	function getcontent($db){
		$sql = "";
		$sql1 = "";
		$content = "";
		$dlpart = "";
		if(($this->uid != 0) && ($this->suid == 0) && ($this->tid == 0) && ($this->cid == 0) && ($this->eid == 0)){
			$sql ="select description d,name n from UNIT where idunit=".$this->uid;
			$sql1 = "select description d from ADDITIONALINFO where idunit=".$this->uid." and idtopic=0 and idconcept=0 and idexample=0";
		}
		else if ( ($this->suid != 0) ) {
			$sql = "select description d,name n from SUBUNIT where idsubunit=".$this->suid;
		}
		else if(($this->tid != 0) && ($this->cid == 0) && ($this->eid == 0)){
			$sql ="select description d,name n from TOPIC where idtopic=".$this->tid;
			$sql1 = "select description d from ADDITIONALINFO where idtopic=".$this->tid." and idconcept=0 and idexample=0";
		}
		else if(($this->tid == 0) && ($this->cid != 0) && ($this->eid == 0)){
			$sql ="select educational_description d,general_title n from CONCEPT where idconcept=".$this->cid;
			$sql1 = "select description d from ADDITIONALINFO where idconcept=".$this->cid." and idtopic=0 and idexample=0";
		}
		else if(($this->tid != 0) && ($this->cid != 0) && ($this->eid == 0)){
			$sql ="select tc.description d,CONCAT('<font color=\"#990000\">',c.general_title,'</font> in ',t.name) n from CONCEPTINTOPIC tc,CONCEPT c,TOPIC t where tc.idconcept="
			.$this->cid." and tc.idtopic=".$this->tid." and tc.idconcept=c.idconcept and tc.idtopic=t.idtopic";
			$sql1 = "select description d from ADDITIONALINFO where idconcept=".$this->cid." and idtopic=".$this->tid." and idexample=0";
		}
		else if($this->eid != 0){
			$sql ="select description d, name n from EXAMPLE where idexample=".$this->eid;			
			$sql1 = "select description d from ADDITIONALINFO where idexample=".$this->eid;	
		}
		else 
			;
		$db->query($sql);
		if($db->next_record()){
			$content = $db->Record['d'];
			$title = $db->Record['n'];
		}
		if(false){
			$db->query($sql1);
			if($db->next_record())
				$dlpart = $db->Record['d'];
			if($dlpart != "")
				$content = $content."<dlpart>".$dlpart."</dlpart>";
		}
		if($content != ""){
			$_SESSION['nodedscpt'] = $content;
			
			$parenpos = strpos($title,"(");
			if ($parenpos !== false) {
			   $title_formatted = substr($title,0,$parenpos);	
			} else { 
  			   $title_formatted = $title; 
                        } 
			$_SESSION['pagetitle'] = $title_formatted;
		}
		else
			$_SESSION['nodedscpt'] = null;
	}	

	
	function getparts(){
		$parts = array();
		$content = $_SESSION['nodedscpt'];
		if($content != null){
			if(strpos($content,"<content>") !== false)
				$parts["content"] = "Back";
			if(strpos($content,"<contentmore>") !== false)
				$parts["contentmore"] = "More";
			if(strpos($content,"<advanced>") !== false)
				$parts["advanced"] = "In-depth";
			if(strpos($content,"<animation>") !== false)
				$parts["animation"] = "Animation";
			if(strpos($content,"<G-force>") !== false)
				$parts["G-force"] = "G-force";
			if(strpos($content,"<dlpart>") !== false)
				$parts["dlpart"] = "Link-to-DL";
			return $parts;
		}
		else
			return null;
	}
	
	function getdetail($part){
		$content = $_SESSION['nodedscpt'];
		if($content != null){
			$start = strpos($content,"<".$part.">");
			if($start !== false){
				$end = strpos($content,"</".$part.">");
				return substr($content,$start+strlen("<".$part.">"),$end-$start-strlen("<".$part.">"));
			}
			else
				return null;
		}
		else
			return null;
	}	

	function gettitle(){	
		$title = $_SESSION['pagetitle'];
		return $title;
	}	
		
		
} 
?>
