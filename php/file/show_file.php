<?php  

require_once '../utils/database.php';
require_once '../utils/check_session.php';
require_once 'utils.php';

session_start();

/*
$_SESSION['U_ID'] = 1;
$_SESSION['scadenza'] = time() + 48927398;
$_POST['F_ID'] = 2;
*/

if(!valid_session()){
	//redirect al login
	exit();
}


if(!isset($_GET['F_ID'])){
	//pagina di errore 
	exit();
}

$F_ID = $_GET['F_ID'];

if(!file_user($F_ID, $_SESSION['U_ID'])){
	//ERRORE REDIRECT LOGIN
	exit();
}

//importo e visualizzo il file

$sql =
"select 
	f.NAME,
	f.CONTENT,
	f.CONTENT_TYPE 
from files f 
where f.F_ID = ?;";

$stmt = $pdo->prepare($sql);
$stmt->execute([$F_ID]);
$file = $stmt->fetch();


if($file === false){
	//FILE NON TROVATO 
	echo 'file inesistente';
	exit;
}


//header("Content-Disposition: attachment; filename = $file[NAME]");
header("Content-type: $file[CONTENT_TYPE]");
echo $file['CONTENT'];