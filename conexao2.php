<?php
// Habilita relatório de erros no MySQLI
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function conectadb(){
    $endereco = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "empresa";
try{
    $con = new mysqli($endereco, $usuario,$senha,$banco);

// Definição de conjunto de caracteres para evitar problemas de acentuação
    $con->set_charset("utf8mb4");
    return $con;
    }catch (Exception $e){
        die("Erro na conexao".$e->getMessage());
    }
}
?>