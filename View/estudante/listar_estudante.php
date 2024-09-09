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
    body {
        font-family: Arial, sans-serif;
        background-color: #f4faff;
        color: #333;
    }

    table {
        width: 100%;
        max-width: 900px;
        margin: 20px auto;
        border-collapse: collapse;
        background-color: #ffffff;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    th, td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #e6e6e6;
        border-right: 1px solid #e6e6e6;
    }

    th {
        background-color: rgb(3, 83, 164);
        color: white;
    }

    .btn-excluir {
        background-color: #ff4d4d;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-excluir:hover {
        background-color: #ff1a1a;
    }

    #btn-editar {
        padding: 8px 12px;
        text-decoration: none;
        border-radius: 5px;
    }

    section {
        text-align: center;
        margin: 0 auto;
    }

    .table-container {
        max-height: 400px;
        overflow-y: auto;
        border-radius: 10px;
    }

    .table-container::-webkit-scrollbar {
        width: 12px;
    }

    .table-container::-webkit-scrollbar-thumb {
        background-color: #007bff;
        border-radius: 6px;
    }

    .table-container::-webkit-scrollbar-track {
        background-color: #e6e6e6;
    }

    .descricao-texto {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
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