<?php  
require_once '../utils/database.php';

function check_login_web($email, $pass){
	global $pdo;

	//prendo il record
	$sql='
	select 
		U_ID, 
		PASS_HASH
	from USERS
	where MAIL like ?
	';

	$stmt = $pdo->prepare($sql);
	$stmt->execute([$email]);

	$user = $stmt->fetch();

	if($user === false){
		//login errato
		return false;
	}

	//restituisco risultato del password verify
	if(password_verify($pass, $user['PASS_HASH'])){
		return $user;
	}
	return false;
}


function generate_token(){
	$token = trim(strtr(base64_encode(random_bytes(30)), '/+', '_-'));
	header("Authorization: $token");
	return $token;
}

function insert_token(){


}