<?php  
/*
INSERIMENTO EVENTI IN DATABASE
parametri da POST
U__ID da SESSION
*/
require_once '../utils/database.php';
require_once '../utils/check_session.php';

session_start();

if(!valid_session()){
	//redirect al login
	exit();
}


$u_id = $_SESSION['U_ID'];
$titolo = $_POST['titolo'];
$data_ini = $_POST['data_ini'];
$data_fin = $_POST['data_fin'];
$descrizione = $_POST['descrizione'];

if($data_ini > $data_fin){
	//redirect indietro = data errata
	exit();
}

$sql='
insert into EVENTI (U_ID, TITOLO, DATA_INI, DATA_FIN, DESCRIZIONE)
values (?, ?, ?, ?, ?)
';

$stmt = $pdo->prepare($sql);
$stmt->execute([$u_id, $titolo, $data_ini, $data_fin, $descrizione]);

$conferma = $stmt->fetch();

if($conferma === null){
	//pagina di errore / redirect inserimento eventi
	exit();
}else{
	//pagina di conferma / redirect alla pagina eventi
	exit();
}


