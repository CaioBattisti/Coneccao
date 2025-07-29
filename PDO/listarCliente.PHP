<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title></title>
</head>
<body>
    <?php
    require_once 'conexao.php'; 

    $conexao = conectarBanco();
    $stmt = $conexao->prepare("SELECT * FROM cliente");
    $stmt->execute();
    $clientes = $stmt->fetchAll();
    ?>
</body>
</html>