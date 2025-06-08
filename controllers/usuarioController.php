<?php
namespace App\Controllers;

use App\Dal\UsuarioDAO;
use App\Models\Usuario;
require_once "./helpers/autoload.php";

$acao = $_GET['acao'] ?? '';

class UsuarioController
{
    public static function listar()
    {
        return UsuarioDAO::listar();
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
