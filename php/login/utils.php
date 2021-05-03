<?php  
require_once '../utils/database.php';

function check_login($email, $pass){
	global $pdo;

	//prendo il record
	$sql='
	select 
		MAIL, 
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