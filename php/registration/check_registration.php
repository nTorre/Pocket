<?php  

require_once '../utils/database.php';
require_once 'utils.php';

session_start();


$firstname = $_POST['firstname'] ?? "";
$lastname = $_POST['lastname'] ?? "";
$email = $_POST['email'] ?? "";
$pass = $_POST['password'] ?? "";
$re_pass = $_POST['re_password'] ?? "";



if(check_email($email)){
	//redirect mail già presente 
	header("location: http://localhost/pocket/registration/signup.html");
	exit();
}

if($pass !== $re_pass){
	//redirect password non coincidono
	header("Error: 2");
	header("location: http://localhost/pocket/registration/signup.html");
	exit();
}

if(!check_pass($pass)){
	//redirect pass non valida (parametri minimi)
	header("Error: 3");
	header("location: http://localhost/pocket/registration/signup.html");
	exit();
}

/*

if(check_syntax_email($email)){
	//redirect mail sintax non valida
	echo "errore2";
	exit();
}
*/

insert_user($email, $firstname, $lastname, $pass);
header("location: http://localhost/pocket/login/login.html");
exit();
?>