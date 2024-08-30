<?php 
include_once '../../Controller/LivroController.php';
use Controller\LivroController;

$livroController = new LivroController();
$livros = $livroController->listarLivros();

include_once '../../Controller/AutorController.php';
use Controller\AutorController;

$autorController = new AutorController();
$autores = $autorController->listarAutores();

// Criar um mapa de autores para acesso rápido
$autoresMap = [];
foreach ($autores as $autor) {
    $autoresMap[$autor->getId()] = $autor;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/geral.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/section.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/scrollbar.css">
    <title>Biblioteca Online | Listar Livros</title>
</head>
<body>
    <main-header></main-header>

    <main>
        <section>
            <div class="descricao-texto">
                <h1>Listar Livros</h1>
                <p>
                    A seção de Livros Cadastrados oferece um panorama detalhado de todas as obras disponíveis em <br>
                    nosso acervo. Aqui, você pode acessar facilmente as informações completas de cada livro já <br>
                    registrado na biblioteca, incluindo títulos, autores, datas de publicação e 
                    status de disponibilidade.
                </p>
            </div>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Ano de Publicação</th>
                    <th>Autor</th>
                    <th>Ações</th>
                </tr>
                <?php
                if (!empty($livros)) {
                    foreach ($livros as $livro) {
                        $autorId = $livro->getIdAutor();
                        $autor = $autoresMap[$autorId] ?? null;
                        $autorNome = $autor ? ($autor->getNome()) : 'Desconhecido';

                        echo "<tr>
                            <td>" . ($livro->getId()) . "</td>
                            <td>" . ($livro->getTitulo()) . "</td>
                            <td>" . ($livro->getAno()) . "</td>
                            <td>" . $autorNome . "</td>
                            <td>
                                <a href='editar_livro.php?id=" . ($livro->getId()) . "'>Editar</a>
                                
                                <form method='POST' action='excluir_livro.php' style='display:inline;' onsubmit='return confirmarExclusao();'>
                                    <input type='hidden' name='id' value='" . ($livro->getId()) . "'>
                                    <button type='submit'>Excluir</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhum livro encontrado</td></tr>";
                }
                ?>
            </table>
        </section>
    </main>

    <main-footer></main-footer>

    <script src="../js/header.js"></script>
    <script src="../js/footer.js"></script>
    <script>
        function confirmarExclusao() {
            return confirm('Você tem certeza que deseja excluir este item?');
        }
    </script>
</body>
</html>
