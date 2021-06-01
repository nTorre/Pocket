<?php  
require_once 'utils/database.php';
require_once 'manager_token.php';

/*
$headers = getallheaders();

//$headers['PocketAuthorization'] = "Q4cc7JeMePQvqx9nBaoQcMYb3j0";

if(!isset($headers['PocketAuthorization'])){
	header('PocketAuthorization:0');
	exit();
}else{
	$token = $headers['PocketAuthorization'];
}


$result = check_token($token);

if($result == null){
	header('AuthorizationBearer: 0');
	exit();
}else{	
	$U_ID = $result['U_ID'];
}
*/ 

$U_ID = 1;

$sql = "
	select F_ID, NAME, TITOLO, CONTENT_TYPE, DIMENSIONE, DESCRIZIONE
	from files f
	where U_ID = ?;
";

$stmt=$pdo->prepare($sql);
$stmt->execute([$U_ID]);
$RESULT = $stmt->fetchAll();

//header('Content-Type: application/json');


echo "<pre>";
echo (json_encode($RESULT, JSON_PRETTY_PRINT));

echo "</pre>";

?>