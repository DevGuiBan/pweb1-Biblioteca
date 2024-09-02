<?php
    namespace Repository;

    include_once "../../Model/Estudante.php";
    require_once "../../db/Conexao.php";

use db\Conexao;
use Model\Estudante;

Class EstudanteRepository {

    private $db;

    public function __construct() {
        $this->db = new Conexao();
    }

    public function save(Estudante $estudante) {
    $conn = $this->db->getConnection();

    $id = $estudante->getId();
    $nome = $estudante->getNome();

    if ($id) {
        $sql = "UPDATE estudante SET nome = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("si", $nome, $id);
            $stmt->execute();
            $stmt->close();
        }
    } else {
        $sql = "INSERT INTO estudante (nome) VALUES (?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $nome);
            $stmt->execute();
            $stmt->close();
        }
    }
}

    public function delete($id) {
        $conn = $this->db->getConnection();
        
        $sql = "DELETE FROM estudante WHERE id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }
    }

    public function findByEstudanteNome($nome) {
        $conn = $this->db->getConnection();

        $sql = "SELECT id, nome FROM estudante WHERE nome=?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $nome);
            $stmt->execute();
            $stmt->bind_result($id, $nome);

            if ($stmt->fetch()) {
                $stmt->close();
                return new Estudante($id, $nome);
            }

            $stmt->close();
        }
        return null;
    }

    public function findById($id) {
        $conn = $this->db->getConnection();
        
        $sql = "SELECT id, nome FROM estudante WHERE id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($id, $nome);

            if ($stmt->fetch()) {
                $stmt->close();
                return new Estudante($id, $nome);
            }

            $stmt->close();
        }
        return null;
    }

    public function findAll() {
        $conn = $this->db->getConnection();
        
        $sql = "SELECT id, nome FROM estudante";
        $result = $conn->query($sql);

        $estudantes = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $estudantes[] = new Estudante($row['id'], $row['nome']);
            }
            $result->free();
        }

        return $estudantes;
    }

    public function __destruct() {
        $this->db->closeConnection(); // Fecha a conexão quando o objeto for destruído
    }
}
?>