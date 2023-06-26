<?php
$hostname = 'dpg-chriif0rddlba9o5jl3g-a';
$port = 5432;
$database = 'psi_h416';
$username = 'psi_h416_user';
$password = '4vlVK6fbNgblEsA1jQ2yjADxrjGKEd2S';

try {
    $dsn = "pgsql:host=$hostname;port=$port;dbname=$database";
    $pdo = new PDO($dsn, $username, $password);
    
    // Configurações adicionais, se necessário
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    echo "Conexão bem-sucedida!";
    
    // Realize operações no banco de dados aqui...
    
    // Feche a conexão
    $pdo = null;
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>
<?php
$hostname = 'dpg-chriif0rddlba9o5jl3g-a';
$port = 5432;
$database = 'psi_h416';
$username = 'psi_h416_user';
$password = '4vlVK6fbNgblEsA1jQ2yjADxrjGKEd2S';

try {
    $dsn = "pgsql:host=$hostname;port=$port;dbname=$database";
    $pdo = new PDO($dsn, $username, $password);
    
    // Configurações adicionais, se necessário
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    echo "Conexão bem-sucedida!";
    
    // Criação das tabelas
    $pdo->exec("
        CREATE TABLE servicos (
            id SERIAL PRIMARY KEY,
            titulo VARCHAR,
            conteudo VARCHAR,
            img BYTEA
        );
        
        CREATE TABLE ebook (
            id SERIAL PRIMARY KEY,
            titulo VARCHAR,
            conteudo VARCHAR,
            img BYTEA,
            pdf BYTEA
        );
        
        CREATE TABLE artigo (
            id SERIAL PRIMARY KEY,
            titulo VARCHAR,
            conteudo VARCHAR,
            link VARCHAR
        );
        
        CREATE TABLE login (
            id SERIAL PRIMARY KEY,
            nome VARCHAR,
            email VARCHAR,
            senha VARCHAR
        );
    ");
    
    echo "Tabelas criadas com sucesso!";
    
    // Feche a conexão
    $pdo = null;
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>
