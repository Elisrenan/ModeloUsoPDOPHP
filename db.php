<?php
$host = 'localhost'; // ou o endereço do seu servidor
$db = 'your_database_name'; // nome do seu banco de dados
$user = 'your_username'; // seu usuário do banco de dados
$pass = 'your_password'; // sua senha do banco de dados


try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
?>