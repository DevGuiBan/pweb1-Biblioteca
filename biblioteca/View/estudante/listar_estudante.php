<?php 
include_once '../../Controller/EstudanteController.php';
use Controller\EstudanteController;

$controller = new EstudanteController();
$estudantes = $controller->listarEstudantes();

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
    <title>Biblioteca Online | Listar Estudantes</title>
</head>
<style>
    button {
        width: 100px;
        background-color: rgb(239,35,60);
    }
    
    .action-buttons {
        display: flex;
        gap: 10px;
    }
</style>
<body>
    <main-header></main-header>

    <main>
        <section>
            <div class="descricao-texto">
                <h1>Listar Estudantes</h1>
                <p>
                    A seção de Estudantes Cadastrados oferece uma visão geral de todos os estudantes <br>
                    atualmente registrados no sistema da biblioteca. Nesta área, você pode acessar <br>
                    rapidamente informações como ID e nome.
                </p>
            </div>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
                <?php
                if (!empty($estudantes)) {
                    foreach ($estudantes as $estudante) {
                        echo "<tr>
                            <td>" . $estudante->getId() . "</td>
                            <td>" . $estudante->getNome() . "</td>
                            <td>
                                <a id='btn-editar' href='editar_estudante.php?id=" . $estudante->getId() . "'>Editar</a>
                                
                                <form method='POST' action='excluir_estudante.php' style='display:inline;' onsubmit='return confirmarExclusao();'>
                                    <input type='hidden' name='id' value='" . $estudante->getId() . "'>
                                    <button type='submit' class='btn-excluir'>Excluir</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum estudante encontrado</td></tr>";
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
            return confirm("Tem certeza que deseja excluir este Estudante?");
        }
    </script>
</body>
</html>