<?php  

require_once 'utils/database.php';
require_once 'utils/check_session.php';

session_start();

if(!check_session()){
	header('Location: reception_login.php');
	exit();
}

if(!isset($_GET['F_ID'])){
	header('Location: reception_login.php');
	exit();
}

$F_ID = $_GET['F_ID'];

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

//cancello il file
$sql =
"delete 
from files
where F_ID = ?;";

$stmt = $pdo->prepare($sql);
$stmt->execute([$F_ID]);
$conferma = $stmt->fetch();

//pagina di conferma e redirect all' anteprima dei file
header('Location: get_files.php');
exit();