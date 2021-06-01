<?php 	 
require_once 'utils/database.php';
require_once 'manager_token.php';

$headers = getallheaders();

//$headers['PocketAuthorization'] = "Q4cc7JeMePQvqx9nBaoQcMYb3j0";

if(!isset($headers['Token'])){
	header('Token:0');
	exit();
}else{
	$token = $headers['Token'];
}

$result = check_token($token);

if($result == null){
	header('AuthorizationBearer: 0');
	exit();
}else{	
	$U_ID = $result['U_ID'];
}


$F_ID = $_GET['F_ID'] ?? "";

$sql =
"select 
	f.NAME,
	f.CONTENT,
	f.CONTENT_TYPE 
from files f 
where f.F_ID = ?;";

$stmt = $pdo->prepare($sql);
$stmt->execute([$F_ID]);
$file = $stmt->fetch();


if($file === false){
	//FILE NON TROVATO 
	echo 'file inesistente';
	exit;
}

header('Content-Type: application/json');
echo (json_encode($file));

?>