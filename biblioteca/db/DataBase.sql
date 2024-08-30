CREATE DATABASE biblioteca;

USE biblioteca;

CREATE TABLE estudante(
id INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR (100)
);

CREATE TABLE autor(
id INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR (100),
nacionalidade VARCHAR (3)
);

CREATE TABLE livro(
id INT PRIMARY KEY AUTO_INCREMENT,
titulo VARCHAR (100),
ano INT,
idAutor INT, FOREIGN KEY (idAutor) REFERENCES autor(id) ON DELETE CASCADE
);

CREATE TABLE emprestimo(
dataEmprestimo DATE NOT NULL,
dataDevolucao DATE,
prazoDeDevolucao DATE NOT NULL,
idEstudante INT, FOREIGN KEY (idEstudante) REFERENCES estudante(id) ON DELETE CASCADE,
idLivro INT, FOREIGN KEY (idLivro) REFERENCES livro(id) ON DELETE CASCADE
);