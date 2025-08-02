<?php
require 'conexao.php';

$conexao = conectarbanco();
$busca = $_GET['busca'] ?? '';

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pesquisar Cliente</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <h2>Pesquisar Cliente</h2>
        <form action="PesquisarCliente.PHP" method="GET">
            <label for="busca">Digite o ID ou Nome</label>
            <input type="text" id="busca" name="busca" required>
            <button type="submit">Pesquisar</button>
        </form>
        <?php
        if ($busca) {
            if (is_numeric($busca)) {
                $stmt = $conexao->prepare("SELECT id_cliente, nome, endereco, telefone, email FROM cliente WHERE id_cliente = :id");
                $stmt->bindParam(":id", $busca, PDO::PARAM_INT);
            } else {
                $stmt = $conexao->prepare("SELECT id_cliente, nome, endereco, telefone, email FROM cliente WHERE nome LIKE :nome");
                $buscaNome = "%$busca";
                $stmt->bindParam(":nome", $buscaNome, PDO::PARAM_STR);
            }

            $stmt->execute();
            $clientes = $stmt->fetchAll();

            if (!$clientes) {
                echo "<p class='error-msg'>Erro: Nenhum Cliente Encontrado.</p>";
            } else {
        ?>
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
                        <td><?php echo htmlspecialchars($cliente['id_cliente']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['nome']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['endereco']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['telefone']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['email']); ?></td>
                        <td>
                            <a href="AtualizarCliente.PHP?id_cliente=<?= $cliente['id_cliente'] ?>">Editar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php
            }
        }
        ?>
    </div>
</body>
</html>