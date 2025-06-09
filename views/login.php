<?php
namespace App\Views;

use App\Controllers\UsuarioController;
require_once "./helpers/autoload.php";

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    $errors = [];

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Informe um email válido.";
    }
    if (empty($senha)) {
        $errors[] = "A senha é obrigatória.";
    }

    if (empty($errors)) {
        UsuarioController::login();
    }
}
?>

<div class="container">
    <h1>Login</h1>

    <?php if (!empty($errors)): ?>
        <div class="errors">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="?page=login">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" required><br><br>

        <label for="senha">Senha:</label><br>
        <input type="password" id="senha" name="senha" required><br><br>

        <button type="submit">Entrar</button>
    </form>

    <p>Não tem uma conta? <a href="?page=registrar">Registre-se</a></p>
</div>