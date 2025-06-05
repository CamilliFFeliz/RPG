-- Arquivo somente para criar o banco de dados num novo computador

CREATE DATABASE IF NOT EXISTS jogo_rpg;
USE jogo_rpg;

-- Usuário
CREATE TABLE usuario (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(40) NOT NULL,
    email VARCHAR(256) NOT NULL UNIQUE,
    senha VARCHAR(10) NOT NULL
);

-- Personagem
CREATE TABLE personagem (
    id INT NOT NULL PRIMARY KEY,
    nome VARCHAR(40) NOT NULL,
    classe VARCHAR(15) NOT NULL,
    nivel INT NOT NULL DEFAULT 0,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id)
    );