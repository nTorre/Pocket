<?php  

require_once '../utils/database.php';
require_once '../utils/crypto.php';
require_once '../utils/check_session.php';

require_once 'utils.php';


session_start();


$_SESSION['U_ID'] = 1;
$_SESSION['scadenza'] = time() + 48927398;


if(!valid_session()){
	//redirect al login
	exit();
}


foreach ($_FILES as $file) {

    if($file['error']==0){

    	$spazio_usato_preview = get_used_space($_SESSION['U_ID']) + $file['size'];

    	//controllo se posso caricare il file oppure ho finito lo spazio
    	if(check_space($_SESSION['U_ID'], $spazio_usato_preview)){

    		$destination = 'upload/'.basename($file['tmp_name']);
	        $ok = move_uploaded_file($file['tmp_name'], $destination);

	        //query
	        $sql = "	                
				insert into FILES (U_ID, TITOLO, CONTENT_TYPE, CONTENT, DIMENSIONE, DESCRIZIONE, NAME)
				values(?, ?, ?, ?, ?, ?, ?)
	            ";
	        $stmt=$pdo->prepare($sql);

	        //leggo il contenuto dell'immagine da disco
	        $bytes = file_get_contents($destination);

	        //eseguiamo il comando pre-compilato coi valori attuali
	        $conferma = $stmt->execute([$_SESSION['U_ID'], $_POST['titolo'], $file['type'], $bytes, $file['size'], $_POST['descrizione'], $file['name']]); 


	        if ($conferma == null) {
	        	//errore nel caricamento del file
	        	exit();
	        }
    	}
    }
}





?>