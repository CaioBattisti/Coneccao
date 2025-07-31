<?php
require_once '../conexao2.php';
$conexao = conectadb();

$nome = "Caio Luiz Battisti";
$endereco = "Rua Olinda,144";
$telefone = "(47) 4364-4535";
$email = "CaioBattisti@gmail.com";

$stmt = $conexao->prepare("INSERT INTO cliente (nome, endereco, telefone, email) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nome, $endereco, $telefone, $email);

if ($stmt->execute()) {
    echo "Cliente adicionado com sucesso!";
} else {
    echo "Erro ao adicionar cliente:" . $stmt->error;
}

$stmt->close();
$conexao->close();
?>