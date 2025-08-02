<?php
require 'conexao.php';

$conexao = conectarBanco();

// Consulta todos os clientes do banco
$sql = "SELECT id_cliente, nome, endereco, telefone, email FROM cliente ORDER BY nome ASC";
$stmt = $conexao->prepare($sql);
$stmt->execute();
$clientes = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Buscar Cliente Ascendente</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <h2>Todos os Clientes Cadastrados:</h2>

        <?php if (!$clientes): ?>
            <p class="error-msg">Nenhum cliente encontrado.</p>
        <?php else: ?>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Ação</th>
                </tr>
                <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?= htmlspecialchars($cliente['id_cliente']) ?></td>
                    <td><?= htmlspecialchars($cliente['nome']) ?></td>
                    <td><?= htmlspecialchars($cliente['endereco']) ?></td>
                    <td><?= htmlspecialchars($cliente['telefone']) ?></td>
                    <td><?= htmlspecialchars($cliente['email']) ?></td>
                    <td>
                        <a href="AtualizarCliente.php?id_cliente=<?= $cliente['id_cliente'] ?>">Editar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>