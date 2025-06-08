<?php
namespace App\Views;


$nome_personagem = "Teste";
$nivel_personagem = 1;
$classe_personagem = "Guerreiro";

?>
<section>
    <div class="personagem-identificacao">
        <div class="nome-personagem">
            <h4><?php echo $nome_personagem ?></h4>
            <>Nome do personagem: </h1>

        </div>
    </div>
    <div class="personagem-classificacao">
        <div class="classe-personagem">
            <h4><?php echo $classe_personagem ?></h4>
            Classe do personagem
        </div>
        <div class="nivel-personagem">
            <h4><?php echo $nivel_personagem ?></h4>
            Nível do personagem
        </div>
        <div class="usuario-personagem">
            <h4><?php echo $nivel_personagem ?></h4>
            Nome do Jogador
        </div>

    </div>
</section>

<section id="personagem-atributos">
    <div class="atributo">
        <h3>Força</h3>
    </div>
    <div class="atributo">
        <h3>Destreza</h3>
    </div>
    <div class="atributo">
        <h3>Constituição</h3>
    </div>
    <div class="atributo">
        <h3>Inteligência</h3>
    </div>
    <div class="atributo">
        <h3>Sagacidade</h3>
    </div>
    <div class="atributo">
        <h3>Carisma</h3>
    </div>
    <div class="atributo">
        <h3>Força</h3>
    </div>
</section>