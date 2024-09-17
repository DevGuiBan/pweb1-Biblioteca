CREATE DATABASE biblioteca;

USE biblioteca;

CREATE TABLE estudante(
id INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR (100)
);

CREATE TABLE autor(
id INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR (100),
nacionalidade VARCHAR (100)
);

CREATE TABLE livro(
id INT PRIMARY KEY AUTO_INCREMENT,
titulo VARCHAR (100),
ano INT,
idAutor INT, FOREIGN KEY (idAutor) REFERENCES autor(id) ON DELETE CASCADE
);

CREATE TABLE emprestimo(
idEmprestimo INT PRIMARY KEY AUTO_INCREMENT,
dataEmprestimo DATE NOT NULL,
dataDevolucao DATE,
estadoEmprestimo BOOLEAN DEFAULT TRUE,
idEstudante INT, FOREIGN KEY (idEstudante) REFERENCES estudante(id) ON DELETE CASCADE,
idLivro INT, FOREIGN KEY (idLivro) REFERENCES livro(id) ON DELETE CASCADE
);

INSERT INTO estudante (nome) VALUES ('Anthony Santos');
INSERT INTO estudante (nome) VALUES ('Arthur Costa');
INSERT INTO estudante (nome) VALUES ('Caroline Melo');
INSERT INTO estudante (nome) VALUES ('Ian Oliveira');
INSERT INTO estudante (nome) VALUES ('Fernanda Correa');

INSERT INTO autor (nome, nacionalidade) VALUES ('Erico Verissimo', 'Brasileiro');
INSERT INTO autor (nome, nacionalidade) VALUES ('Miguel de Cervantes', 'Espanhol');
INSERT INTO autor (nome, nacionalidade) VALUES ('William Faulkner', 'Estadunidense');
INSERT INTO autor (nome, nacionalidade) VALUES ('Gabriel García Márquez', 'Colombiano');
INSERT INTO autor (nome, nacionalidade) VALUES ('Jane Austen', 'Britânica');

INSERT INTO livro (titulo, ano, idAutor) VALUES ('Olhai os Lírios do Campo', 1938, 1);
INSERT INTO livro (titulo, ano, idAutor) VALUES ('Dom Quixote', 1605, 2);
INSERT INTO livro (titulo, ano, idAutor) VALUES ('O Som e a Fúria', 1929, 3);
INSERT INTO livro (titulo, ano, idAutor) VALUES ('Cem Anos de Solidão', 1967, 4);
INSERT INTO livro (titulo, ano, idAutor) VALUES ('Orgulho e Preconceito', 1813, 5);

INSERT INTO emprestimo (dataEmprestimo, dataDevolucao, estadoEmprestimo, idEstudante, idLivro) VALUES ('2024-09-01', NULL, TRUE, 1, 1);
INSERT INTO emprestimo (dataEmprestimo, dataDevolucao, estadoEmprestimo, idEstudante, idLivro) VALUES ('2024-09-02', NULL, TRUE, 2, 2);
INSERT INTO emprestimo (dataEmprestimo, dataDevolucao, estadoEmprestimo, idEstudante, idLivro) VALUES ('2024-09-03', '2024-09-07', FALSE, 3, 3);
INSERT INTO emprestimo (dataEmprestimo, dataDevolucao, estadoEmprestimo, idEstudante, idLivro) VALUES ('2024-09-04', NULL, TRUE, 4, 4);
INSERT INTO emprestimo (dataEmprestimo, dataDevolucao, estadoEmprestimo, idEstudante, idLivro) VALUES ('2024-09-05', NULL, TRUE, 5, 5);
