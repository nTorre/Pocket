<?php  

require_once 'utils/database.php';
require_once 'manager_token.php';


$headers = getallheaders();

$email = $headers['Email'] ?? "";
$pass = $headers['Pass'] ?? "";


/*
$email = "sebatorre@gmail.com";
$pass = "Sebastiano13";
*/

$U_ID = check_login($email, $pass);

if($U_ID == null){
	echo "failed";
	exit();
}

if(check_UID($U_ID) == null){
	//primo login
	//inserisco token per la prima volta
	echo insert_token($U_ID);
}else{
	//token già presente 
	//lo aggiorno e restitusico uno nuovo
	echo update_token($U_ID);
}



/*

if(check_expiry($token) && check_token($token)){
	return true;
}else{
	return false;
}

*/
?>