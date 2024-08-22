<?php
namespace Model;

class Autor {
    private $id;
    private $nome;
    private $nacionalidade;

    public function __construct($id, $nome, $nacionalidade) {
        $this->id = $id;
        $this->nome = $nome;
        $this->nacionalidade = $nacionalidade;
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        return $this->nome = $nome;
    }

    public function getNacionalidade() {
        return $this->nacionalidade;
    }

    public function setNacionalidade($nacionalidade) {
        return $this->nacionalidade = $nacionalidade;
    }

}
?>
