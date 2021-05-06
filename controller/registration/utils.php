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
		- NO SPAZI
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

	/*
	//test spazio
	if(strpos($password, " ") !== null){
		return false;
	}
	*/
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
		return false;
	}
	return true;
}

//------------UTILS------------
/*

function check_syntax_email($email){
	// elimino spazi, "a capo" e altro alle estremità della stringa
	$email = trim($email);

	echo $email;


	// se la stringa è vuota sicuramente non è una mail
	if(!$email) {
		return "1111";
		//return false;
	}

	// controllo che ci sia una sola @ nella stringa
	$num_at = count(explode( '@', $email )) - 1;
	if($num_at != 1) {
		return ("2222");
		//return false;
	}

	// controllo la presenza di ulteriori caratteri "pericolosi":
	if(strpos($email,';') || strpos($email,',') || strpos($email,' ')) {
		return "3333";
		//return false;
	}

	// la stringa rispetta il formato classico di una mail?
	if(!preg_match( '/^[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}$/', $email)) {
		return "4444";
		//return false;
	}

	return true;
}

*/



?>