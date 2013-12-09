<?php
class tracer { 
	var $idstudent; 
	var $idexploration;
	var $ids = array("uid" => 0, "tid" => 0, "cid" => 0, "eid" => 0, "source" => 0, "dllink" => "");
	
	function tracer(){ 
		$this->idstudent = $_SESSION['iduser'];
		$this->idexploration = $_SESSION['idexploration'];
		if($this->idstudent == NULL)
			header("location:/compass/error_code.php?code=001");
		else if($this->idstudent == NULL)
			header("location:/compass/error_code.php?code=010");
		else
			return true;
	}

/**
	check whether or not the last action is the same as this one. If return value is true, the action is new, and log should be updated.
*/	
	function isNewAction($newids){
		$rtn = false;
		foreach ( $newids as $key => $value ){
			if($value != $this->ids[$key]){
				$this->ids = $newids;
				$rtn = true;
				break;
			}
		}
		return $rtn;
	}
	

/**
	update database
*/
	function updateLog($db){
		$sql = "select (UNIX_TIMESTAMP()-UNIX_TIMESTAMP(max(time))) timelength,max(time) lasttime,now() nowtime from LOGDATA where idexploration=".$this->idexploration;
		$db->query($sql);
		if($db->next_record()){
			$timelength=$db->Record['timelength'];
			$lasttime=$db->Record['lasttime'];
			$nowtime=$db->Record['nowtime'];
			if($timelength != null){
				$sql = "update LOGDATA set timelength=".$timelength.",endtime='".$nowtime."' where idexploration=".$this->idexploration." and time='".$lasttime."'";
				$db->query($sql);
			}
		}	
		$sql = "insert into LOGDATA set time=now(), idexploration=".$this->idexploration;
		if($this->ids['uid'] != 0)
			$sql .=",idunit=".$this->ids['uid'];
		if($this->ids['tid'] != 0)
			$sql .=",idtopic=".$this->ids['tid'];
		if($this->ids['cid'] != 0)
			$sql .=",idconcept=".$this->ids['cid'];
		if($this->ids['eid'] != 0)
			$sql .=",idexample=".$this->ids['eid'];
		if($this->ids['dllink'] != "")
			$sql .=",dllink='".$this->ids['dllink']."'";
		$sql .=",source=".$this->ids['source'];
			
		return $db->query($sql);
	}	
	
		
} 
?>