<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_clean(); // Limpa qualquer saida inesperada antes do header

// Inclui a conexão com o banco de dados
require_once 'conecta.PHP';
// Obtem o ID da URL, garantindo que seja um número inteiro
$id_imagem = isset($_GET['id'])? intval($_GET['id']) : 0;

// Cria a consulta para buscar a imagem no banco de dados
$querySelecionaPorCodigo = "SELECT imagem, tipo_imagem, FROM tabela_imagens WHERE codigo = ?";




?>