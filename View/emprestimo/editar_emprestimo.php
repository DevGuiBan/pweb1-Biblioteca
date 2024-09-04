<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/geral.css" />
    <link rel="stylesheet" href="../css/header.css" />
    <link rel="stylesheet" href="../css/section.css" />
    <link rel="stylesheet" href="../css/form.css" />
    <link rel="stylesheet" href="../css/footer.css" />
    <link rel="stylesheet" href="../css/scrollbar.css" />
    <title>Biblioteca Online | Editar Empréstimo</title>
  </head>
  <body>
    <main-header></main-header>

    <main>
      <section class="container">
        <form action="editar_emprestimo.php" method="POST">
          <h1>Editar Empréstimo</h1>

          <label for="titulo">Livro:</label>
          <!-- <input type="text" placeholder="Título" name="titulo" id="titulo" required> -->
          <select name="titulo" id="titulo">
            <option value="" disabled selected>Selecione um livro</option>
          </select>

          <label for="estudante">Estudante:</label>
          <!-- <input type="" placeholder="Autor" id="autor" required> -->
          <select name="estudante" id="estudante">
            <option value="" disabled selected>Selecione um estudante</option>
          </select>

          <label for="data_emprestimo">Data de Empréstimo:</label>
          <input type="date" placeholder="Data de Empréstimo" name="data_emprestimo" id="data_emprestimo" required/>

          <label for="data_devolucao">Data de Devolução:</label>
          <input type="date" placeholder="Data de Devolução" name="data_devolucao" id="data_devolucao" required/>

          <input type="submit" value="Editar Empréstimo" />
          <input type="reset" value="Limpar" />
        </form>
      </section>
    </main>

    <main-footer></main-footer>

    <script src="../js/header.js"></script>
    <script src="../js/footer.js"></script>
  </body>
</html>
