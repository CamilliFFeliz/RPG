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

<h1>Lista de Personagens</h1>

<?php if (count($personagens) > 0): ?>
    <ul>
        <?php foreach ($personagens as $personagem): ?>
            <li><?= htmlspecialchars($personagem->getNome()) ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <div class="container">
        Nenhum personagem cadastrado.
    </div>
<?php endif; ?>

    <button type="button" onclick="location.href='?page=criarperso'">
        Criar Personagem
    </button>