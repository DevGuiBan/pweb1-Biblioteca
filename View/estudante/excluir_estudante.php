<?php
require_once '../../Controller/EstudanteController.php';
use Controller\EstudanteController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    if (!empty($id)) {
        $estudanteController = new EstudanteController();
        $estudanteController->excluirEstudante($id);

        header("Location: listar_estudante.php");
        exit();
    } else {
        echo "ID do estudante inválido.";
    }
} else {
    echo "Método de requisição inválido.";
}