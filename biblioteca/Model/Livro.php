<?php
namespace Model;

include_once "../../Model/Autor.php";

class Livro {
    private $titulo;
    private $ano;
    private $id;
    private $idAutor;

    public function __construct($id, $titulo, $ano, $idAutor) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->ano = $ano;
        $this->idAutor = $idAutor;
    }

    //get's livro

    public function getTitulo() {
        return $this->titulo;
    }

    public function getAno() {
        return $this->ano;
    }

    public function getId(){
        return $this->id;
    }

    public function getIdAutor() {
        return $this->idAutor;
    }


    //set's livro

    public function setTitulo($titulo) {
        return $this->titulo = $titulo;
    }

    public function setAno($ano){
        return $this->ano = $ano;
    }

    public function setIdAutor($idAutor) {
        return $this->idAutor = $idAutor;
    }

    //gets autor

    public function getIdAutorOB(Autor $autor){
        return $autor->getId();
    }

    public function getAutorNome() {
        return $this->getAutorNome();
    }

    public function getAutorNacionalidadeOB(Autor $autor){
        return $autor->getNacionalidade();
    }
}
?>
