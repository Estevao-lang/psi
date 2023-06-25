<?php
$host = 'localhost';
$port = 5432;
$dbname = 'karina';
$user = 'postgres';
$password = 'L0b0tr1pl0@';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Executar consultas ou operações no banco de dados aqui
    
    // Fechar a conexão
    $pdo = null;
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}


?>
