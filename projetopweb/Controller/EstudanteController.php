<?php
namespace Controller;

include_once '../Model/Estudante.php';
include_once '../Repository/EstudanteRepository.php';
require_once '../db/Database.php';

use Model\Estudante;
use Repository\EstudanteRepository;
use db\Database;

class EstudanteController {
    private $repository;

    public function __construct() {
        $this->repository = new EstudanteRepository();
    }

    public function cadastrarEstudante($nome) {
        $estudante = new Estudante($nome, null);
        $this->repository->save($estudante);
    }

    public function editarEstudante($id, $nome) {
        $estudante = $this->repository->findById($id);
        if ($estudante) {
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
}
?>
