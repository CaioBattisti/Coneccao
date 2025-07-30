<?php
    require_once '../conexao.php';

    if($_SERVER["REQUEST_METHOD"] == "POST") {
      $conexao = conectarBanco();

        $sql = "INSERT INTO cliente (nome, endereco, telefone, email) 
                VALUES (:nome, :endereco, :telefone, :email)";
        $stmt = $conexao->prepare($sql);
        $stmt ->bindParam(':nome', $_POST['nome']);
        $stmt ->bindParam(':endereco', $_POST['endereco']);
        $stmt ->bindParam(':telefone', $_POST['telefone']);
        $stmt ->bindParam(':email', $_POST['email']);
        try {
            $stmt->execute();
            echo "Cliente Cadastrado com Sucesso!";
        } catch (PDOExcepition $e){
            error_log("Erro ao Inserir Cliente:".$e->getMessage());
            echo "Erro ao Cadasrar Cliente";
        }
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