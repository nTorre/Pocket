<?php  
require_once '../utils/database.php';

function insert_user($email, $firstname, $lastname, $pass){
	global $pdo;

	$pass_hash = password_hash($pass, PASSWORD_DEFAULT);

	//prendo il record
	$sql='
	insert into users(mail, firstname, lastname, pass_hash)
	values (?, ?, ?, ?)
	';

	$stmt = $pdo->prepare($sql);
	$stmt->execute([$email, $firstname, $lastname, $pass_hash]);

	$result = $stmt->fetch();

	return $result;
}


/* REQUISITI PASSWORD :
		- minimo 8 caratteri massimo 20
		- minimo una lettera maiuscola
*/
function check_pass($password){

	//test lunghezza
	if(strlen($password)<8 || strlen($password)>20){
		return false;
	}
	
	//test maiuscola
	if(strtolower($password) === $password){
		return false;
	}

	return true;
}


/* CONTROLLO SE LA MAIL E' GIA' PRESENTE NEL DATABASE*/
function check_email($email){

	global $pdo;

	//prendo il record
	$sql='
	select *
	from USERS
	where MAIL like ?
	';

	$stmt = $pdo->prepare($sql);
	$stmt->execute([$email]);
	$user = $stmt->fetch();

	if ($user === false){
		//mail disponibile
		return false;
	}
	//mail già registrata
	return true;
}




?>