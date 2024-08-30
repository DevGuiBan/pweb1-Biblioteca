<?php
require_once '../../Controller/AutorController.php';
use Controller\AutorController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    if (!empty($id)) {
        $autorController = new AutorController();
        $autorController->excluirAutor($id);

        header("Location: listar_autor.php");
        exit();
    } else {
        echo "ID do autor inválido.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
