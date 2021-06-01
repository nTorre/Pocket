<?php  
require_once 'manager_token.php';
require_once 'utils/database.php';
require_once 'utils/crypto.php';

$headers = getallheaders();

$headers['Token'] = "Q4cc7JeMePQvqx9nBaoQcMYb3j0";

if(!isset($headers['Token'])){
	header('Token:0');
	exit();
}else{
	$token = $headers['Token'];
}

$U_ID = check_token($token);

if($U_ID == null){
	header('Token: 0');
	exit();
}

$balanceobj = get_balance(get_address($U_ID));

header('Content-Type: application/json');
echo (json_encode($balanceobj));

//oggetto restituito {"status":"1","message":"OK","result":"100000000000000"}