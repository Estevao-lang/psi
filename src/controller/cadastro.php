<?php

include_once ("../model/db_connection.php");


$nome = $_POST['name'];
$quantidade = $_POST['quantity'];
$descricao = $_POST['description'];
$preco = $_POST['price'];
$tipo = $_POST['type'];
$dia = $_POST['created'];


$arquivo    = $_FILES['arquivo']['name'];

//Pasta onde o arquivo vai ser salvo
$_UP['pasta'] = '../upload/';

//Tamanho máximo do arquivo em Bytes
$_UP['tamanho'] = 1024*1024*100; //5mb

//Array com a extensões permitidas
$_UP['extensoes'] = array('png', 'jpg', 'jpeg', 'gif');

//Renomeiar
$_UP['renomeia'] = false;

//Array com os tipos de erros de upload do PHP
$_UP['erros'][0] = 'Não houve erro';
$_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'Não foi feito o upload do arquivo';

//Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
if($_FILES['arquivo']['error'] != 0){
    die("Não foi possivel fazer o upload, erro: <br />". $_UP['erros'][$_FILES['arquivo']['error']]);
    exit; //Para a execução do script
}


//Faz a verificação do tamanho do arquivo
else if ($_UP['tamanho'] < $_FILES['arquivo']['size']){
    echo "
  
        <script type=\"text/javascript\">
            alert(\"Arquivo muito grande.\");
        </script>
    ";
}

//O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta foto
else{
    //Primeiro verifica se deve trocar o nome do arquivo
    if($_UP['renomeia'] == true){
        //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
        $nome_final = time().'.jpg';
    }else{
        //mantem o nome original do arquivo
        $nome_final = $_FILES['arquivo']['name'];
    }
    //Verificar se é possivel mover o arquivo para a pasta escolhida
    if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta']. $nome_final)){
        //Upload efetuado com sucesso, exibe a mensagem


    $query_products = "INSERT INTO products SET name='$nome', quantity='$quantidade',description= '  $descricao',price= ' $preco' ,type= ' $tipo', created='$dia ',image=' $nome_final'";
    $result_products = $conn->prepare($query_products);
    $result_products->execute();

        echo "
        <script type=\"text/javascript\">
      

            alert(\"Imagem cadastrada com Sucesso.\");


        </script>
    ";  
}else{
    //Upload não efetuado com sucesso, exibe a mensagem
    echo "
  
        <script type=\"text/javascript\">
		header('location: ../pages/welcome.php');
 
            alert(\"Imagem não foi cadastrada com Sucesso.\");
    

        </script>
    ";
    }
}


?>
