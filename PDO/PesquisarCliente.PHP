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
