<?php
namespace App\Views;

use App\Controllers\PersonagemController;
use App\Controllers\UsuarioController;
require_once "./helpers/autoload.php";

$id = (int) $_GET["personagem"];

$linkEditar = "?page=editar_personagem&personagem=$id";
$linkExcluir = "?page=deletar_personagem&personagem=$id";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id_personagem = (int) $_GET["personagem"];

    $personagem = PersonagemController::buscarPorId();
    $usuario = UsuarioController::buscarPorId($personagem->getId());
}
?>

<section class="personagem-card">
    <div class="personagem-identificacao">
        <div class="nome-personagem">
            <h4><?php echo $personagem->getNome() ?></h4>
            <p>Nome do personagem</p>
        </div>
    </div>

    <div class="personagem-classificacao">
        <div class="classe-personagem">
            <h4><?php echo $personagem->getClasse() ?></h4>
            <p>Classe do personagem</p>
        </div>
        <div class="nivel-personagem">
            <h4><?php echo $personagem->getNivel() ?></h4>
            <p>Nível do personagem</p>
        </div>
    </div>
</section>

<section id="personagem-atributos">
    <div class="atributo">
        <h3>Força: <?php echo $personagem->getForca(); ?></h3>
    </div>
    <div class="atributo">
        <h3>Destreza: <?php echo $personagem->getDestreza(); ?></h3>
    </div>
    <div class="atributo">
        <h3>Constituição: <?php echo $personagem->getConstituicao(); ?></h3>
    </div>
    <div class="atributo">
        <h3>Inteligência: <?php echo $personagem->getInteligencia(); ?></h3>
    </div>
    <div class="atributo">
        <h3>Sagacidade: <?php echo $personagem->getSagacidade(); ?></h3>
    </div>
    <div class="atributo">
        <h3>Carisma: <?php echo $personagem->getCarisma(); ?></h3>
    </div>
</section>

<button class="btn btn-edit" onclick="location.href='<?= $linkEditar ?>'">Editar</button>

<button class="btn btn-delete"
    onclick="if(confirm('Tem certeza que deseja excluir este personagem?')) location.href='<?= $linkExcluir ?>'">Excluir</button>