<?php
namespace App\Controllers;

use App\Dal\UsuarioDAO;
use App\Models\Usuario;
require_once "./helpers/autoload.php";

$acao = $_GET['acao'] ?? '';

class UsuarioController
{
    public static function login()
    {

        if (!isset($_COOKIE['usuario_logado'])) {
            setcookie('usuario_logado', '', 0, '/');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            try {

                $usuario = UsuarioDAO::buscarUsuarioPorEmail($email);

                if ($usuario && password_verify($senha, $usuario->getSenha())) {

                    setcookie('usuario_logado', $usuario->getId(), 0, '/');
                    header('Location: ?page=home');

                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    return true;
                }
            } catch (\Exception $e) {
                return false;
            }
        }

        return false;
    }

    public static function buscarPorId(int $id)
    {
        try {
            return UsuarioDAO::buscarPorId($id);
        } catch (\Exception $e) {
            return null;
        }
    }
    public static function listar()
    {
        try {
            return UsuarioDAO::listar();
        } catch (\Exception $e) {
            return [];
        }
    }

    public static function criar(array $dados)
    {
        $usuario = new Usuario(null, $dados['nome'], $dados['email'], $dados['senha']);
        try {
            UsuarioDAO::criar($usuario);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function editar(array $dados)
    {
        $usuario = new Usuario($dados['id'], $dados['nome'], $dados['email'], $dados['senha'] ?? null);
        try {
            UsuarioDAO::editar($usuario);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function excluir(int $id)
    {
        try {
            UsuarioDAO::excluir($id);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
?>