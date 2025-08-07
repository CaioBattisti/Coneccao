<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_clean(); // Limpa qualquer saida inesperada antes do header

// Inclui a conexão com o banco de dados
require_once 'conecta.PHP';
// Obtem o ID da URL, garantindo que seja um número inteiro
$id_imagem = isset($_GET['id'])? intval($_GET['id']) : 0;

// Cria a consulta para buscar a imagem no banco de dados
$querySelecionaPorCodigo = "SELECT imagem, tipo_imagem FROM tabela_imagens WHERE codigo = ?";

// Cria a segurança utilizando prepared statement para maior segurança
$stmt = $conexao->prepare($querySelecionaPorCodigo);
$stmt->bind_param("i", $id_imagem);
$stmt->execute();
$resultado = $stmt->get_result();

// Verificar se a imagem existe no banco de dados
if($resultado->num_rows > 0 ){
    $imagem = $resultado->fetch_object();

    //Define o tipo correto da imagem(fallback para JPEG caso esteja vazio)
    $tipoImagem = !empty($imagem->tipo_imagem)? $imagem->tipo_imagem : "image/jpeg";
    header("content-type:".$tipoImagem);

    // Exibe a imagem armazenada no banco de dados
        echo $imagem->imagem;
    } else {
        echo "Imagem não encontrada!";
}

// Fecha a consulta
$stmt->close();
?>