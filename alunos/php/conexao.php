<?php
$host = "localhost";
$user = "root";
$senha = "jdr2003@";
$dbname = "SISTEMAESCOLAR";
$port = 3306;

try {
    $conexao = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
}
?>
