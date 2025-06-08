<?php
require_once '../dal/PersonagemDAO.php';
require_once '../models/Personagem.php';

class PersonagemController
{
    public function listar()
    {
        $personagens = PersonagemDAO::listar();
        require_once '../views/personagens/listar.php';
    }

    public function criar()
    {
        require_once '../views/personagens/formulario.php';
    }

    public function salvar()
    {
        session_start();
        $personagem = new Personagem(
            null,
            $_POST['nome'],
            $_POST['classe'],
            $_POST['nivel'],
            $_SESSION['usuario_id']
        );
        PersonagemDAO::criar($personagem);
        header('Location: /RPG/personagens/listar');
        exit();
    }

    public function editar($id)
    {
        $personagem = PersonagemDAO::buscarPorId($id);
        require_once '../views/personagens/formulario.php';
    }

    public function atualizar($id)
    {
        $personagem = new Personagem(
            $id,
            $_POST['nome'],
            $_POST['classe'],
            $_POST['nivel'],
            null
        );
        PersonagemDAO::editar($personagem);
        header('Location: /RPG/personagens/listar');
        exit();
    }

    public function deletar($id)
    {
        PersonagemDAO::deletar($id);
        header('Location: /RPG/personagens/listar');
        exit();
    }
}