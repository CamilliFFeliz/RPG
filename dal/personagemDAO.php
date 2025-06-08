<?php
namespace App\Dal;
use App\Models\Personagem;
use Exception;
use PDO;
use PDOException;
abstract class PersonagemDAO
{
    public static function criar(Personagem $personagem)
    {
        try {

            $conn = Conn::getConn();
            $stmt = $conn->prepare(
                "INSERT INTO personagem (nome, classe, nivel, usuario_id) 
                VALUES (?, ?, ?, ?);
            "
            );
            $stmt->execute(array(
                $personagem->getNome(),
                $personagem->getClasse(),
                $personagem->getNivel(),
                $personagem->getUsuarioId(),
            ));
        } catch (PDOException $e) {
            throw new Exception("\n-- Erro ao criar personagem: \n" . $e->getMessage());
        }

        return;
    }

    public static function listar()
    {

        try {

            $conn = Conn::getConn();
            $stmt = $conn->query(
                "SELECT id, nome, classe, nivel, usuario_id 
                FROM personagem;
                "
            );

            $stmt->execute();
            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("\n-- Erro ao listar personagens: \n" . $e->getMessage());
        }

        $personagens = [];
        foreach ($dados as $key => $value) {
            $personagens[] = new Personagem(
                $value['id'],
                $value['nome'],
                $value['classe'],
                $value['nivel'],
                $value['usuario_id'],
            );

        }

        return $personagens;
    }

    public static function listarPorUsuarioId(int $usuarioId)
    {
        try {

            $conn = Conn::getConn();
            $stmt = $conn->prepare(
                "SELECT nome, classe, nivel, usuario_id
                FROM personagem
                WHERE usuario_id = ?;
                "
            );

            $stmt->execute(array($usuarioId));
            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("\n-- Erro ao listar personagens por usuário: \n" . $e->getMessage());
        }

        $personagens = [];
        foreach ($dados as $key => $value) {
            $personagens[] = new Personagem(
                $value['id'],
                $value['nome'],
                $value['classe'],
                $value['nivel'],
                $value['usuario_id'],
            );

        }

        return $personagens;
    }

    public static function buscarPorId(int $id)
    {

        try {

            $conn = Conn::getConn();
            $stmt = $conn->prepare(
                "SELECT nome, classe, nivel, usuario_id
                FROM personagem
                WHERE id = ?;
                "
            );

            $stmt->execute(array($id));
            $dados = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$dados) {
                throw new Exception("\n-- Personagem não encontrado com o ID: $id");
            }

        } catch (PDOException $e) {
            throw new Exception("\n-- Erro ao buscar personagem por ID: \n" . $e->getMessage());
        }

        return new Personagem(
            $dados['id'],
            $dados['nome'],
            $dados['classe'],
            $dados['nivel'],
            $dados['usuario_id']
        );
    }

    public static function editar(Personagem $personagem)
    {
        $params = [];
        $campos = [];

        if ($personagem->getNome()) {
            $campos[] = "nome = ?";
            $params[] = $personagem->getNome();
        }
        if ($personagem->getClasse()) {
            $campos[] = "classe = ?";
            $params[] = $personagem->getClasse();
        }
        if ($personagem->getNivel()) {
            $campos[] = "nivel = ?";
            $params[] = $personagem->getNivel();
        }

        $query = "UPDATE personagem SET " . implode(", ", $params) . " WHERE id = ?;";

        if (empty($campos)) {
            throw new Exception("Não há campos para atualizar.");
        }
        $params[] = $personagem->getId();

        try {

            $conn = Conn::getConn();
            $stmt = $conn->prepare($query);
            $stmt->execute($params);
        } catch (PDOException $e) {
            throw new Exception("\n-- Erro ao editar personagem: \n" . $e->getMessage());
        }


        return;

    }

    public static function deletar(int $id)
    {
        try {

            $conn = Conn::getConn();
            $stmt = $conn->prepare(
                "DELETE FROM personagem
                WHERE id = ?;
                "
            );

            $stmt->execute(array($id));
        } catch (PDOException $e) {
            throw new Exception("\n-- Erro ao deletar personagem: \n" . $e->getMessage());
        }

        return;
    }

}
?>