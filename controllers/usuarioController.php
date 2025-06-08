<?php
namespace App\Controllers;

use App\Dal\UsuarioDAO;
use App\Models\Usuario;
require_once "./helpers/autoload.php";

$acao = $_GET['acao'] ?? '';


switch ($acao) {
    case 'listar':
        $usuarios = UsuarioDAO::listar();
        break;

    case 'criar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';
            if (UsuarioDAO::criar($nome, $email, $senha)) {
                header('Location: ?page=usuarios&acao=listar');
                exit;
            } else {
                $erro = "Erro ao criar usuário.";
            }
        }
        break;

    case 'atualizar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? 0;
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? null; 
            if (UsuarioDAO::editar($id, $nome, $email, $senha)) {
                header('Location: ?page=usuarios&acao=listar');
                exit;
            } else {
                $erro = "Erro ao atualizar usuário.";
            }
        }
        break;

    case 'deletar':
        $id = $_GET['id'] ?? 0;
        if ($id && UsuarioDAO::excluir($id)) {
            header('Location: ?page=usuarios&acao=listar');
            exit;
        } else {
            $erro = "Erro ao deletar usuário.";
        }
        break;

    default:
        $usuarios = UsuarioDAO::listar();
        break;
}
?>
