<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once __DIR__ . '/../Controller/AutorController.php'

use Controller\AutorController;
$controller = new AutorController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se os dados do formulário estão definidos
    if (isset($_POST['nome']) && isset($_POST['nacionalidade'])) {
        $nome = $_POST['nome'];
        $nacionalidade = $_POST['nacionalidade'];

        // Adiciona um novo autor
        $controller->cadastrarAutor($nome, $nacionalidade);
        
        // Redireciona após a adição
        header('Location: indexAutores.php#aa');
        exit;
    } else {
        // Se os dados do formulário não estiverem definidos, exibe uma mensagem de erro
        echo "Dados do formulário não estão definidos corretamente.";
    }
}
?>