<?php
    require_once '../../Controller/EstudanteController.php';
    use Controller\EstudanteController;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];

        if (!empty($nome)) {
            $autorController = new EstudanteController();

            if ($autorController->cadastrarEstudante($nome)) {
                echo "<script>alert('Erro ao cadastrar estudante!');</script>";
            } else {
                echo "<script>alert('Estudante cadastrado com sucesso!');</script>";
            }
        } else {
            echo "<p>Por favor, preencha todos os campos.</p>";
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
    <title>Biblioteca Online | Cadastrar Estudante</title>
</head>
<body>
    <main-header></main-header>

    <main>
        <section class="container">
            <form action="cadastrar_estudante.php" method="POST">
                <h1>Cadastrar Estudante</h1>
                <p>Cadastre de forma rápida estudantes com seus respectivos nomes.</p>

                <label for="nome">Nome:</label>
                <input type="text" placeholder="Nome" name="nome" id="nome" required>

                <input type="submit" value="Cadastrar Estudante">
                <input type="reset" value="Limpar">
            </form>
        </section>
    </main>


    <main-footer></main-footer>

    <script src="../js/header.js"></script>
    <script src="../js/footer.js"></script>
</body>
</html>