<?php  

/*
require_once '../utils/database.php';
require_once '../utils/check_session.php';
*/

function get_events($U_ID){

	global $pdo;

	$sql = "
	select *
	from eventi e 
	where e.U_ID = ?;
	";

	$stmt=$pdo->prepare($sql);
	$stmt->execute([$U_ID]);
	$eventi = $stmt->fetchAll();

	return $eventi;


}



?>