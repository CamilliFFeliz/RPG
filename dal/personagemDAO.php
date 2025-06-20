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
                "INSERT INTO personagem (nome, classe, nivel, usuario_id, constituicao, forca, destreza, inteligencia, sagacidade, carisma) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);
            "
            );
            $stmt->execute(array(
                $personagem->getNome(),
                $personagem->getClasse(),
                $personagem->getNivel(),
                $personagem->getUsuarioId(),
                $personagem->getConstituicao(),
                $personagem->getForca(),
                $personagem->getDestreza(),
                $personagem->getInteligencia(),
                $personagem->getSagacidade(),
                $personagem->getCarisma(),
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
                "SELECT id, nome, classe, nivel, usuario_id, forca, destreza, constituicao, inteligencia, sagacidade, carisma
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
                $value['forca'],
                $value['destreza'],
                $value['constituicao'],
                $value['inteligencia'],
                $value['sagacidade'],
                $value['carisma']
            );

        }

        return $personagens;
    }

    public static function listarPorUsuarioId(int $usuarioId)
    {
        try {

            $conn = Conn::getConn();
            $stmt = $conn->prepare(
                "SELECT id, nome, classe, nivel, usuario_id, forca, destreza, constituicao, inteligencia, sagacidade, carisma
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
                $value['forca'],
                $value['destreza'],
                $value['constituicao'],
                $value['inteligencia'],
                $value['sagacidade'],
                $value['carisma']
            );

        }

        return $personagens;
    }

    public static function buscarPorId(int $id)
    {

        try {

            $conn = Conn::getConn();
            $stmt = $conn->prepare(
                "SELECT id, nome, classe, nivel, usuario_id, forca, destreza, constituicao, inteligencia, sagacidade, carisma
                FROM personagem
                WHERE id = ?;
                "
            );

            $stmt->execute(array($id));
            $dados = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$dados) {
                throw new Exception("\n-- Personagem não encontrado com o ID: $id");
            }

            return new Personagem(
                $dados['id'],
                $dados['nome'],
                $dados['classe'],
                $dados['nivel'],
                $dados['usuario_id'],
                $dados['forca'],
                $dados['destreza'],
                $dados['constituicao'],
                $dados['inteligencia'],
                $dados['sagacidade'],
                $dados['carisma']
            );
        } catch (PDOException $e) {
            throw new Exception("\n-- Erro ao buscar personagem por ID: \n" . $e->getMessage());
        }

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
        if ($personagem->getForca()) {
            $campos[] = "forca = ?";
            $params[] = $personagem->getForca();
        }
        if ($personagem->getDestreza()) {
            $campos[] = "destreza = ?";
            $params[] = $personagem->getDestreza();
        }
        if ($personagem->getConstituicao()) {
            $campos[] = "constituicao = ?";
            $params[] = $personagem->getConstituicao();
        }
        if ($personagem->getInteligencia()) {
            $campos[] = "inteligencia = ?";
            $params[] = $personagem->getInteligencia();
        }
        if ($personagem->getSagacidade()) {
            $campos[] = "sagacidade = ?";
            $params[] = $personagem->getSagacidade();
        }
        if ($personagem->getCarisma()) {
            $campos[] = "carisma = ?";
            $params[] = $personagem->getCarisma();
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