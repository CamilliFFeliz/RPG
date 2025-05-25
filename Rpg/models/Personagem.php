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

// Criar personagem vinculado a um usuário
function criarPersonagem($nome, $classe, $nivel, $usuario_id) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO personagens (nome, classe, nivel, usuario_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $nome, $classe, $nivel, $usuario_id);
    return $stmt->execute();
}

// Listar personagens
function listarPersonagens() {
    global $conn;
    $result = $conn->query("SELECT p.*, u.nome as nome_usuario FROM personagens p 
                            JOIN usuarios u ON p.usuario_id = u.id");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Atualizar personagem
function atualizarPersonagem($id, $nome, $classe, $nivel, $usuario_id) {
    global $conn;
    $stmt = $conn->prepare("UPDATE personagens SET nome = ?, classe = ?, nivel = ?, usuario_id = ? WHERE id = ?");
    $stmt->bind_param("ssiii", $nome, $classe, $nivel, $usuario_id, $id);
    return $stmt->execute();
}

// Deletar personagem
function deletarPersonagem($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM personagens WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
?>
