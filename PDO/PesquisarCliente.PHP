<?php
require '../conexao.php';

$conexao = conectarbanco();
$busca = $_GET['busca'] ?? '';
if (!$busca) {
?>
    <form action="PesquisarCliente.PHP" method="GET">
        <label for="busca">Digite o ID ou Nome</label>
        <input type="text" id="busca" name="busca" required>
        <button type="submit">Pesquisar</button>
    </form>
<?php
    exit;
}
//Escolher entre busca por ID ou Nome e faz a consulta diretamente
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
    die("Erro: Nenhum Cliente Encontrado.");
}
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
                <a href="AtualizarCliente.PHP?id=<?= $cliente['id_cliente'] ?>">Editar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>