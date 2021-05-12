<?php 
$host = '127.0.0.1';
$db   = 'pocket_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

//PROPRIETA
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,         //se c'è un errore nel comando pdo lancia un eccezione (non serve più controllare il false)
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,    //dammi solo l'associativo      
    PDO::ATTR_EMULATE_PREPARES   => false,		 //non faccio compilare alla libreria ma al database
];
try {
     $pdo = new PDO($dsn, $user, $pass, $options);       //se c'è un problema della connessione non vogliamo che il client veda i dati con cui ho provato a connettermi
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}