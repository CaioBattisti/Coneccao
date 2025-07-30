<?php
    require_once '../conexao.php';

    $conexao = conectarBanco();

    // Obtendo O ID via GET
    $idCliente = $_GET['id_cliente'] ?? null;
    $cliente= null;
    $msgErro = "";
    // Função para buscar cliente por ID
    function buscarClientePorld($idCliente, $conexao){
        $stmt = $conexao->prepare("SELECT * FROM id_cliente, nome, endereco, telefone, 
                                   email FROM cliente WHERE id_cliente = :id");
        $stmt->bindParam(":id_cliente", $idCliente, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    // Se um ID foi enviado, busca o cliente no banco
    if ($idCliente && is_numeric($idCliente)){
        $cliente = buscarClientePorld($idCliente, $conexao);
        if (!$cliente){
            $msgErro = "Erro: Cliente não encontrado.";
        }
    } else {
        $msgErro = "Digite o ID do Cliente para Buscar os Dados.";
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Cliente</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function habilitarEdicao(campo){
ducument.getElementByid(campo).removeAttribute("readonly");
        }
    </script>
</head>
<body>
    <h2>Atualizar Cliente</h2>

    <!-- Exibe mensagem de erro, Exibe a mensagem e o campo de busca -->
    <php if ($msgErro): ?>
        <p style="color:red;"><?= htmlspecialchars($msgErro) ?></p>
        
        <form action="AtualizarCliente.PHP" method="GET">
            <label for="id">ID do Cliente:</label>
            <input type="number" id="id" name="id" required>
            <button type="submit">Buscar</button>
        </form>
    <?php else: ?>
</body>
</html>