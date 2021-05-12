<?php  
require_once '../utils/database.php';
require_once 'utils.php';

session_start();


if(isset($_SESSION['scadenza']) && $_SESSION['scadenza'] > time()){
	//aggiorno scadenza
	$_SESSION['scadenza'] = time() + 30*60;
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

	$user = check_login_web($email, $pass);

	if($user !== false){
		$_SESSION['U_ID'] = $user['U_ID'];
		$_SESSION['scadenza'] = time() + 30*60; 
		//redirect alla dashboard

		print_r($_SESSION);
		exit();
	}
	else{
		echo "errato";
		//redirect login username o password errati
		exit();
	}

}
?>
