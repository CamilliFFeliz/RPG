<?php
// cadastro.php

session_start();
require_once __DIR__ . '/../models/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $senha_confirm = $_POST['senha_confirm'] ?? '';

    $errors = [];

    if (empty($nome)) {
        $errors[] = "O nome é obrigatório.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Informe um email válido.";
    }
    if (empty($senha)) {
        $errors[] = "A senha é obrigatória.";
    }
    if ($senha !== $senha_confirm) {
        $errors[] = "As senhas não coincidem.";
    }

    if (empty($errors)) {
        $created = criar($nome, $email, $senha);
        if ($created) {
            $_SESSION['success'] = "Usuário cadastrado com sucesso! Faça login.";
            header("Location: ?page=login");
            exit;
        } else {
            $errors[] = "Erro ao cadastrar usuário. Email já pode estar em uso.";
        }
    }
}
?>

<div class="container">
    <h1>Registrar</h1>

    <?php if (!empty($errors)): ?>
        <div class="errors">
            <ul>
                <?php foreach($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="?page=registrar">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($nome ?? '') ?>" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" required><br><br>

        <label for="senha">Senha:</label><br>
        <input type="password" id="senha" name="senha" required><br><br>

        <label for="senha_confirm">Confirme a senha:</label><br>
        <input type="password" id="senha_confirm" name="senha_confirm" required><br><br>

        <button type="submit">Registrar</button>
    </form>
</div>
