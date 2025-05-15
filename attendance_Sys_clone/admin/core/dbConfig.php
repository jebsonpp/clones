<?php 
session_start();
$host = "localhost";
$user = "root";
$password = "";
$dbname = "multi_dev_test3";
$dsn = "mysql:host={$host};dbname={$dbname}";

$pdo = new PDO($dsn, $user, $password);
$pdo->exec("SET time_zone = '+08:00';");

?>