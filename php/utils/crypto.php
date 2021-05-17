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
	$link = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=".$contract."&address=".$address."&tag=latest&apikey=".$apikey;

	$bytes = file_get_contents($link);

	$obj = json_decode($bytes);

	
	//stdClass Object ( [status] => 1 [message] => OK [result] => 100000000000000 ) 
	
	return $obj;
}


?>