<?php
namespace App\Dal;

use App\Models\Usuario;
use Exception;
use PDO;
use PDOException;

require_once "./helpers/autoload.php";

abstract class UsuarioDAO
{
    public static function criar(Usuario $usuario)
    {

        try {
            $conn = Conn::getConn();
            $stmt = $conn->prepare(
                "INSERT INTO usuarios (nome, email, senha) 
                VALUES (?, ?, ?);
                "
            );

            $stmt->execute(array(
                $usuario->getNome(),
                $usuario->getEmail(),
                $usuario->getSenha(),
            ));
        } catch (PDOException $e) {
            throw new Exception("\n-- Erro ao criar usuario: \n" . $e->getMessage());
        }

        return;
    }

    public static function listar(): array
    {

        try {

            $conn = Conn::getConn();
            $stmt = $conn->query(
                "SELECT id, nome, email
                FROM usuarios;
                "
            );

            $stmt->execute();
            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("\n-- Erro ao listar usuarios: \n" . $e->getMessage());
        }

        return $dados;
    }

    public static function buscarPorId($id): Usuario
    {

        try {
            $conn = Conn::getConn();
            $stmt = $conn->prepare(
                "SELECT id, nome, email
                FROM usuarios
                WHERE id = ?;
                "
            );

            $stmt->execute(array($id));
            $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("\n-- Erro ao buscar usuario por ID: \n" . $e->getMessage());
        }

        if ($dados) {
            return new Usuario($dados['id'], $dados['nome'], $dados['email'], null);
        } else {
            return null;
        }
    }
        public static function buscarUsuarioPorEmail($email): Usuario|null
    {

        try {
            $conn = Conn::getConn();
            $stmt = $conn->prepare(
                "SELECT id, nome, email
                FROM usuarios
                WHERE email = ?;
                "
            );

            $stmt->execute(array($email));
            $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("\n-- Erro ao buscar usuario por Email: \n" . $e->getMessage());
        }

        if ($dados) {
            return new Usuario($dados['id'], $dados['nome'], $dados['email'], null);
        } else {
            return null;
        }
    }

    public static function editar(Usuario $usuario)
    {
        $fields = [];
        $params = [];

        if (!empty($usuario->getNome())) {
            $fields[] = "nome = ?";
            $params[] = $usuario->getNome();
        }
        if (!empty($usuario->getEmail())) {
            $fields[] = "email = ?";
            $params[] = $usuario->getEmail();
        }
        if (!empty($usuario->getSenha())) {
            $fields[] = "senha = ?";
            $params[] = $usuario->getSenha();
        }

        if (empty($fields)) {
            throw new Exception("Não há campos para atualizar.");
        }

        $query = "UPDATE usuario SET " . implode(", ", $fields) . " WHERE id = ?;";
        $params[] = $usuario->getId();

        try {
            $conn = Conn::getConn();
            $stmt = $conn->prepare($query);
            $stmt->execute($params);
        } catch (PDOException $e) {
            throw new Exception("\n-- Erro ao editar usuario: \n" . $e->getMessage());
        }

        return;
    }

    public static function excluir($id)
    {
        try {

            $conn = Conn::getConn();
            $stmt = $conn->prepare(
                "DELETE FROM usuario
                WHERE id = ?;
                "
            );
        } catch (PDOException $e) {
            throw new Exception("\n-- Erro ao excluir usuario: \n" . $e->getMessage());
        }

        $stmt->execute(array($id));

        return;
    }

}