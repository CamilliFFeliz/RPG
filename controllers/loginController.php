<?php
namespace App\Controllers;
require_once "./helpers/autoload.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $usuario = buscarUsuarioPorEmail($email);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        // Login OK
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nome' => $usuario['nome'],
            'email' => $usuario['email']
        ];
        header('Location: ?page=home');
        exit;
    } else {
        $erro = "Email ou senha inválidos.";
    }
}
?>
