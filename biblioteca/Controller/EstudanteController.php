<?php
namespace Controller;

include_once '../../Model/Estudante.php';
include_once '../../Repository/EstudanteRepository.php';
require_once '../../db/Conexao.php';

use Model\Estudante;
use Repository\EstudanteRepository;

Class EstudanteController {
    private $repository;

    public function __construct() {
        $this->repository = new EstudanteRepository();
    }
    
    public function cadastrarEstudante($nome) {
        $estudante = new Estudante(null, $nome);
        $this->repository->save($estudante);
    }

    public function editarEstudante($id, $nome) {
        $estudante = $this->repository->findById($id);
        if($estudante) {
            $estudante->setNome($nome);
            $this->repository->save($estudante);
        }
    }

    public function excluirEstudante($id) {
        $this->repository->delete($id);
    }

    public function listarEstudantes() {
        return $this->repository->findAll();
    }

    public function getEstudanteById($id) {
        return $this->repository->findById($id);
    }

    public function listarEstudanteByNome($nome) {
        return $this -> repository -> findByEstudanteNome($nome);
    }

    public function listarEstudanteById($id) {
        return $this -> repository -> findById($id);
    }
}   

?>