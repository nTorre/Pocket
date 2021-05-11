<?php  

require_once '../utils/database.php';
require_once '../utils/check_session.php';

session_start();

if(!valid_session()){
	//redirect al login
	exit();
}

$sql = "
	select *
	from eventi e 
	where e.U_ID = ?;
	";

$stmt=$pdo->prepare($sql);
$stmt->execute([$_SESSION['U_ID']]);
$eventi = $stmt->fetchAll();

//generazione pagina con tramite le api del calendario









?>