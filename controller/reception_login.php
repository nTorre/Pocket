<?php  

require_once 'utils/check_session.php';
require_once 'utils/database.php';
require_once 'utils/login_utils.php';

session_start();
$_SESSION = [];
$errore = "";

if(check_session()){
    header('Location: dashboard.php');
    exit();
}

if(isset($_POST['btn_send'])){

	if($_POST['email'] !== ""){

		$email = $_POST['email'];
		$pass = $_POST['pass'];

		$user = check_login_web($email, $pass);

		if($user !== false){
            $_SESSION['U_ID'] = $user['U_ID'];
            $_SESSION['scadenza'] = time() + 30 * 60;

			header('Location: dashboard.php');
			exit();
		}else{
			$errore = "error";
		}
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
    <link rel="stylesheet" href="../style/style_signin.css">
</head>

<body>


    <div class="centerlize">
        <div class="container">
            <form action="" method="POST" class="container_box">

                <p class="title">Sign in</p>

                <input name="email" type="email" placeholder="E-mail" class="<?=$errore?> <?=$errore_inserimento?>">
                <input name="pass" type="password" placeholder="Password" class="<?=$errore?>">

                <p style="color: GREY; font-size: 10px" >Almeno una lettera maiuscola (8-20)</p>

                <?php if($errore == 'error') echo '<p style="color: RED; font-size: 12px"><b>Impossibile trovare il tuo Pocket Account </b></p>'?>

                <button name="btn_send" type="submit" class="header_button-in" >SIGN IN</button> 

            </form>
            <a href="http://www.freepik.com"><img class="img_signup" src="../icons/3081782.svg"></a>

        </div>
    </div>
</body>
</html>
