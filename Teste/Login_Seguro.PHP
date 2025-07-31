<?php
// Configuração do banco de dados
$servidor ="localhost";
$usuario = "root";
$senha = "";
$banco = "Empresa_teste";
// Conexão usando MySQLi sem proteção contra SQL Injection
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// Verifica se a erro na conexao
if ($conexao->connect_error){
    die("Erro de conexão:".$conexao->connect_error);
}
// Captura os dados do formulário(Nome de usuário)
$nome = $_POST['nome'];

//Prepara a consulta SQL Segura
$stmt = $conexao->prepare("SELECT * FROM cliente_teste WHERE nome = ?");
$stmt->bind_param("s", $nome);
$stmt->execute();
$result = $stmt->get_result();