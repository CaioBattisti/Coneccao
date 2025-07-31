<?php
require_once '../conexao2.php';

$conexao = conectadb();
$sql = "SELECT id_cleinte, nome, email FROM cliente";
$result = $conexao->query($sql);


?>