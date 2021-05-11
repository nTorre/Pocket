<?php  
session_start();

$_SESSION['U_ID'] = 1;

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<form action="delete_event.php" method="POST">

	<input type="text" name="E_ID">
	<button type="submit" >INVIA</button>
	
</form>

</body>
</html>