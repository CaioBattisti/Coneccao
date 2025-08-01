<?php
require_once '../conexao2.php';
$conexao = conectadb();

$nome = "Julia Silva";
$endereco = "Rua Kalamango,144";
$telefone = "(41) 5555-5555";
$email = "JuliaSilva@gmail.com";

$id_cliente = 1;

$stmt = $conexao->prepare("UPDATE clientes SET nome=?, endereco=?, telefone=?, email=? WHERE id_cliente=?");
$stmt->bind_param("ssssi", $nome, $endereco, $telefone, $email, $id_cliente);

if ($stmt->execute()){
    echo "Cliente Atualizado com Sucesso!";
}else{
    echo "Erro ao Atualizar Cliente:".$stmt->error;
}

$stmt->close();
$conexao->close();
?>