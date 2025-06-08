<!-- apenas o form, sem require do controller -->
<h2>Criar Novo Personagem</h2>

<form method="POST" action="controller/PersonagemController.php">
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

    <label for="usuario_id">ID do Usuário:</label>
    <input type="number" name="usuario_id" required><br>

    <button type="submit">Criar Personagem</button>
</form>
