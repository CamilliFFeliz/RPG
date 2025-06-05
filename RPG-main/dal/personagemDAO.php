<?php
$host = '127.0.0.1';
$port = 3307;
$user = 'root';
$password = '';
$dbname = 'jogo_rpg';

$conn = new mysqli($host, $user, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}

function criarPersonagem($nome, $classe, $nivel, $usuario_id) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO personagem (nome, classe, nivel, usuario_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $nome, $classe, $nivel, $usuario_id);
    return $stmt->execute();
}

function listarPersonagens() {
    global $conn;
    $result = $conn->query("SELECT p.*, u.nome as nome_usuario FROM personagem p 
                            JOIN usuario u ON p.usuario_id = u.id");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function atualizarPersonagem($id, $nome, $classe, $nivel, $usuario_id) {
    global $conn;
    $stmt = $conn->prepare("UPDATE personagem SET nome = ?, classe = ?, nivel = ?, usuario_id = ? WHERE id = ?");
    $stmt->bind_param("ssiii", $nome, $classe, $nivel, $usuario_id, $id);
    return $stmt->execute();
}

function deletarPersonagem($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM personagem WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
?>
