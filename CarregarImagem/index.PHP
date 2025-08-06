<?php
// inclui o arquivo de conexão com o banco de dados
require_once 'conecta.PHP';

// Cria a consulta sql para selecionar os dados principais(sem a coluna imagem)
$querySelecao = "SELECT codigo, evento, descricao, nome_imagem, tamanho_imagem FROM tabela_imagens";

$resultado = mysqli_query($conexao, $querySelecao);

if(!$resultado){
    die("Erro na consulta: " . mysqli_error($conexao));
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Armazenando Imagens no BD MySQL</title>
</head>
<body>
    <h2>Selecione um novo arquivo de Imagem</h2>
    <form enctype="multipart/form-date" action="upload.PHP" METHOD="POST">
        <input type="hidden" name="MAX_FILE_SIZE" value="999999999">
        <input type="text" name="evento" placeholder="Nome do Evento">
        <input type="text" name="descricao" placeholder="Descrição">
        <input type="file" value="image">
        <input type="submit" name="Salvar">
    </from>
    <br>
    <table border="1">
        <tr>
            <td aling="center">Código</td>
            <td aling="center">Evento</td>
            <td aling="center">Nome da Imagem</td>
            <td aling="center">Tamanho</td>
            <td aling="center">Visualizar</td>
            <td aling="center">Excluir</td>
        </tr>
<?php
    while($arquivos = mysqli_fetch_array($resultado)) { ?>
       <tr>
            <td aling="center"><?php echo $arquivos['codigo'];?></td>
            <td aling="center"><?php echo $arquivos['evento'];?></td>
            <td aling="center"><?php echo $arquivos['descricao'];?></td>
            <td aling="center"><?php echo $arquivos['nome_imagem'];?></td>
            <td aling="center"><?php echo $arquivos['tamanho_imagem'];?></td>
            <td aling="center">
                <a href="ver_imagens.PHP?id=<?php echo $arquivos['codigo'];?>">Visualizar</a>
            </td>
            <td aling="center">
                <a href="excluir_imagem.PHP?id=<?php echo $arquivos['codigo'];?>">Excluir</a>
            </td>
        </tr>
   <?php } ?>
   </table>
</body>
</html>