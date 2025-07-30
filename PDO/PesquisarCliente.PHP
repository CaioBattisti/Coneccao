<?php
    require '../conexao.php';

    $conexao = conectarbanco();
    $busca = $_GET['busca'] ?? '';
?>