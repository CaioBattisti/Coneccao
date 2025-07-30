<?php
    require '../conexao.php';

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $conexao = conectarBanco();

        $id = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);

        if(!$id){
            die("Erro: ID Inválido.");
        }
    }
?>