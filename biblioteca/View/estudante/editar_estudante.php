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

                <label for="nome">Nome:</label>
                <input type="text" placeholder="Nome" name="nome" id="nome" required>

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