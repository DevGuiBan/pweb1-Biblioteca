<?php
namespace Controller;

include_once '../../Controller/EmprestimoController.php';
include_once '../../Controller/LivroController.php';
include_once '../../Controller/EstudanteController.php';
use Controller\EmprestimoController;
use Controller\LivroController;
use Controller\EstudanteController;

$emprestimoController = new EmprestimoController();
$livroController = new LivroController();
$estudanteController = new EstudanteController();

$livros = $livroController->listarLivros();
$estudantes = $estudanteController->listarEstudantes();

$mensagem = '';

if (isset($_GET['id'])) {
    $idEmprestimo = $_GET['id'];
    $emprestimo = $emprestimoController->listarEmprestimoById($idEmprestimo);

    if (!$emprestimo) {
        die('Empréstimo não encontrado');
    }
} else {
    die('ID do empréstimo não fornecido');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dataEmprestimo = $_POST['data_emprestimo'];
    $dataDevolucao = $_POST['data_devolucao'];
    $idEstudante = $_POST['estudante'];
    $idLivro = $_POST['titulo'];

    if (!empty($idEstudante) && !empty($idLivro)) {
        $mensagem = $emprestimoController->editarEmprestimo($idEmprestimo, $dataEmprestimo, $dataDevolucao, $estadoEmprestimo, $idEstudante, $idLivro);
        
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
    <title>Biblioteca Online | Editar Empréstimo</title>
</head>
<body>
    <main-header></main-header>

    <main>
        <section class="container">
            <form action="" method="POST">
                <h1>Editar Empréstimo</h1>

                <?php if (!empty($mensagem)): ?>
                    <p class="mensagem"><?php echo $mensagem; ?></p>
                <?php endif; ?>

                <label for="titulo">Livro:</label>
                <select name="titulo" id="titulo" required>
                    <?php foreach($livros as $livro): ?>
                        <option value="<?php echo $livro->getId(); ?>" <?php echo ($livro->getId() == $emprestimo->getIdLivro()) ? 'selected' : ''; ?>>
                            <?php echo $livro->getTitulo(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="estudante">Estudante:</label>
                <select name="estudante" id="estudante" required>
                    <?php foreach($estudantes as $estudante): ?>
                        <option value="<?php echo $estudante->getId(); ?>" <?php echo ($estudante->getId() == $emprestimo->getIdEstudante()) ? 'selected' : ''; ?>>
                            <?php echo $estudante->getNome(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="data_emprestimo">Data de Empréstimo:</label>
                <input type="date" name="data_emprestimo" id="data_emprestimo" value="<?php echo $emprestimo->getDataEmprestimo(); ?>" required/>

                <label for="data_devolucao">Data de Devolução:</label>
                <input type="date" name="data_devolucao" id="data_devolucao" value="<?php echo $emprestimo->getDataDevolucao(); ?>" required/>

                <input type="submit" value="Atualizar Empréstimo" />
                <input type="reset" value="Limpar" />
            </form>
        </section>
    </main>

    <main-footer></main-footer>

    <script src="../js/header.js"></script>
    <script src="../js/footer.js"></script>
</body>
</html>
