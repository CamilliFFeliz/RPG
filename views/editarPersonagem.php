<?php
namespace App\Views;

use App\Controllers\PersonagemController;
require_once "./helpers/autoload.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    PersonagemController::editar();
}
?>

<div class="container">
    <h2>Criar Novo Personagem</h2>

    <form method="POST" action="?page=editar_personagem">
        <input type="hidden" name="acao" value="criar">

        <label for="nome">Nome do personagem:</label>
        <input type="text" name="nome" required><br>

        <label for="classe">Classe:</label>
        <input type="text" name="classe" required><br>

        <label for="nivel">Nível:</label>
        <input type="number" name="nivel" value="1" required><br>

        <label for="forca">Força:</label>
        <input type="number" name="forca" value="10" required><br>

        <label for="destreza">Destreza:</label>
        <input type="number" name="destreza" value="10" required><br>

        <label for="constituicao">Constituição:</label>
        <input type="number" name="constituicao" value="10" required><br>

        <label for="inteligencia">Inteligência:</label>
        <input type="number" name="inteligencia" value="10" required><br>

        <label for="sagacidade">Sagacidade:</label>
        <input type="number" name="sagacidade" value="10" required><br>

        <label for="carisma">Carisma:</label>
        <input type="number" name="carisma" value="10" required><br>
        <button type="submit">Criar Personagem</button>
    </form>
</div>