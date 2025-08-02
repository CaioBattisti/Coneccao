<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Processar Inserção</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <?php
        require_once 'conexao.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $conexao = conectarBanco();

            $sql = "INSERT INTO cliente (nome, endereco, telefone, email) 
                        VALUES (:nome, :endereco, :telefone, :email)";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':nome', $_POST['nome']);
            $stmt->bindParam(':endereco', $_POST['endereco']);
            $stmt->bindParam(':telefone', $_POST['telefone']);
            $stmt->bindParam(':email', $_POST['email']);
            try {
                $stmt->execute();
                echo "<p class='success-msg'>Cliente Cadastrado com Sucesso!</p>";
            } catch (PDOException $e) {
                error_log("Erro ao Inserir Cliente:" . $e->getMessage());
                echo "<p class='error-msg'>Erro ao Cadasrar Cliente</p>";
            }
        }
        ?>
    </div>
</body>
</html>