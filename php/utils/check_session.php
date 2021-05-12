<?php  


function valid_session(){

	if(!isset($_SESSION['U_ID'])){
		return false;
	}
	if($_SESSION['scadenza'] < time() || !isset($_SESSION['scadenza'])){
		return false;
	}
	$_SESSION['scadenza'] = time() + 30*60;
	return true;

}


?>