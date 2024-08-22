<?php
namespace Model;

class Livro {
    private $titulo;
    private $ano;
    private $id;
    private $idAutor;

    public function __construct($titulo, $ano, $id, $idAutor) {
        $this->titulo = $titulo;
        $this->ano = $ano;
        $this->id = $idAutor;
        $this->idAutor = $idAutor;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getAno() {
        return $this->ano;
    }

    public function getId(){
        return $this->id;
    }

    public function getIdAutor(){
        return $this->idAutor;
    }

    public function setTitulo($titulo) {
        return $this->titulo = $titulo;
    }

    public function setAno($ano){
        return $this->ano = $ano;
    }

    public function setId($id){
        return $this->id = $id;
    }

    public function setIdAutor($idAutor){
        return $this->idAutor = $idAutor;
    }

}
?>
