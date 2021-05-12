<?php  

require_once '../utils/database.php';
require_once '../utils/check_session.php';

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


if(!isset($_POST['F_ID'])){
	//pagina di errore 
	exit();
}

$F_ID = $_POST['F_ID'];

//controllo che il file richiesto appartenga all'utene loggato in sessione

$sql =
"select 
	f.U_ID 
from files f 
where f.F_ID = ?;";

$stmt = $pdo->prepare($sql);
$stmt->execute([$F_ID]);
$file = $stmt->fetch();


if ($file['U_ID'] !== $_SESSION['U_ID']) {
	//errore redirect a login ????
	//file non dell'utente
	exit();
}

//importo e visualizzo il file

$sql =
"select 
	f.CONTENT,
	f.CONTENT_TYPE,
	f.NAME
from files f 
where f.F_ID = ?;";

$stmt = $pdo->prepare($sql);
$stmt->execute([$F_ID]);
$file = $stmt->fetch();


if($file === false){
	//ERRORE GENERICO APERTURA FILE 
	echo 'file inesistente';
	exit;
}

header("Content-Disposition: attachment; filename = $file[NAME]");
header("Content-type: application/$file[CONTENT_TYPE]");
echo $file['CONTENT'];


?>