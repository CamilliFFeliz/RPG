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
            $nome = $_POST['nome'];
            $classe = $_POST['classe'];
            $nivel = $_POST['nivel'];
            $forca = $_POST['forca'];
            $destreza = $_POST['destreza'];
            $constituicao = $_POST['constituicao'];
            $inteligencia = $_POST['inteligencia'];
            $sagacidade = $_POST['sagacidade'];
            $carisma = $_POST['carisma'];
            $usuarioId = $_COOKIE['usuario_logado'];

            $params = [
                'nome' => $nome,
                'classe' => $classe,
                'nivel' => $nivel,
                'forca' => $forca,
                'destreza' => $destreza,
                'constituicao' => $constituicao,
                'inteligencia' => $inteligencia,
                'sagacidade' => $sagacidade,
                'carisma' => $carisma,
                'usuarioId' => $usuarioId
            ];

            // Validação de nulo ou vazio
            foreach ($params as $key => $value) {
                if (is_null($value) || $value === '') {
                    throw new Exception("O campo '{$key}' não pode ser nulo ou vazio.");
                }
            }

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

    public static function editar(int $id_personagem)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome = $_POST['nome'];
            $classe = $_POST['classe'];
            $nivel = $_POST['nivel'];
            $forca = $_POST['forca'];
            $destreza = $_POST['destreza'];
            $constituicao = $_POST['constituicao'];
            $inteligencia = $_POST['inteligencia'];
            $sagacidade = $_POST['sagacidade'];
            $carisma = $_POST['carisma'];
            $usuarioId = $_COOKIE['usuario_logado'];

            $params = [
                'nome' => $nome,
                'classe' => $classe,
                'nivel' => $nivel,
                'forca' => $forca,
                'destreza' => $destreza,
                'constituicao' => $constituicao,
                'inteligencia' => $inteligencia,
                'sagacidade' => $sagacidade,
                'carisma' => $carisma,
                'usuarioId' => $usuarioId
            ];

            // Validação de nulo ou vazio
            foreach ($params as $key => $value) {
                if (is_null($value) || $value === '') {
                    throw new Exception("O campo '{$key}' não pode ser nulo ou vazio.");
                }
            }

            try {
                $personagem = new Personagem(
                    $id_personagem,
                    $nome,
                    $classe,
                    (int) $nivel,
                    (int) $usuarioId,
                    (int) $forca,
                    (int) $destreza,
                    (int) $constituicao,
                    (int) $inteligencia,
                    (int) $sagacidade,
                    (int) $carisma
                );

                PersonagemDAO::editar($personagem);
                header('Location: ?page=personagens');
                exit();
            } catch (Exception $e) {
                throw new Exception("Erro ao editar personagem: " . $e->getMessage());
            }
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
