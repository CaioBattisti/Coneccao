<?php
//Configuração do Banco de Dados
$servidor ="localhost";
$usuario = "root";
$senha = "";
$banco = "Enpresa_teste";
// Conexão usando MySQLi sem proteção contra SQL Injection
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// Verifica se a erro na conexao
if ($conexao->connect_error){
    die("Erro de conexão:".$conexao->connect_error);
}
// Captura os dados do formulário(Nome de usuário)
$usuario = $_POST['nome'];

// Execute a consulta SEM proteção contra SQL Injection
$sql = "SELECT * FROM cliente_teste WHERE nome = '$nome'";
$result=$conexao->query($sql);