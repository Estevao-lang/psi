<?php
session_start(); 

// Incluindo a conexão com banco de dados   
include("../model/conexao.php");    

// O campo usuário e senha preenchido entra no if para validar
if (isset($_POST['name']) && isset($_POST['senha'])) {
    $usuario = pg_escape_string($conn, $_POST['name']); // Escapar de caracteres especiais, prevenindo SQL injection
    $senha = pg_escape_string($conn, $_POST['senha']);
    $senha = md5($senha);
        
    // Buscar na tabela usuario o usuário que corresponde com os dados digitados no formulário
    $result_usuario = "SELECT * FROM usuarios WHERE email = '$usuario' AND senha = '$senha' LIMIT 1";
    $resultado_usuario = pg_query($conn, $result_usuario);
    $resultado = pg_fetch_assoc($resultado_usuario);
    
    // Encontrado um usuário na tabela usuario com os mesmos dados digitados no formulário
    if ($resultado !== false) {
        $_SESSION['usuarioId'] = $resultado['id'];
        $_SESSION['usuarioNome'] = $resultado['nome'];
  
        $_SESSION['usuarioEmail'] = $resultado['email'];
        
        if ($_SESSION['usuarioNiveisAcessoId'] == "1") {
            header("Location: ../pages/welcome.php");
        } elseif ($_SESSION['usuarioNiveisAcessoId'] == "2") {
            header("Location: colaborador.php");
        } else {
            header("Location: cliente.php");
        }
    } else {    
        // Variável global recebendo a mensagem de erro
        $_SESSION['loginErro'] = "Usuário ou senha inválido";
        header("Location: ../pages/login.php");
    }
} else {
    // O campo usuário e senha não preenchidos entram no else e redirecionam o usuário para a página de login
    $_SESSION['loginErro'] = "Usuário ou senha inválido";
    header("Location: ../pages/login.php");
}
?>
