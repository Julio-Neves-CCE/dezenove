<?php
$dbHost = 'localhost'; // O nome correto é 'localhost'
$dbUsername = 'root';
$dbPassword = 'n3tuno';
$dbName = 'dezenove';

$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Verifique a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
} 

try {
    // Criação da conexão com o banco de dados
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar: " . $e->getMessage());
}
   
?>