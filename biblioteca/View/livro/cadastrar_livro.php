<?php            
    require_once '../../Controller/LivroController.php';
    require_once '../../Controller/AutorController.php';
    use Controller\LivroController;
    use Controller\AutorController;

    $autorController = new AutorController();
    $autores = $autorController->listarAutores();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = $_POST['titulo'];
        $ano_publicacao = $_POST['ano_publicacao'];
        $idAutor = $_POST['idAutor'];

        // Depuração: Verifique se os dados estão sendo recebidos corretamente
        var_dump($titulo, $ano_publicacao, $idAutor);

        if (!empty($titulo) && !empty($ano_publicacao) && !empty($idAutor)) {
            $livroController = new LivroController();
            $livroController->cadastrarLivro($titulo, $ano_publicacao, $idAutor);
            echo "<p>Livro cadastrado com sucesso!</p>";
            header("Location: listar_livro.php"); // Redireciona após cadastro bem-sucedido
            exit();
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
    <title>Biblioteca Online | Cadastrar Livro</title>
</head>
<body>
    <main-header></main-header>

    <main>
        <section class="container">
            <form action="" method="POST">
                <h1>Cadastrar Livro</h1>
                <p>Cadastre de forma rápida livros com seus respectivos títulos, autores e anos de publicação.</p>

                <label for="titulo">Título:</label>
                <input type="text" placeholder="Título" name="titulo" id="titulo" required>

                <label for="idAutor">Autor:</label>
                <select name="idAutor" id="idAutor" required>
                    <option value="" disabled selected>Selecione um autor</option>
                    <?php foreach($autores as $autor): ?>
                        <option value="<?php echo $autor->getId(); ?>">
                            <?php echo $autor->getNome(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="ano_publicacao">Ano de Publicação:</label>
                <input type="number" placeholder="Ano de Publicação" name="ano_publicacao" id="ano_publicacao" min="0" required>

                <input type="submit" value="Cadastrar Livro">
                <input type="reset" value="Limpar">
            </form>
        </section>
    </main>

    <main-footer></main-footer>

    <script src="../js/header.js"></script>
    <script src="../js/footer.js"></script>
</body>
</html>
