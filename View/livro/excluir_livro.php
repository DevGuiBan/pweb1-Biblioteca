<?php
require_once "../../Controller/LivroController.php";
use Controller\LivroController;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    if(!empty($id)) {
        $livroController = new LivroController();
        $livroController->excluirLivro($id);

        header("Location: listar_livro.php");
        exit();
    } else {
        echo "ID do livro inválido";
    }
} else {
    echo "Método de requisição inválido";
}

?>