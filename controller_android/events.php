<?php  
require_once 'manager_token.php';
require_once 'utils/database.php';
require_once 'utils/event_utils.php';

$headers = getallheaders();

//$headers['Token'] = "cm1qG46pRpXTpQknSKADUImj9FU";

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

$eventi = get_events($U_ID);

header('Content-Type: application/json');
echo (json_encode($eventi));