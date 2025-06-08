<?php
$personagens = PersonagemDAO::listar(); 
?>

<div class="container">
    <h1>Lista de Personagens</h1>

    <?php if (count($personagens) > 0): ?>
        <ul class="personagem-lista">
            <?php foreach ($personagens as $personagem): ?>
                <li class="personagem-card"><?= htmlspecialchars($personagem['nome']) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Nenhum personagem cadastrado.</p>
    <?php endif; ?>
</div>
