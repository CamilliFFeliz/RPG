<?php
$host = '127.0.0.1';
$port = 3307;
$user = 'root';
$password = '';
$dbname = 'jogo_rpg';

$conn = new mysqli($host, $user, $password, $dbname, port: $port);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

?>
