<?php
namespace App\Controllers;

use App\Dal\PersonagemDAO;
use App\Models\Personagem;
use Exception;
require_once "./helpers/autoload.php";

abstract class PersonagemController
{
    public static function criar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $classe = $_POST['classe'] ?? '';
            $nivel = $_POST['nivel'] ?? 1;

            $forca = $_POST['forca'] ?? 0;
            $destreza = $_POST['destreza'] ?? 0;
            $constituicao = $_POST['constituicao'] ?? 0;
            $inteligencia = $_POST['inteligencia'] ?? 0;
            $sagacidade = $_POST['sagacidade'] ?? 0;
            $carisma = $_POST['carisma'] ?? 0;
            $usuarioId = $_COOKIE['usuario_logado'] ?? 0;

            $personagem = new Personagem(
                null,
                $nome,
                $classe,
                (int) $nivel,
                (int) $usuarioId,
                (int) $forca,
                (int) $destreza,
                (int) $constituicao,
                (int) $inteligencia,
                (int) $sagacidade,
                (int) $carisma,

            );

            try {

                PersonagemDAO::criar($personagem);
                header('Location: ?page=personagens');
                exit();
            } catch (Exception $e) {
                echo "Erro ao criar personagem: " . $e->getMessage();
                throw new Exception("Erro ao criar personagem: " . $e->getMessage());
            }
        }
    }

    /**
     * @return Personagem[]
     */
    public static function listar(): array
    {
        try {
            return PersonagemDAO::listar();
        } catch (Exception $e) {
            throw new Exception("Erro ao listar personagens: " . $e->getMessage());
        }
    }

    public static function buscarPorId()
    {
        $id_personagem = $_GET["personagem"];

        try {
            return PersonagemDAO::buscarPorId($id_personagem);
        } catch (Exception $e) {
            throw new Exception("Erro ao buscar personagem: " . $e->getMessage());
        }
    }

    public static function deletar(): void
    {
        $id = $_GET['id'];

        if ($id) {
            try {
                PersonagemDAO::deletar((int) $id);
                header('Location: ?page=personagens');
            } catch (Exception $e) {
                throw new Exception("Erro ao deletar personagem: " . $e->getMessage());
            }
        } else {
            throw new Exception("ID não informado.");
        }
    }
}
