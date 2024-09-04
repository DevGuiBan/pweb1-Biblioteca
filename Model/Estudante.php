<?php
namespace Model;

class Estudante {
    private $nome;
    private $id;

    public function __construct($id, $nome) {
        $this->id = $id;
        $this->nome = $nome;
    }

    //gets

    public function getNome() {
        return $this->nome;
    }

    public function getId(){
        return $this->id;
    }

    //sets

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setId($id){
        $this->id = $id;
    }
}
?>
