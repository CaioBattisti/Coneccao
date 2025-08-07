<?php
require_once 'conecta.PHP';

// Obtem o id via get garantindo que seja um número inteiro
$id_imagem = isset($_GET['id'])? intval($_GET['id']) : 0;

// verifica se o id é valido(maior que zero)
if($id_imagem > 0){

    // Cria uma query segura usando prepared statement
    $queryExclusao = "DELETE FROM tabela_imagens WHERE codigo = ?";

    // Prepare a query
    $stmt = $conexao->prepare($queryExclusao);
    $stmt->bind_param("i", $id_imagem); // Define o id como um inteiro

    // Executa a Exclusão
    if($stmt->execute()){
        echo "Imagem excluída com sucesso!";
    }else{
        die("Erro ao excluir imagem: ".$stmt->error);
    }
// Fecha a consulta
$stmt->close();

}else{
    echo "Id Invalido!";
}

// Redireciona para a index.PHP e garante que o script pare
header("Location: index.PHP");
exit();
?>