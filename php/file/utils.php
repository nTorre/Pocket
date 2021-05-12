<?php  

require_once '../utils/database.php';
require_once '../utils/crypto.php';


//controllo che il file richiesto appartenga all'utene loggato in sessione
function file_user ($F_ID, $U_ID){
	$sql =
	"select 
		f.U_ID 
	from files f 
	where f.F_ID = ?;";

	$stmt = $pdo->prepare($sql);
	$stmt->execute([$F_ID]);
	$file = $stmt->fetch();

	if ($file['U_ID'] !== $U_ID) {
		return false;
	}
	return true;
}


/*
STARTER 	  0 PKTC = 1GB
STARTER +  1000 PKTC = 5GB
EXPERT    10000 PKTC = 60GB
PRO      100000 PKTC = 800GB
*/

function check_space($U_ID, $spazio_preview){

	//accesso al database wallets e prendo il balance

	//$balance = get_balance(get_address($U_ID)) ?? 0;
	$balance = 0;

	if($balance < 1000){
		($spazio_preview > 1* 1000000000) ? false : true;
	}else 
	if($balance < 10000){
		($spazio_preview > 5 * 1000000000) ? false : true;
	}else
	if($balance < 100000){
		($spazio_preview > 60 * 1000000000) ? false : true;
	}else{
		($spazio_preview > 800 * 1000000000) ? false : true;
	}

	return -1;

}


function get_used_space($U_ID){

	global $pdo;

	//query
    $sql = "
    	select sum(f.DIMENSIONE) as spazio_utilizzato
		from files f
		where U_ID = ?;
	    ";

	$stmt=$pdo->prepare($sql);
	$stmt->execute([$U_ID]);
	$result = $stmt->fetch();

	if ($result == null) {
		return false;
	}

	return $result['spazio_utilizzato'];

}





?>