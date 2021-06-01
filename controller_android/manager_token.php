<?php  
//require_once 'utils/database.php';
function check_login($email, $pass){
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
		return $user['U_ID'];
	}
	return false;
}

function check_UID($U_ID){
	global $pdo;

	$sql='
	select 1
	from tokens 
	where U_ID = ?
	';

	$stmt = $pdo->prepare($sql);
	$stmt->execute([$U_ID]);

	$result = $stmt->fetch();

	if ($result !== null) {
		return $result;
	}else{
		return null;
	}
}

function insert_token($U_ID){

	global $pdo;

	$token = generate_token();

	$sql='
	insert into tokens (T_ID, U_ID)
	values ( ? , ?);
	';

	$stmt = $pdo->prepare($sql);
	$stmt->execute([$token, $U_ID]);

	$conferma = $stmt->fetch();

	return $token;

}

function check_token($token){

	global $pdo;

	$sql='
	select U_ID
	from TOKENS
	where T_ID = ?
	';

	$stmt = $pdo->prepare($sql);
	$stmt->execute([$token]);

	$conferma = $stmt->fetch();

	if ($conferma !== false) {
		return $conferma['U_ID'];
	}
	return $conferma;
}

function check_expiry($token){

	global $pdo;

	$sql="
	select SCADENZA
	from TOKENS
	where T_ID = ?
	";

	$stmt = $pdo->prepare($sql);
	$stmt->execute([$token]);

	$scadenza = $stmt->fetch();

	if($scadenza['SCADENZA'] > time()){
		return false;
	}else{
		update_expiry($token);
		return true;
	}
}

function update_expiry($token){

	global $pdo;

	$sql = "
		UPDATE tokens 
		SET scadenza = current_timestamp() + interval 30 day
		WHERE T_ID = ?;
	";

	$stmt = $pdo->prepare($sql);
	$stmt->execute([$token]);

	$stmt->fetch();
}

function update_token($U_ID){
	global $pdo;

	$new_token = generate_token();

	$sql = "
	UPDATE tokens 
	SET scadenza = current_timestamp() + interval 30 day, T_ID = ?
	WHERE U_ID = ?;
	";

	$stmt = $pdo->prepare($sql);
	$stmt->execute([$new_token, $U_ID]);

	$stmt->fetch();

	return $new_token;
}

function generate_token(){
	return trim(strtr(base64_encode(random_bytes(20)), '/+', '_-'), '=');
}

?>