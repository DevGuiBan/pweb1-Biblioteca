<?php            
    require_once '../../Controller/AutorController.php';
    use Controller\AutorController;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $nacionalidade = $_POST['nacionalidade'];

        if (!empty($nome) && !empty($nacionalidade)) {
            $autorController = new AutorController();

            if ($autorController->cadastrarAutor($nome, $nacionalidade)) {
                echo "<p>Autor cadastrado com sucesso!</p>";
            } else {
                echo "<p>Erro ao cadastrar o autor.</p>";
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
    <title>Biblioteca Online | Cadastrar Autor</title>
</head>
<body>
    <main-header></main-header>

    <main>
        <section class="container">
            <form action="cadastrar_autor.php" method="POST">
                <h1>Cadastrar Autor</h1>
                <p>Cadastre de forma rápida autores com seus respectivos nomes e nacionalidades.</p>

                <label for="nome">Nome:</label>
                <input type="text" placeholder="Nome" name="nome" id="nome" required>

                <label for="nacionalidade">Nacionalidade:</label>
                <input type="text" placeholder="Nacionalidade" name="nacionalidade" id="nacionalidade" required>

                <input type="submit" value="Cadastrar Autor">
                <input type="reset" value="Limpar">
            </form>
        </section>
    </main>

    <main-footer></main-footer>

    <script src="../js/header.js"></script>
    <script src="../js/footer.js"></script>
</body>
</html>
