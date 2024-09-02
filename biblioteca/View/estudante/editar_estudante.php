<?php
    require_once '../../Controller/EstudanteController.php';
    use Controller\EstudanteController;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id']; 
        $nome = $_POST['nome'];

        if (!empty($id) && !empty($nome)) {
            $estudanteController = new EstudanteController();


            $estudanteController->editarEstudante($id, $nome);

            echo "<p>Estudante editado com sucesso!</p>";

            header("Location: listar_estudante.php");
            exit();

        } else {
            echo "<p>Por favor, preencha todos os campos.</p>";
        }
    } else {
        $id = $_GET['id'] ?? null; 
        if ($id) {
            $estudanteController = new EstudanteController();
            $estudante = $estudanteController->listarEstudanteById($id);
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
    <title>Biblioteca Online | Editar Estudante</title>
</head>
<body>
    <main-header></main-header>

    <main>
        <section class="container">
            <form action="editar_estudante.php" method="POST">
                <h1>Editar Estudante</h1>
                <p>Edite de forma rápida estudantes com seus respectivos nomes.</p>

                <input type="hidden" name="id" value="<?php echo $estudante->getId(); ?>">

                <label for="nome">Nome:</label>
                <input type="text" placeholder="Nome" name="nome" id="nome" value="<?php echo $estudante->getNome(); ?>" required>

                <input type="submit" value="Editar Estudante">
                <input type="reset" value="Limpar">
            </form>
        </section>
    </main>


    <main-footer></main-footer>

    <script src="../js/header.js"></script>
    <script src="../js/footer.js"></script>
</body>
</html>