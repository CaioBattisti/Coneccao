<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Funcionario</title>
    <link rel="stylesheet" href="style.CSS">
</head>
<body>
    <div class="container">
        <h1>Cadastro</h1>
        <h2>Funcionario</h2>
        <!-- Formulário para cadastrar funcionários -->
        <form action="salvar_funcionario.PHP" method="POST" enctype="multipart/form-data">
            <label for="name">Nome: </label>
            <input type="text" name="nome" id="nome" required>
            <br>

            <label for="telefone">Telefone: </label>
            <input type="text" name="telefone" id="telefone" required>
            <br>

            <label for="foto">Foto: </label>
            <input type="file" name="foto" id="foto" required>
            <br>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>