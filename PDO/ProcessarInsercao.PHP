<?php
    require_once '../conexao.php';

    if($_SERVER["REQUEST_METHOD"] == "POST") {
      $conexao = conectarBanco();

      $sql = "INSERT INTO cliente (nome, endereco, telefone, email) 
              VALUES (:nome, :endereco, :telefone, :email)";



    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Document</title>
</head>
<body>
    
</body>
</html>