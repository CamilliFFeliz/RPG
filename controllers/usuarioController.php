<?php
require_once '../dal/UsuarioDAO.php';
require_once '../models/Usuario.php';

class UsuarioController
{
    public function listar()
    {
        $usuarios = UsuarioDAO::listar();
        require_once '../views/usuarios/listar.php';
    }

    public function criar()
    {
        require_once '../views/usuarios/formulario.php';
    }

    public function salvar()
    {
        $usuario = new Usuario(
            null,
            $_POST['nome'],
            $_POST['email'],
            $_POST['senha']
        );
        UsuarioDAO::criar($usuario);
        header('Location: /RPG/login');
        exit();
    }

    public function deletar($id)
    {
        UsuarioDAO::deletar($id);
        header('Location: /RPG/usuarios/listar');
        exit();
    }
}