<?php  

require_once 'database.php';

//prendo l'indirizzo di un wallet dato l'ID dell utente
function get_address($U_ID){
	
	global $pdo;

	$sql = "
	select *
	from wallets w
	where w.U_ID = ?;
	";

	$stmt=$pdo->prepare($sql);
	$stmt->execute([$U_ID]);
	$risultato = $stmt->fetch();

	if($risultato !== null){
		return $risultato['ADDRESS'];
	}
	return null;
}


//prendo il numero di PKTC di un dato indirizzo
function get_balance($address){

	global $pdo;

	$contract = "0xf1fad91c3afb4da2417b7af5fdbaf552c6aa9636";
	$apikey = "SXWKBK4AHK38HDQRTFP27179EZQ617F8WG";
	$link = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress="
	        .$contract."&address=".$address."&tag=latest&apikey=".$apikey;

	try {
		$bytes = file_get_contents($link);
	} catch (Exception $e) {
		return 0;
	}

	$obj = json_decode($bytes);
	
	//stdClass Object ( [status] => 1 [message] => OK [result] => 100000000000000 ) 
	
	return $obj;
}


/*
STARTER 	  0 PKTC = 1GB
STARTER +  1000 PKTC = 5GB
EXPERT    10000 PKTC = 60GB
PRO      100000 PKTC = 800GB
*/
function get_plane($U_ID){

	$balance_obj = get_balance(get_address($U_ID));

	if($balance_obj->status == 0){
		return "STARTER";
	}

	$balance = $balance_obj->result;

	if($balance < 1000){
		return "STARTER";
	}else 
	if($balance < 10000){
		return "STARTER PLUS";
	}else
	if($balance < 100000){
		return "EXPERT";
	}else{
		return "PRO";
	}
	return -1;
}

function get_max_usable($U_ID){

	$balance_obj = get_balance(get_address($U_ID));

	if($balance_obj->status == 0){
		return 1;
	}

	$balance = $balance_obj->result;

	if($balance < 1000){
		return 1;
	}else 
	if($balance < 10000){
		return 5;
	}else
	if($balance < 100000){
		return 60;
	}else{
		return 800;
	}
	return -1;

}

function approximate_space($bytes){

	$used = "";

	if ($bytes == 0) {
		$used = "0 MB";
	}else if($bytes < 0.001){
		$used = "1 MB";
	}else{
		$used = round($bytes, 3) . "GB";
	}

	return $used;
}

function check_address($address){

	global $pdo;

	$sql = "
	select 1
	from wallets w
	where w.ADDRESS = ?;
	";

	$stmt=$pdo->prepare($sql);
	$stmt->execute([$address]);
	$risultato = $stmt->fetch();

	if($risultato == null){
		return true;
	}
	return false;


}
?>