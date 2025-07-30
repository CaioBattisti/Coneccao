<?php
    require_once '../conexao.php';

    $conexao = conectarBanco();

    // Obtendo o ID via GET
    $idCliente = $_GET['id_cliente'] ?? null;
    $cliente = null;
    $msgErro = "";

    // Função para buscar cliente por ID
    function buscarClientePorld($idCliente, $conexao){
        $stmt = $conexao->prepare("SELECT * FROM cliente WHERE id_cliente = :id");
        $stmt->bindParam(":id", $idCliente, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
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
            document.getElementById(campo).removeAttribute("readonly");
        }
    </script>
</head>
<body>
<h2>Atualizar Cliente:</h2>

<!-- Exibe mensagem de erro, exibe a mensagem e o campo de busca -->
<?php if ($msgErro): ?>
    <p style="color:red;"><?= htmlspecialchars($msgErro) ?></p>
<?php endif; ?>

<form action="AtualizarCliente.PHP" method="GET">
    <label for="id">ID do Cliente:</label>
    <input type="text" name="id_cliente" id="id" value="<?= htmlspecialchars($idCliente) ?>">
    <button type="submit">Buscar</button>
</form>

<?php if ($cliente): ?>
    <form action="SalvarCliente.PHP" method="POST">
        <input type="hidden" name="id_cliente" value="<?= htmlspecialchars($cliente['id_cliente']) ?>">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" readonly>
        <button type="button" onclick="habilitarEdicao('nome')">Editar</button>
        <br>
        <label for="endereco">Endereço:</label>
        <input type="text" name="endereco" id="endereco" value="<?= htmlspecialchars($cliente['endereco']) ?>" readonly>
        <button type="button" onclick="habilitarEdicao('endereco')">Editar</button>
        <br>
        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" value="<?= htmlspecialchars($cliente['telefone']) ?>" readonly>
        <button type="button" onclick="habilitarEdicao('telefone')">Editar</button>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($cliente['email']) ?>" readonly>
        <button type="button" onclick="habilitarEdicao('email')">Editar</button>
        <br>
        <button type="submit">Salvar Alterações</button>
    </form>
<?php endif; ?>
</body>
</html>