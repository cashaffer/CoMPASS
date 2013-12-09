<?php
class priority { 
	var $usertype; 
	
	function priority(){ 
		$this->usertype = $_SESSION['usertype'];
		if($this->usertype == NULL)
			header("location:/compass/error_code.php?code=001");	
	}

/**
	check if the user has the power to access the page
*/	
	function checkPage($pageMask){
		if(($pageMask & $this->usertype) == $pageMask)
			return true;
		else
			return false;
	}
		
} 
?>