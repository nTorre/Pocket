<?php 


require_once '../utils/database.php';
require_once '../utils/check_session.php';

session_start();


$_SESSION['U_ID'] = 3;
$_SESSION['scadenza'] = time() + 48927398;


if(!valid_session()){
	//redirect al login
	exit();
}


$sql = "
select ADDRESS 
from wallets 
where U_ID = ?;
";

$stmt=$pdo->prepare($sql);
$stmt->execute([$_SESSION['U_ID']]);
$address = $stmt->fetch();

//print_r($address);

if ($address == null) {
	//errore nell'inserimento
	exit();
}