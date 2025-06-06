<?php
$personagens = PersonagemDAO::listar(); // deve ser PersonagemController->listar()
?>

<h1>Lista de Personagens</h1>

<?php if (count($personagens) > 0): ?>
    <ul>
        <?php foreach ($personagens as $personagem): ?>
            <li><?= htmlspecialchars($personagem['nome']) ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Nenhum personagem cadastrado.</p>
<?php endif; ?>
