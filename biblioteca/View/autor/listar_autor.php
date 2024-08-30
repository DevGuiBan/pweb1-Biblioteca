<?php 
include_once '../../Controller/AutorController.php';
use Controller\AutorController;

$controller = new AutorController();
$autores = $controller->listarAutores();

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
    <title>Biblioteca Online | Listar Autores</title>
</head>
<body>
    <main-header></main-header>

    <main>
        <section>
            <div class="descricao-texto">
                <h1>Listar Autores</h1>
                <p>
                    A seção de Autores Cadastrados oferece uma visão completa de todos os escritores <br>
                    registrados em nosso sistema. Aqui, você pode acessar facilmente informações detalhadas de <br>
                    cada autor, incluindo nome, nacionalidade e outros dados relevantes.
                </p>
            </div>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Nacionalidade</th>
                    <th>Ações</th>
                </tr>
                <?php
                if (!empty($autores)) {
                    foreach ($autores as $autor) {
                        echo "<tr>
                            <td>" . $autor->getId() . "</td>
                            <td>" . $autor->getNome() . "</td>
                            <td>" . $autor->getNacionalidade() . "</td>
                            <td>
                                <a href='editar_autor.php?id=" . $autor->getId() . "'>Editar</a>
                                
                                <form method='POST' action='excluir_autor.php' style='display:inline;' onsubmit='return confirmarExclusao();'>
                                    <input type='hidden' name='id' value='" . $autor->getId() . "'>
                                    <button type='submit'>Excluir</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum autor encontrado</td></tr>";
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
            return confirm("Tem certeza que deseja excluir este autor?");
        }
    </script>
</body>
</html>
