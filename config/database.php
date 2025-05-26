<?php
// Configurações do banco de dados
$host = '127.0.0.1';
$port = 3307;
$user = 'root';
$password = '';
$dbname = 'jogo_rpg';

// Criar conexão
$conn = new mysqli($host, $user, $password, $dbname, $port);

// Checar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Aqui a conexão está pronta para ser usada

?>
