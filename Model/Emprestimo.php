<?php

namespace Model;

class Emprestimo {

    private $idEmprestimo;
    private $dataEmprestimo;
    private $dataDevolucao;
    private $idEstudante;
    private $idLivro;
    private $estadoEmprestimo;

    public function __construct($idEmprestimo, $dataEmprestimo, $dataDevolucao, $idEstudante, $idLivro, $estadoEmprestimo) {
        $this->idEmprestimo = $idEmprestimo;
        $this->dataEmprestimo = $dataEmprestimo;
        $this->dataDevolucao = $dataDevolucao;
        $this->idEstudante = $idEstudante;
        $this->idLivro = $idLivro;
        $this->estadoEmprestimo = $estadoEmprestimo ? true : false;
    }

    // Getters e Setters para o booleano "estadoEmprestimo"

    public function getEstadoEmprestimo() {
        return $this->estadoEmprestimo;
    }

    public function setEstadoEmprestimo($estadoEmprestimo) {
        $this->estadoEmprestimo = $estadoEmprestimo ? true : false;
    }

    //get's

    public function getIdEmprestimo() {
        return $this->idEmprestimo;
    }

    public function getDataEmprestimo() {
        return $this->dataEmprestimo;
    }

    public function getDataDevolucao() {
        return $this->dataDevolucao;
    }

    public function getIdLivro() {
        return $this->idLivro;
    }

    public function getIdEstudante() {
        return $this->idEstudante;
    }

    //set's

    public function setIdEmprestimo($idEmprestimo) {
        $this->idEmprestimo = $idEmprestimo;
    }

    public function setDataEmprestimo($dataEmprestimo) {
        $this->dataEmprestimo = $dataEmprestimo;
    }

    public function setDataDevolucao($dataDevolucao) {
        $this->dataDevolucao = $dataDevolucao;
    }

    public function setIdLivro($idLivro) {
        $this->idLivro = $idLivro;
    }

    public function setIdEstudante($idEstudante) {
        $this->idEstudante = $idEstudante;
    }
}
