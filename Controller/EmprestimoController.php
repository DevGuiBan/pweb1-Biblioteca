<?php
namespace Controller;

include_once "../../Model/Emprestimo.php";
include_once "../../Repository/EmprestimoRepository.php";
require_once "../../db/Conexao.php";

use Model\Emprestimo;
use Repository\EmprestimoRepository;

class EmprestimoController {
    private $repository;

    public function __construct() {
        $this->repository = new EmprestimoRepository();
    }

    public function cadastrarEmprestimo($dataEmprestimo, $dataDevolucao, $estadoEmprestimo, $idEstudante, $idLivro) {
        // Verifica se o livro já está emprestado
        if ($this->isLivroEmprestado($idLivro)) {
            return 'O livro selecionado já está emprestado.';
        }

        // Cria o objeto Emprestimo e salva no repositório
        $emprestimo = new Emprestimo(null, $dataEmprestimo, $dataDevolucao, $idEstudante, $idLivro, $estadoEmprestimo);
        $this->repository->save($emprestimo);

        return 'Empréstimo cadastrado com sucesso!';
    }

    

    private function isLivroEmprestado($idLivro) {
        $emprestimos = $this->repository->findByLivro($idLivro);
        foreach ($emprestimos as $emprestimo) {
            if ($emprestimo->getEstadoEmprestimo()) {
                return true;
            }
        }
        return false;
    }
    

    public function editarEmprestimo($idEmprestimo, $dataEmprestimo, $dataDevolucao, $estadoEmprestimo, $idEstudante, $idLivro) {
        $emprestimo = $this->repository->findById($idEmprestimo);
        if ($emprestimo) {
            $emprestimo->setDataEmprestimo($dataEmprestimo);
            $emprestimo->setDataDevolucao($dataDevolucao);
            $emprestimo->setEstadoEmprestimo($estadoEmprestimo);
            $emprestimo->setIdEstudante($idEstudante);
            $emprestimo->setIdLivro($idLivro);
            $this->repository->save($emprestimo);
            return 'Livro editado com sucesso';
        }
    }

    public function excluirEmprestimo($idEmprestimo) {
        $this->repository->delete($idEmprestimo);
    }

    public function listarEmprestimos() {
        return $this->repository->findAll();
    }

    public function listarEmprestimoById($idEmprestimo) {
        return $this->repository->findById($idEmprestimo);
    }
}

?>
