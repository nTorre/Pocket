<?php  

require_once '../utils/database.php';
require_once '../utils/check_session.php';

session_start();


$_SESSION['U_ID'] = 2;
$_SESSION['scadenza'] = time() + 48927398;


if(!valid_session()){
	//redirect al login
	exit();
}

$_POST['address'] = "kajkxjdnjxjnknxannn";

$sql = "
insert into WALLETS (U_ID, ADDRESS)
values (?, ?);
";

$stmt=$pdo->prepare($sql);
$stmt->execute([$_SESSION['U_ID'], $_POST['address']]);
$risultato = $stmt->fetch();

if ($risultato == null) {
	//errore nell'inserimento
	exit();
}

?>