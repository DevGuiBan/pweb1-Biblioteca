<?php
namespace Controller;

include_once '../../Controller/EmprestimoController.php';
include_once '../../Controller/LivroController.php';
include_once '../../Controller/EstudanteController.php';
use Controller\EmprestimoController;
use Controller\LivroController;
use Controller\EstudanteController;

$livroController = new LivroController();
$livros = $livroController->listarLivros();

$estudanteController = new EstudanteController();
$estudantes = $estudanteController->listarEstudantes();

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dataEmprestimo = $_POST['data_emprestimo'];
    $dataDevolucao = $_POST['data_devolucao'];
    $estadoEmprestimo = 'Emprestado';
    $idEstudante = $_POST['estudante'];
    $idLivro = $_POST['titulo'];

    if (!empty($dataEmprestimo) && !empty($dataDevolucao) && !empty($idEstudante) && !empty($idLivro)) {
        $emprestimoController = new EmprestimoController();
        $mensagem = $emprestimoController->cadastrarEmprestimo($dataEmprestimo, $dataDevolucao, $estadoEmprestimo, $idEstudante, $idLivro);
        if (strpos($mensagem, 'sucesso') !== false) {
            echo "<script>alert('$mensagem'); window.location.href='listar_emprestimo.php';</script>";
            exit();
        } else {
            echo "<script>alert('$mensagem');</script>";
        }
    } else {
        $mensagem = 'Por favor, preencha todos os campos.';
        echo "<script>alert('$mensagem');</script>";
    }
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
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/scrollbar.css">
    <title>Biblioteca Online | Cadastrar Empréstimo</title>
</head>
<body>
    <main-header></main-header>

    <main>
        <section class="container">
            <form action="" method="POST">
                <h1>Cadastrar Empréstimo</h1>

                <?php if (!empty($mensagem)): ?>
                    <p class="mensagem"><?php echo $mensagem; ?></p>
                <?php endif; ?>

                <label for="titulo">Livro:</label>
                <select name="titulo" id="titulo" required>
                    <option value="" disabled selected>Selecione um livro</option>
                    <?php foreach($livros as $livro): ?>
                        <option value="<?php echo $livro->getId(); ?>">
                            <?php echo $livro->getTitulo(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="estudante">Estudante:</label>
                <select name="estudante" id="estudante" required>
                    <option value="" disabled selected>Selecione um estudante</option>
                    <?php foreach($estudantes as $estudante): ?>
                        <option value="<?php echo $estudante->getId(); ?>">
                            <?php echo $estudante->getNome(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="data_emprestimo">Data de Empréstimo:</label>
                <input type="date" placeholder="Data de Empréstimo" name="data_emprestimo" id="data_emprestimo" required/>

                <label for="data_devolucao">Data de Devolução:</label>
                <input type="date" placeholder="Data de Devolução" name="data_devolucao" id="data_devolucao" required/>

                <input type="submit" value="Cadastrar Empréstimo" />
                <input type="reset" value="Limpar" />
            </form>
        </section>
    </main>

    <main-footer></main-footer>

    <script src="../js/header.js"></script>
    <script src="../js/footer.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const hoje = new Date();
            const ano = hoje.getFullYear();
            const mes = String(hoje.getMonth() + 1).padStart(2, '0'); // Meses começam do 0
            const dia = String(hoje.getDate()).padStart(2, '0');
            const dataAtual = `${ano}-${mes}-${dia}`;

            document.getElementById('data_emprestimo').value = dataAtual;
        });
    </script>
</body>
</html>
