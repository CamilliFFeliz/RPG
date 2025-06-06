<?php
require_once 'personagemDAO.php';

class Personagem
{
    private ?int $id;
    private string $nome;
    private string $classe;
    private int $nivel;
    private int $usuarioId;

    public function __construct($id, $nome, $classe, $nivel, $usuarioId)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->classe = $classe;
        $this->nivel = $nivel;
        $this->usuarioId = $usuarioId;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getClasse()
    {
        return $this->classe;
    }

    public function setClasse($classe)
    {
        $this->classe = $classe;
    }

    public function getNivel()
    {
        return $this->nivel;
    }

    public function setNivel($nivel)
    {
        $this->nivel = $nivel;
    }

    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    public function setUsuarioId($usuarioId)
    {
        $this->usuarioId = $usuarioId;
    }

}
?>