<?php 	 
require_once '../utils/database.php';
require_once '../utils/check_session.php';

session_start();

$_SESSION['U_ID'] = 1;
$_SESSION['scadenza'] = time() + 789828;


if(!valid_session()){
	//redirect al login
	exit();
}


$sql = "
	UPDATE eventi 
	SET ?, ?, ?, ?
	WHERE E_ID = ?
	";

$E_ID = $_POST['E_ID'];

$titolo = $_POST['titolo'];
$data_ini = $_POST['data_ini'];
$data_fin = $_POST['data_fin'];
$descrizione = $_POST['descrizione'];

$stmt=$pdo->prepare($sql);
$stmt->execute([$titolo, $data_ini, $data_fin, $descrizione, $E_ID]);
$conferma = $stmt->fetchAll();

if($conferma === null){
	//pagina di errore / redirect calendario
	exit();
}else{
	//pagina di conferma / redirect caledario
	exit();
}



?>