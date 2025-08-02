<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Excluir Cliente</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <h2>Excluir Cliente:</h2>
        <form action="ProcessarDelecao.PHP" method="POST">
            <label for="id">ID do Cliente:</label>
            <input type="number" id="id" name="id" required>

            <button type="submit">Excluir Cliente</button>
        </form>
    </div>
</body>

</html>