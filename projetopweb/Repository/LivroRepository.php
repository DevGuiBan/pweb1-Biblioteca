<?php

namespace Repository;

require_once '../db/Conexao.php';
include_once '../Model/Livro.php';

use db\Conexao;
use Model\Livro;

class LivroRepository {
    private $db;

    public function __construct() {
        $this->db = new Conexao();
    }

    public function save(Livro $livro) {
        $conn = $this->db->getConnection();

        if ($livro->getId()) {
            $sql = "UPDATE livro SET titulo=?, ano=?, idAutor=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die('Erro na preparação da consulta: ' . $conn->error);
            }
            $stmt->bind_param("siii", $livro->getTitulo(), $livro->getAno(), $livro->getIdAutor(), $livro->getId());
        } else {
            $sql = "INSERT INTO livro (titulo, ano, idAutor) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die('Erro na preparação da consulta: ' . $conn->error);
            }
            $stmt->bind_param("sii", $livro->getTitulo(), $livro->getAno(), $livro->getIdAutor());
        }

        $stmt->execute();
        $stmt->close();
    }

    public function delete($id) {
        $conn = $this->db->getConnection();
        
        $sql = "DELETE FROM livro WHERE id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function findById($id) {
        $conn = $this->db->getConnection();
        
        $sql = "SELECT id, titulo, ano, idAutor FROM livro WHERE id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $titulo, $ano, $idAutor);

        if ($stmt->fetch()) {
            $stmt->close();
            return new Livro($titulo, $ano, $id, $idAutor);
        }

        $stmt->close();
        return null;
    }

    public function findAll() {
        $conn = $this->db->getConnection();
        
        $sql = "SELECT id, titulo, ano, idAutor FROM livro";
        $result = $conn->query($sql);

        if ($result === false) {
            die('Erro na execução da consulta: ' . $conn->error);
        }

        $livros = [];
        while ($row = $result->fetch_assoc()) {
            $livros[] = new Livro($row['titulo'], $row['ano'], $row['id'], $row['idAutor']);
        }

        $result->free();
        return $livros;
    }

    public function __destruct() {
        $this->db->closeConnection(); // Fecha a conexão quando o objeto for destruído
    }
}
?>
