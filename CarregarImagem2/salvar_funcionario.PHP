<?php
// Função para dimensionar a imagem
function redimensionarImagem($imagem, $largura, $altura){
    // Obtem as dimensiões originais da imagem
    // getimagesize() Retorna a altura e a largura da imagem
    list($larguraOriginal, $alturaOriginal) = getimagesize($imagem);

    // Cria uma nova imagem em branco com as novas dimensões
    // imagecreatetruecolor() Cria uma nova imagem em branco com alta qualidade
    $novaImagem = imagecreatetruecolor($largura, $altura);

    // carrega a imagem original(jpeg) a partir do arquivo
    // imagecreatefromjpeg() Cria a imagem PHP a partir de um jpeg
    $imagem_original = imagecreatefromjpeg($imagem);

    // Copia e redimensiona a imagem original para a nova
    // imagecopyresampled() Copia e redimensionamento e suavização da imagem
    imagecopyresampled($novaImagem, $imagem_original, 0, 0, 0, 0, $largura, $altura, $larguraOriginal, $alturaOriginal);

    // Inicia um buffer para guardar a imagem como texto binário
    // ob_start() Inicia o "output buffering" guardando a saida
    ob_start();
    // Imagejpeg() envia a imagem para o output (que vai para o buffer)
    imagejpeg($novaImagem);

    // ob_get_clean() Pega o conteudo do buffer e limpa-lo
    $dadosImagem = ob_get_clean();

    // Libera a memória usada pelas imagens
    // imagedestroy() limpa a memória da imagem criada
    imagedestroy($novaImagem);
    imagedestroy($imagem_original);

    // retorna a imagem redimensionada em formato binário
    return $dadosImagem;
}
// configuração do banco de dados
$host 'localhost';
$dbname = 'armazena_imagem';
$username = 'root';
$password = '';

try{
    // Conexão com o banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_FILES['foto'])){
        if($_FILES['foto']['error'] == 0){
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $nomeFoto = $_FILES['foto']['name']; // Pega o nome original do arquivo
            $tipoFoto = $_FILES['foto']['type']; // pega o tipo mime da imagem

            // Redimensiona a imagem
            // O código abaixo cuja variavel tmp_name e o caminho temporário do arquivo
            $foto = redimensionarImagem($_FILES['foto']['tmp_name'], 300, 400);
            
            // Insere no banco de dados usando sql prepared
            $sql = "INSERT INTO funcionarios (Nome, telefone, nome_foto, tipo_foto, foto) 
                    VALUES (:nome, :telefone, :nome_foto, :tipo_foto, :foto)";
            $stmt = $pdo->prepare($sql); // Responsavel por preparear a query para evitar ataque sql injection
            $stmt->bindParam(':nome', $nome); // Liga os parametos as variaveis
            $stmt->bindParam(':telefone', $telefone); // Liga os parametos as variaveis
            $stmt->bindParam(':nome_foto', $nomeFoto); // Liga os parametos as variaveis
            $stmt->bindParam(':tipo_foto', $tipoFoto); // Liga os parametos as variaveis
            $stmt->bindParam(':foto', $foto, PDO::PARAM_LOB); // Liga os parametos as variaveis

            

            
            
        }



    }

}







?>