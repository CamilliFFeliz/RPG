<?php
namespace App\Views;

use App\Controllers\PersonagemController;
use Exception;
require_once "./helpers/autoload.php";

$personagens = [];
try {
    $personagens = PersonagemController::listar();
} catch (Exception $e) {
    echo "Erro ao listar personagens: " . $e->getMessage();
}
?>

<div class="container">
    <h2>Lista de Personagens</h2>
</div>

<div class="personagem-lista">
    <?php if (count($personagens) > 0): ?>
        <ul>
            <?php foreach ($personagens as $personagem): ?>
                <li class="personagem-card">
                    <?php
                    $id = $personagem->getId();
                    $linkPerfil = "?page=perfil_personagem&personagem=$id";
                    $linkEditar = "?page=editar_personagem&id=$id";
                    $linkExcluir = "?page=deletar_personagem&id=$id";
                    ?>

                    <a href="<?= $linkPerfil ?>">
                        <?= htmlspecialchars($personagem->getNome()) ?>
                    </a>

                    <button class="btn btn-edit" onclick="location.href='<?= $linkEditar ?>'">Editar</button>

                    <button class="btn btn-delete" onclick="if(confirm('Tem certeza que deseja excluir este personagem?')) location.href='<?= $linkExcluir ?>'">Excluir</button>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Nenhum personagem cadastrado.</p>
    <?php endif; ?>
</div>

<button type="button" class="btn" onclick="location.href='?page=criar_personagem'">
    Criar Personagem
</button>
