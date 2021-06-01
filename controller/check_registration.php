<?php  

require_once 'utils/database.php';
require_once 'utils/check_session.php';
require_once 'utils/registration_utils.php';


session_start();

$errore1_string = "E-mail";
$errore2_string = "Repeat password";
$errore3_string = "Password";

$errore1 = ""; //redirect mail già presente 
$errore2 = ""; //redirect password non coincidono
$errore3 = ""; //redirect pass non valida (parametri minimi)

$generic_error = "";
$insert_error = "";

//$_SESSION = [];
//print_r($_SESSION);

if(check_session()){
    header('Location: dashboard.php');
    exit();
}


if(isset($_POST['btn_send'])){

    if($_POST['email'] !== "" && $_POST['firstname'] !== "" && $_POST['lastname'] !== ""){    

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $re_pass = $_POST['re-password'];

        if(check_email($email)){
            //mail già presente 
            $errore1 = "error";
            $errore1_string = "esiste già un account registrato con questa mail";
        }

        if($pass !== $re_pass){
            //password non coincidono
            $errore2 = "error";
            $errore2_string = "le password non coincidono";
        }

        if(!check_pass($pass)){
            //pass non valida (parametri minimi)
            $errore3 = "error";
            $errore3_string = "password non rispetta i parametri";
        }

        if($errore1 === "" && $errore2 === "" && $errore3 === ""){
            $conferma = insert_user($email, $firstname, $lastname, $pass);

            if($conferma !== null){
                header("Location: reception_login.php");
                exit();
            }
            $insert_error = "error";

        }
    }else{
        $generic_error = "error";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/style_signup.css">
</head>
<body>
    <div class="centerlize">
        <div class="container">
            <a href="http://www.freepik.com"><img class="img_signup" src="../icons/4565.svg"></a>
            <form action="" method="POST" class="container_box">
                <p class="title">Sign up</p>
                <input name="firstname" id="name" type="text" placeholder="Firstname" value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname'];?>">
                <input name="lastname" type="text" placeholder="Lastname" value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname'];?>">
                <input name="email" type="email" placeholder="<?=$errore1_string?>" class="<?=$errore1?>" 
                       value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>">
                <input name="password" oninput="checkPass()" id="password" type="password" placeholder="<?=$errore3_string?>" class="<?=$errore3?>">
                <input name="re-password" oninput="checkPass()" id="re-password" type="password" placeholder="<?=$errore2_string?>" class="<?=$errore2?>">

                <?php if($generic_error == 'error') echo '<p style="color: RED; font-size: 12px"><b>Inserisci correttamente tutti i campi </b></p>'?>

                <?php if($insert_error == 'error') echo '<p style="color: RED; font-size: 12px"><b> Errore nell inserimento, Riprova </b></p>'?>

                <input name="check" class="check" type="checkbox">
                <p class="terms">I've read all statements from <a href="">Terms of service</a></p>

                <button name="btn_send" type="submit" id="submit" class="header_button-in">Sign Up</button>
            </form>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
    function checkPass() {
        let pass = document.getElementById("password").value;
        let re_pass = document.getElementById("re-password").value;

        if (pass != "" && re_pass != "")
            if (pass != re_pass) {
                document.getElementById("re-password").classList.add("error");
                $("#submit").css({
                    "pointer-events": "none",
                    "background": "#6494ed7a"
                });

            } else {
                document.getElementById("re-password").classList.remove("error");
                $("#submit").css({
                    "pointer-events": "auto",
                    "background": "#6495ED"
                });
            }
        else {
            document.getElementById("re-password").classList.remove("error");
            $("#submit").css({
                "pointer-events": "auto",
                "background": "#6495ED"
            });
        }
    }
</script>
</html>