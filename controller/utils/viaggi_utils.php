<?php  
/*
require_once '../utils/database.php';
require_once '../utils/check_session.php';
*/

function get_visited_countries($U_ID){

	global $pdo;

	$sql = "
		select V_ID, N_ID, TITOLO, DATA_INI, DATA_FIN, DESCRIZIONE 
		from viaggi 
		where U_ID = ?;
	";

	$stmt=$pdo->prepare($sql);
	$stmt->execute([$U_ID]);
	$countries = $stmt->fetchAll();

	return $countries;

}

function get_countries(){

	global $pdo;

	$countries = [];

	$sql = "
		select N_ID, NOME_STATO
		from NAZIONI;
	";

	$stmt=$pdo->prepare($sql);
	$stmt->execute();
	$countries_temp = $stmt->fetchAll();

	foreach ($countries_temp as $country) {
		$countries[$country['N_ID']] = $country['NOME_STATO'];
	}

	return $countries;


}

/*
function get_country_name($N_ID){

	global $pdo;

	$sql = "
		select NOME_STATO
		from nazioni 
		where N_ID = 'IT';
	";
}

*/







?>