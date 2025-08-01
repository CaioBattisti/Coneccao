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
        die("Erro: Dados inválidos ou incompletos.");
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
        echo "Cliente Atualizado com Sucesso!";
    } catch (PDOException $e) {
        // Log do erro e mensagem amigável
        error_log("Erro ao Atualizar o Cliente: " . $e->getMessage());
        echo "Erro ao Atualizar Registro.";
    }
}
