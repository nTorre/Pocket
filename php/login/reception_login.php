<?php  

require_once '../utils/check_session.php';
require_once '../utils/database.php';
require_once 'utils.php';

session_start();

	/*
	if($_SERVER['REQUEST_METHOD'] !== 'POST'){
		//redirect home sito
		echo "vuoi derubarmi in get bastardone";
		exit();
	}
	*/

$errore = "";

$_SESSION = [];

if(valid_session()){
    header('Location: ../dashboard.php');
    exit();
}

if(isset($_POST['email'])){

	$email = $_POST['email'];
	$pass = $_POST['pass'];

	$user = check_login_web($email, $pass);

	if($user !== false){
		//login corretto
		$_SESSION['U_ID'] = $user['U_ID'];
		$_SESSION['scadenza'] = time() + 30*60; 
		header('Location: ../dashboard.php');
		exit();
	}else{
		$errore = "error";

	}

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POCKETLOGIN</title>
    <link rel="stylesheet" href="../../style/style_signin.css">
</head>

<body>


    <div class="centerlize">
        <div class="container">
            <form action="" method="POST" class="container_box">

                <p class="title">Sign in</p>

                <input name="email" type="email" placeholder="E-mail" class="<?=$errore?>">
                <input name="pass" type="password" placeholder="Password" class="<?=$errore?>">

                <?php if($errore=='error') echo '<p style="color: RED; font-size: 12px"><b>Impossibile trovare il tuo Pocket Account </b></p>'?>
                
                <button type="submit" class="header_button-in" >SIGN IN</button> 

            </form>
            <a href="http://www.freepik.com"><img class="img_signup" src="../../icons/3081782.svg"></a>

        </div>
    </div>
</body>
</html>
