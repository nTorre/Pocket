<?php  

/*
TUTTI CAMPI NOT NULL

InsertError CODE 10 : esiste già un account registrato con questa mail
InsertError CODE 11 : password non rispetta i parametri
IsertError  CODE  0 : nessun errore
*/

require_once 'utils/registration_utils.php';

$firstname = $_POST['firstname'] ?? "";
$lastname = $_POST['lastname'] ?? "";  
$email = $_POST['email'] ?? "";
$pass = $_POST['password'] ?? "";
$re_pass = $_POST['re-password'] ?? "";


if(check_email($email)){
 	header('InsertError:10');
    exit();
}

if(!check_pass($pass)){
    //pass non valida (parametri minimi)
	header('InsertError:11');
    exit();
}

$conferma = insert_user($email, $firstname, $lastname, $pass);
header('InsertError:0');
