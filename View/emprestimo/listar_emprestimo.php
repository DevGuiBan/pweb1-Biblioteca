<?php 
include_once '../../Controller/EmprestimoController.php';
include_once '../../Controller/LivroController.php';
include_once '../../Controller/EstudanteController.php';

use Controller\EmprestimoController;
use Controller\LivroController;
use Controller\EstudanteController;

$emprestimoController = new EmprestimoController();
$emprestimos = $emprestimoController->listarEmprestimos();

$livroController = new LivroController();
$livros = $livroController->listarLivros();

$estudanteController = new EstudanteController();
$estudantes = $estudanteController->listarEstudantes();

// Criar mapas para acesso rápido
$livrosMap = [];
foreach ($livros as $livro) {
    $livrosMap[$livro->getId()] = $livro;
}

$estudantesMap = [];
foreach ($estudantes as $estudante) {
    $estudantesMap[$estudante->getId()] = $estudante;
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
    <title>Biblioteca Online | Listar Empréstimos</title>
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
        max-width: 1200px;
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
</head>
<body>
    <main-header></main-header>

    <main>
        <section>
            <div class="descricao-texto">
                <h1>Listar Empréstimos</h1>
                <p>
                    A seção de Empréstimos Cadastrados fornece um panorama completo de todos os <br>
                    empréstimos registrados no sistema da biblioteca. Aqui, você pode consultar <br>
                    facilmente detalhes de cada transação, incluindo os livros emprestados, <br>
                    os estudantes responsáveis, as datas de retirada e devolução previstas.
                </p>
            </div>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Livro</th>
                    <th>Estudante</th>
                    <th>Data de Empréstimo</th>
                    <th>Data de Devolução</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
                <?php
                if (!empty($emprestimos)) {
                    foreach ($emprestimos as $emprestimo) {
                        $livroId = $emprestimo->getIdLivro();
                        $estudanteId = $emprestimo->getIdEstudante();
                        $livro = $livrosMap[$livroId] ?? null;
                        $estudante = $estudantesMap[$estudanteId] ?? null;

                        $livroTitulo = $livro ? $livro->getTitulo() : 'Desconhecido';
                        $estudanteNome = $estudante ? $estudante->getNome() : 'Desconhecido';

                        $statusEmprestimo = $emprestimo->getEstadoEmprestimo();
                        $statusClass = ($statusEmprestimo === 'Emprestado') ? 'status-emprestado' : 'status-disponivel';
                        $statusTexto = ($statusEmprestimo === 'Emprestado') ? 'Disponível' : 'Emprestado';

                        echo "<tr>
                            <td>" . $emprestimo->getIdEmprestimo() . "</td>
                            <td>" . $livroTitulo . "</td>
                            <td>" . $estudanteNome . "</td>
                            <td>" . $emprestimo->getDataEmprestimo() . "</td>
                            <td>" . $emprestimo->getDataDevolucao() . "</td>
                            <td class='" . $statusClass . "'>" . $statusTexto . "</td>
                            <td>
                                <a href='editar_emprestimo.php?id=" . $emprestimo->getIdEmprestimo() . "'>Editar</a>
                                
                                <form method='POST' action='excluir_emprestimo.php' style='display:inline;' onsubmit='return confirmarExclusao();'>
                                    <input type='hidden' name='id' value='" . $emprestimo->getIdEmprestimo() . "'>
                                    <button type='submit'>Devolver</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Nenhum empréstimo encontrado</td></tr>";
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
            return confirm('Você tem certeza que deseja devolver este livro?');
        }
    </script>
</body>
</html>
