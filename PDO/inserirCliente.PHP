<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Cadastro de Clientes</h2>
    <form action="ProcessarInsercao.PHP" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br/>
        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required>
        <br/>
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required>
        <br/>
        <label for="email">E-mail:</label>
        <input type="text" id="email" name="email" required>
        <br/>

        <button type="submit">Cadastrar Cliente</button>
    </form>
</body>
</html>