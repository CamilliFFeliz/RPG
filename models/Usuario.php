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

// Criar usuário com senha (hash)
function criarUsuario($nome, $email, $senha) {
    global $conn;
    $hash = password_hash($senha, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $hash);
    return $stmt->execute();
}

// Buscar usuário pelo email
function buscarUsuarioPorEmail($email) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Atualizar usuário (nome, email, senha opcional)
function atualizarUsuario($id, $nome, $email, $senha = null) {
    global $conn;
    if ($senha) {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?");
        $stmt->bind_param("sssi", $nome, $email, $hash, $id);
    } else {
        $stmt = $conn->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $nome, $email, $id);
    }
    return $stmt->execute();
}

// Deletar usuário
function deletarUsuario($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

// Listar todos usuários
function listarUsuarios() {
    global $conn;
    $result = $conn->query("SELECT id, nome, email FROM usuarios"); // NÃO retornar senha aqui
    return $result->fetch_all(MYSQLI_ASSOC);
}
?>
