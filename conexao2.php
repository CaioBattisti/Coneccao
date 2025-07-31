<?php
// Definição das credenciais de acesso ao banco de dados
$nomeservidor = "localhost";
$usuario = "root";
$senha = "";
$bancodedados = "empresa";

// Criação da conexão com MySQLI
$conn = mysqli_connect($nomeservidor, $usuario, $senha, $bancodedados);

// Verificação da conexão
if (!$conn){ //caso a conexão falhe, interrompendo o script e exibe a mensagem de erro
    die("Conexão falhou:".mysqli_connect_error());}

// Configuração do conjunto de caracteres para evitar problemas de acentuação
mysqli_set_charset($conn, "utf8mb4");

// Mensagem indicando que a conexão foi estabelecida com corretamente
echo "Conexão estabelecida com sucesso!<br>";

// Consulta SQL para obter clientes
$sql = "SELECT id_cliente, nome, email FROM cliente";
$result = mysqli_query($conn, $sql);

// Verifica se há resultados na consulta
if (mysqli_num_rows($result) > 0) {
// Intera sobre os resultados e exibe os dados
    while ($linha = mysqli_fetch_assoc($result)) {
        echo "ID: ".$linha["id_cliente"]."- Nome:".$linha["nome"]."- Email:".$linha["email"]."<br/>"; }
} else {
    echo "Nenhum Resultado Encontrado.";}

// Fecha a conexão com o banco de dados
mysqli_close($conn);
?>