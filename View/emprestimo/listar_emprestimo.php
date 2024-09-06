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
        .status-emprestado {
            color: green;
            font-weight: bold;
        }
        .status-disponivel {
            color: red;
            font-weight: bold;
        }
        button {
            width: 100px;
            background-color: rgb(239,35,60);
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
