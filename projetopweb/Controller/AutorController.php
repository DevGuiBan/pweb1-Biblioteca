<?php
namespace Controller;

include_once '../Model/Autor.php';
include_once '../Repository/AutorRepository.php';
require_once '../db/Conexao.php';

use Model\Autor;
use Repository\AutorRepository;


class AutorController {
    private $repository;

    public function __construct() {
        $this->repository = new AutorRepository();
    }

    public function cadastrarAutor($nome, $nacionalidade) {
        $autor = new Autor(null, $nome, $nacionalidade);
        $this->repository->save($autor);
    }

    public function editarAutor($id, $nome, $nacionalidade) {
        $autor = $this->repository->findById($id);
        if ($autor) {
            $autor->setNome($nome);
            $autor->setNacionalidade($nacionalidade);
            $this->repository->save($autor);
        }
    }

    public function excluirAutor($id) {
        $this->repository->delete($id);
    }

    public function listarAutores() {
        return $this->repository->findAll();
    }

    public function getAutorById($id) {
        return $this->repository->findById($id);
    }
}
?>
