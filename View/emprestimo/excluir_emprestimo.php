<?php
require_once "../../Controller/EmprestimoController.php";
use Controller\EmprestimoController;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idEmprestimo = $_POST['id'];

    if(!empty($idEmprestimo)) {
        $emprestimoController = new EmprestimoController();
        $emprestimoController->excluirEmprestimo($idEmprestimo);

        header('Location: listar_emprestimo.php');
        exit();
    } else {
        echo "ID do emprestimo inválido";
    }
} else {
    echo "Método de requisição inválido";
}

?>