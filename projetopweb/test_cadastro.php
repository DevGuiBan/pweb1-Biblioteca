<?php
// Teste com caminho absoluto
require_once './db/Conexao.php';
require_once './Model/Autor.php';
require_once '';


use Model\Autor;
use Controller\AutorController;

$controller = new AutorController();

$nome = "J.K. Rowling";
$nacionalidade = "Britânica";

$autor = new Autor(null, $nome, $nacionalidade);

$controller->cadastrarAutor($nome, $nacionalidade);

$autores = $repository->findAll();

echo "<h1>Autores Cadastrados</h1>";
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Nacionalidade</th>
        </tr>";

foreach ($autores as $autor) {
    echo "<tr>
            <td>{$autor->getId()}</td>
            <td>{$autor->getNome()}</td>
            <td>{$autor->getNacionalidade()}</td>
          </tr>";
}

echo "</table>";
?>
