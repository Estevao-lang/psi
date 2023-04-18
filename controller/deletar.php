<?php

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    include_once("../model/db_connection.php");   
    
    $sqlInsert = "DELETE FROM products WHERE id = '$id'";   
    $deletaPost = mysqli_query($conn,$sqlInsert);

if($deletaPost) {
        header("Location: ".$_SERVER['HTTP_REFERER']."");
        exit;
} else {
    echo mysqli_error($conn);
}

// o script abaixo deleta através de um checkbox, e elimina varios de uma vez.
// quero que esse seja o padrão, e o script acima seja uma função que só funcione quando chamada.
if( !empty( $_POST['deletar'] ) ) {
   $groups = array_chunk( $_POST['deletar'], 50 );
   foreach ( $groups AS $group ) {
$group = implode('\',\'', $_POST['deletar']);
        $query = 'DELETE FROM conteudo WHERE id IN (\''. $group .'\')';
       $deleta = mysqli_query($conn, $query);
      // executa a query
   }

}

?> 