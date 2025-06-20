<?php
namespace App;
use App\Controllers\PersonagemController;
// Integrantes: Alana Cristina Martens - 38225221 | Camilli Frigeri Feliz - 37280571 | 
// Mariela Barbosa da Silva - 37953095 | Matheus Müller dos Santos - 83693500 | 
// Vitor Manoel Rodrigues Carvalho - 38724626 | Samantha de Souza Andrade - 37284886

$page = $_GET["page"] ?? "home";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Jogo RPG</title>
    <link rel="stylesheet" href="./assets/style.css" />
    <link rel="icon" href="./img/ICONEPAGINA.ico" type="image/x-icon" />
</head>

<body>
    <?php
    require_once "./includes/header.php";

    echo "<main>";

    require_once(match ($page) {
        "home" => "./views/home.php",
        "login" => "./views/login.php",
        "registrar" => "./views/cadastro.php",
        "personagens" => "./views/listaPersonagem.php",
        "criar_personagem" => "./views/personagemForm.php",
        "perfil_personagem" => "./views/perfilPersonagem.php",
        "editar_personagem" => "./views/editarPersonagem.php",
        "deletar_personagem" => "./views/deletarPersonagem.php",
        default => "./views/404.php",
    });

    echo "</main>";

    require_once "./includes/footer.php";
    ?>
</body>

</html>