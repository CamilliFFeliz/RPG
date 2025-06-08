<?php
class Personagem
{
    private ?int $id;
    private string $nome;
    private string $classe;
    private int $nivel;
    private int $usuarioId;
    private int $forca;
    private int $destreza;
    private int $constituicao;
    private int $inteligencia;
    private int $sagacidade;
    private int $carisma;

    public function __construct($id, $nome, $classe, $nivel, $usuarioId, $forca = 0, $destreza = 0, $constituicao = 0, $inteligencia = 0, $sagacidade = 0, $carisma = 0)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->classe = $classe;
        $this->nivel = $nivel;
        $this->usuarioId = $usuarioId;
        
        $this->forca = $forca;
        $this->destreza = $destreza;
        $this->constituicao = $constituicao;
        $this->inteligencia = $inteligencia;
        $this->sagacidade = $sagacidade;
        $this->carisma = $carisma;
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
    public function getForca() {
         return $this->forca; 
        }
    public function getDestreza() { 
        return $this->destreza; 
    }
    public function getConstituicao() { 
        return $this->constituicao; 
    }
    public function getInteligencia() { 
        return $this->inteligencia; 
    }
    public function getSagacidade() { 
        return $this->sagacidade; 
    }
    public function getCarisma() { 
        return $this->carisma; }
        

}
?>