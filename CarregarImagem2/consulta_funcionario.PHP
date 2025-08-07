<?php
// configuração do banco de dados
$host = 'localhost';
$dbname = 'armazena_imagem';
$username = 'root';
$password = '';    

try{
    // Conexão com o banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Recupera todos os funcionários do banco de dados
    $sql = "SELECT id,nome FROM funcionarios";
    $stmt = $pdo->prepare(sql);
    $stmt->execute();
    $funcionarios = $stmt->fetchALL(PDO::FETCH_ASSOC); // Busca todos os resultados como uma matriz associativa

    // Verifica se foi solicitado a exclusão de um funcionário
    if(($_SERVER["REQUEST_METHOD"] == 'POST') && isset($_POST['excluir_id'])){
        $excluir_id = $_POST['excluir_id'];
        $sql_excluir = "DELETE FROM funcionarios WHERE id = :id";
        $stmt_excluir = $pdo->prepare($sql_excluir);
        $stmt_excluir->bindParam(':id',$excluir_id, PDO::PARAM_INT);
        $stmt_excluir->execute();

        // Redireciona para evitar reenvio do formulário
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
} catch(PDOException $e){
    echo "Erro: ".$e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    
</body>
</html>