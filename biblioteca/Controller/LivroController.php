<?php
namespace Controller;

include_once "../../Model/Livro.php";
include_once "../../Repository/LivroRepository.php";
require_once "../../db/Conexao.php";

use Model\Livro;
use Repository\LivroRepository;

class LivroController {
    private $repository;

    public function __construct() {
        $this->repository = new LivroRepository();
    }

    public function cadastrarLivro($titulo, $ano, $idAutor) {
        $livro = new Livro(null, $titulo, $ano, $idAutor);
        $this->repository->save($livro);
    }

    public function editarLivro($id, $titulo, $ano, $idAutor) {
        $livro = $this->repository->findById($id);
        if ($livro) {
            $livro->setTitulo($titulo);
            $livro->setAno($ano);
            $livro->setIdAutor($idAutor);
            $this->repository->save($livro);
        }
    }

    public function excluirLivro($id) {
        $this->repository->delete($id);
    }

    public function listarLivros() {
        return $this->repository->findAll();
    }

    public function listarLivroById($id) {
        return $this->repository->findById($id);
    }

    public function listarLivroByTitulo($titulo) {
        return $this->repository->findByTitulo($titulo);
    }
}
?>
