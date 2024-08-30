<?php            
require_once '../../Controller/LivroController.php';
require_once '../../Controller/AutorController.php';
use Controller\LivroController;
use Controller\AutorController;

$livro = null;
$id = $_GET['id'] ?? null; 
$livroController = new LivroController();
$autorController = new AutorController();
$autores = $autorController->listarAutores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $ano = $_POST['ano_publicacao'];
    $idAutor = $_POST['idAutor'];

    if (!empty($titulo) && !empty($ano) && !empty($idAutor)) {
        $livroController->editarLivro($id, $titulo, $ano, $idAutor);
        echo "<p>Livro editado com sucesso!</p>";
        header("Location: listar_livro.php");
        exit();
    } else {
        echo "<p>Por favor, preencha todos os campos.</p>";
    }
} else {
    if ($id) {
        $livro = $livroController->listarLivroById($id);
        if (!$livro) {
            echo "<p>Livro não encontrado.</p>";
            exit();
        }
    } else {
        echo "<p>ID do livro não fornecido.</p>";
        exit();
    }
}

// Lembrar ao Guilherme do futuro que este post pode ser adaptado a uma unica classe de cadastrar e editar.
// No momento ele está com preguiça.
// De fazer try catch tbm.

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
    <title>Biblioteca Online | Editar Livro</title>
</head>
<body>
    <main-header></main-header>

    <main>
        <section class="container">
            <form action="" method="POST">
                <h1>Editar Livro</h1>
                <p>Edite as informações do livro selecionado.</p>

                <input type="hidden" name="id" value="<?php echo $livro->getId(); ?>">

                <label for="titulo">Título:</label>
                <input type="text" placeholder="Título" name="titulo" id="titulo" value="<?php echo $livro->getTitulo(); ?>" required>

                <label for="idAutor">Autor:</label>
                <select name="idAutor" id="idAutor" required>
                    <option value="" disabled>Selecione um autor</option>
                    <?php foreach($autores as $autor): ?>
                        <option value="<?php echo $autor->getId(); ?>" <?php echo $autor->getId() == $livro->getIdAutor() ? 'selected' : ''; ?>>
                            <?php echo $autor->getNome(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="ano_publicacao">Ano de Publicação:</label>
                <input type="number" placeholder="Ano de Publicação" name="ano_publicacao" id="ano_publicacao" min="0" value="<?php echo $livro->getAno(); ?>" required>

                <input type="submit" value="Salvar Alterações">
                <input type="reset" value="Limpar">
            </form>
        </section>
    </main>

    <main-footer></main-footer>

    <script src="../js/header.js"></script>
    <script src="../js/footer.js"></script>
</body>
</html>
