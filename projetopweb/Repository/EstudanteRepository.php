<?php

namespace Repository;

require_once '../db/Conexao.php';
include_once '../Model/Estudante.php';

use db\Conexao;
use Model\Estudante;

class EstudanteRepository {
    private $db;

    public function __construct() {
        $this->db = new Conexao();
    }

    public function save(Estudante $estudante) {
        $conn = $this->db->getConnection();

        if ($estudante->getId()) {
            $sql = "UPDATE estudante SET nome=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die('Erro na preparação da consulta: ' . $conn->error);
            }
            $stmt->bind_param("si", $estudante->getNome(), $estudante->getId());
        } else {
            $sql = "INSERT INTO estudante (nome) VALUES (?)";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die('Erro na preparação da consulta: ' . $conn->error);
            }
            $stmt->bind_param("s", $estudante->getNome());
        }

        $stmt->execute();
        $stmt->close();
    }

    public function delete($id) {
        $conn = $this->db->getConnection();
        
        $sql = "DELETE FROM estudante WHERE id=?";
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
        
        $sql = "SELECT id, nome FROM estudante WHERE id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $nome);

        if ($stmt->fetch()) {
            $stmt->close();
            return new Estudante($nome, $id);
        }

        $stmt->close();
        return null;
    }

    public function findAll() {
        $conn = $this->db->getConnection();
        
        $sql = "SELECT id, nome FROM estudante";
        $result = $conn->query($sql);

        if ($result === false) {
            die('Erro na execução da consulta: ' . $conn->error);
        }

        $estudantes = [];
        while ($row = $result->fetch_assoc()) {
            $estudantes[] = new Estudante($row['nome'], $row['id']);
        }

        $result->free();
        return $estudantes;
    }

    public function __destruct() {
        $this->db->closeConnection(); // Fecha a conexão quando o objeto for destruído
    }
}
?>
