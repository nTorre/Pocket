<?php  
require_once '../utils/database.php';
require_once 'utils.php';

session_start();

if($_SESSION['scadenza'] > time()){
	//aggiorno scadenza
	$_SESSION['scadenza'] = time() + 10;
	//redirect alla dashboard
	echo "sono già loggato mandami alla home";
	exit();
}
else{
	if($_SERVER['REQUEST_METHOD'] !== 'POST'){
		//redirect home sito
		echo "vuoi derubarmi in get bastardone";
		exit();
	}

	$email = $_POST['email'] ?? "";
	$pass = $_POST['pass'] ?? "";

	$user = check_login($email, $pass);

	if($user !== false){
		echo "corretto";
		$_SESSION['mail'] = $user['MAIL'];
		$_SESSION['scadenza'] = time() + 10; 
		//redirect alla dashboard
		exit();
	}
	else{
		echo "errato";
		//redirect login username o password errati
		exit();
	}

}

?>
