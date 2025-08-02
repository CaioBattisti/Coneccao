<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Processar Atualização</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <?php
        require 'conexao.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $conexao = conectarBanco();

            // Sanitização e validação dos dados recebidos
            $id = filter_var($_POST['id_cliente'], FILTER_SANITIZE_NUMBER_INT);
            $nome = htmlspecialchars(trim($_POST['nome']));
            $endereco = htmlspecialchars(trim($_POST['endereco']));
            $telefone = htmlspecialchars(trim($_POST['telefone']));
            $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);

            // Verificação de dados obrigatórios
            if (!$id || !$nome || !$endereco || !$telefone || !$email) {
                echo "<p class='error-msg'>Erro: Dados inválidos ou incompletos.</p>";
                exit;
            }

            // Query SQL corrigida
            $sql = "UPDATE cliente SET nome = :nome, endereco = :endereco, telefone = :telefone, email = :email WHERE id_cliente = :id";

            $stmt = $conexao->prepare($sql);

            // Bind dos parâmetros
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':endereco', $endereco, PDO::PARAM_STR);
            $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            try {
                // Execução da query
                $stmt->execute();
                echo "<p class='success-msg'>Cliente Atualizado com Sucesso!</p>";
            } catch (PDOException $e) {
                // Log do erro e mensagem amigável
                error_log("Erro ao Atualizar o Cliente: " . $e->getMessage());
                echo "<p class='error-msg'>Erro ao Atualizar Registro.</p>";
            }
        }
        ?>
    </div>
</body>
</html>