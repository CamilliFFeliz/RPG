<?php
namespace App\Dal;

use PDO;
use PDOException;

abstract class Conn
{
    private static ?PDO $conn = null;
    private static string $host = '127.0.0.1';
    private static int $port = 3307;
    private static string $user = 'root';
    private static string $password = '';
    private static string $dbName = 'jogo_rpg';

    public static function getConn(): PDO
    {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO(
                    "mysql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbName,
                    self::$user,
                    self::$password,

                );
            } catch (PDOException $erro) {
                throw new PDOException(
                    "Erro ao conectar ao banco de dados: " . $erro->getMessage(),
                    (int) $erro->getCode()
                );
            }
        }

        return self::$conn;
    }
}