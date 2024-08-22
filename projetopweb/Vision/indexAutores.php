<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once '../Controller/AutorController.php';
    use Controller\AutorController;

    // Cria uma instância do controlador com a conexão
    // $controller = new AutorController();

    $controller = new AutorController();
    $autores = $controller->listarAutores();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $nacionalidade = $_POST['nacionalidade'];
        $controller->cadastrarAutor($nome, $nacionalidade);
        header('Location: listar_autores.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/formCadastro.css">
    <title>Biblioteca | Autores</title>
</head>
<body>
    <header>
        <h2 class="logo">Biblioteca</h2>
        <nav>
            <a href="./indexLivro.html">Livros</a>
            <a style="color: rgb(3, 83, 164);">Autores</a>
            <a href="./indexEstudantes.html">Estudantes</a>
            <a href="./indexEmprestimos.html">Empréstimos</a>
        </nav>
    </header>

    <main>
        <section id="section1">
            <div class="description">
                <div class="description-text">
                    <h2>Autores cadastrados</h2>
                    <p>
                        Veja os autores que estão cadastrados, seus números de ID <br> e sua respectiva nacionalidade.
                    </p>
                </div>
                <form>
                    <input type="search" placeholder="Buscar autor...">
                    <input type="submit" value="Buscar">
                </form>
            </div>
            <div id="img-book">
                <img src="./svg/Novelist writing-bro.svg" alt="Autores" draggable="false">
                <p>
                    Nenhum autor cadastrado
                </p>
            </div>
        </section>
        
        <section id="section2">
            <div class="description" id="dsc2">
                <div class="description-text">
                    <h2>Gerenciar autores</h2>
                    <p>
                        Gerencie os autores que estão cadastrados, podendo adicionar, <br> editar e removê-los da lista.
                    </p>
                </div>
                <form>
                    <input type="submit" id="add_book" value="Adicionar Autor">
                </form>
            </div>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Nacionalidade</th>
                    <th>Ações</th>
                </tr>
                <?php
                    if (!empty($autores)) {
                        foreach ($autores as $autor) {
                            echo "<tr>
                                <td>" . $autor->getId() . "</td>
                                <td>" . $autor->getNome() . "</td>
                                <td>" . $autor->getNacionalidade() . "</td>
                                <td>
                                    <a href='editar_autor.php?id=" . $autor->getId() . "'>Editar</a>
                                    <button onclick='confirmarExclusao(" . $autor->getId() . ")'>Excluir</button>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Nenhum autor encontrado</td></tr>";
                    }
                ?>
            </table>

            <dialog id="modal">
                <h1>Cadastro de Autores</h1>
                <p>Cadastre de forma rápida autores, seus ID, nomes e suas nacionalidades.</p>

                <form method="POST" action="">
                    <!-- <label for="id">ID:</label>
                    <input placeholder="ID" type="number" id="id" name="id" required min="0"> -->

                    <label for="nome">Nome:</label>
                    <input placeholder="Nome" type="text" id="nome" name="nome" required>
                    
                    <label for="nacionalidade">Nacionalidades:</label>
                    <input placeholder="Nacionalidade" type="text" id="nacionalidade" name="nacionalidade" required>
                    
                    <div class="btn">
                        <input type="submit" value="Cadastrar">
                        <input type="reset" value="Limpar">
                    </div>
                </form>
            </dialog>
        </section>
        
    </main>
    <footer>
        <p> <strong>PWEB I - IFCE campus Cedro, CE</strong></p>
        <p>Guilherme Bandeira Dias (Banco de Dados)</p>
        <p>Nickolas Davi Vieira Lima (Front-End)</p>
        <p>Raimundo Gabriel Pereira Ferreira (Back-End)</p>
        <p>&copy; Alguns direitos reservados.</p>
    </footer>

    <script src="./js/formCadastro.js"></script>
</body>
</html>