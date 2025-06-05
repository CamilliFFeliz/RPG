<?php
// listar_personagem.php

// 1. Conectar ao banco de dados
$host = '127.0.0.1';
$port = 3307;
$dbname = 'jogo_rpg';
$username = 'root';
$password = '';

try { 
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // 2. Buscar os personagem no banco de dados
    $stmt = $conn->query("SELECT nome FROM personagem");
    $personagem = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>


<h1>Lista de Personagens</h1>

<?php if (count($personagem) > 0): ?>
    <ul>
        <?php foreach ($personagens as $personagem): ?>
            <li><?= htmlspecialchars($personagem['nome']) ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Nenhum personagem cadastrado.</p>
<?php endif; ?>
