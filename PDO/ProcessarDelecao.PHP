<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Processar Deleção</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <?php
        require 'conexao.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $conexao = conectarBanco();

            $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

            if (!$id) {
                echo "<p class='error-msg'>Erro: ID Inválido.</p>";
                exit;
            }
            $sql = "DELETE FROM cliente WHERE id_cliente = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            try {
                $stmt->execute();
                echo "<p class='success-msg'>Cliente Excluído com Sucesso!</p>";
            } catch (PDOException $e) {
                error_log("Erro ao Excluir o Cliente:" . $e->getMessage());
                echo "<p class='error-msg'>Erro ao Excluir Registro.</p>";
            }
        }
        ?>
    </div>
</body>
</html>