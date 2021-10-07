<?php

$servername = "localhost";
$database = "crud_db";
$username = "root";
$password = "";
$charset = "utf8mb4";

try {

$dsn = "mysql:host=$servername;dbname=$database;charset=$charset";
$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
return $pdo;

}

catch (PDOException $e)
{
echo "Connection failed: ". $e->getMessage();
}

?>