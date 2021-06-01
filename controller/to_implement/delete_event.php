<?php  

/*
L'ID DELL EVENTO (E_ID) DA ELIMINARE MI VIENE PASSATO IN GET 
L'ID DELL'UTENTE (U_ID) LO PRENDO DALLA SESSIONE
*/

require_once 'utils/database.php';
require_once 'utils/check_session.php';

session_start();

if(!check_session()){
	header('Location: reception_login.php');
	exit();
}

$E_ID = $_GET['E_ID'] ?? 1;


//controllo che l'evento sia dell'utente loggato in sessione
$sql = "
	select U_ID
	from eventi 
	where E_ID = ?;
	";

$stmt=$pdo->prepare($sql);
$stmt->execute([$E_ID]);
$utente = $stmt->fetchAll();

if($utente === false){
	//pagina di errore / redirect alla pagina eventi 
	exit();
}

if($utente[0]['U_ID'] == $_SESSION['U_ID']){
	//eliminazione evento
	$sql = "
		delete 
		from eventi 
		where E_ID = ?;
	";

	$stmt2=$pdo->prepare($sql);
	$stmt2->execute([$E_ID]);

	$conferma = $stmt2->fetchAll();

	if($conferma === null){
		//pagina di errore / redirect alla pagina eventi 
		exit();
	}else{
		//conferma/ redirect alla pagina eventi 
		exit();
	}

}

?>