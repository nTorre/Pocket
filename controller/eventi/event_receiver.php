<?php  

require_once '../utils/database.php';

session_start();

if(isset($_SESSION['U_ID'])){
	//aggiorno scadenza
	$_SESSION['scadenza'] = time() + 10;

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

	$evento = $stmt->fetch();

	if($evento === false){
		//inserimento errato
		//pagina di errore nell'inserimento == riprova
		return false;
	}
}

