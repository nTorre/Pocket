<?php  

require_once 'utils/database.php';
require_once 'utils/check_session.php';

session_start();

if(!check_session()){
	header('Location: reception_login.php');
	exit();
}


//cancello il file
$sql ="
delete 
from wallets 
where U_ID = ?;";

$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['U_ID']]);
$conferma = $stmt->fetch();

//pagina di conferma e redirect all' anteprima dei file
header('Location: crypto_pages.php');
exit();











?>