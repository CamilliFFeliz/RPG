<?php
namespace App\Controllers;

use App\Dal\UsuarioDAO;
use App\Models\Usuario;
require_once "./helpers/autoload.php";

abstract class UsuarioController
{
    public static function listar()
    {
        $usuarios = UsuarioDAO::listar();
        require_once '../views/usuarios/listar.php';
    }

    public static function criar()
    {
        $usuario = new Usuario(
            null,
            $_POST['nome'],
            $_POST['email'],
            $_POST['senha']
        );
        UsuarioDAO::criar($usuario);
        header('Location: /RPG/login');
    }

    public static function deletar($id)
    {
        UsuarioDAO::excluir($id);
        header('Location: /RPG/usuarios/listar');
    }
}