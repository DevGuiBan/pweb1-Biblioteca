<?php
namespace Repository;

include_once "../../Model/Emprestimo.php";
require_once "../../db/Conexao.php";

use db\Conexao;
use Model\Emprestimo;

class EmprestimoRepository {
    private $db;

    public function __construct() {
        $this->db = new Conexao();
    }

    public function save(Emprestimo $emprestimo) {
        $conn = $this->db->getConnection();
    
        $dataEmprestimo = $emprestimo->getDataEmprestimo();
        $dataDevolucao = $emprestimo->getDataDevolucao();
        $estadoEmprestimo = $emprestimo->getEstadoEmprestimo() ? 1 : 0; // Converte booleano para inteiro
        $idEstudante = $emprestimo->getIdEstudante();
        $idLivro = $emprestimo->getIdLivro();
        $idEmprestimo = $emprestimo->getIdEmprestimo();
    
        if ($idEmprestimo) {
            $sql = "UPDATE emprestimo SET dataEmprestimo = ?, dataDevolucao = ?, estadoEmprestimo = ?, idEstudante = ?, idLivro = ? WHERE idEmprestimo = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("sssiii", $dataEmprestimo, $dataDevolucao, $estadoEmprestimo, $idEstudante, $idLivro, $idEmprestimo);
                $stmt->execute();
                $stmt->close();
            }
        } else {
            $sql = "INSERT INTO emprestimo (dataEmprestimo, dataDevolucao, estadoEmprestimo, idEstudante, idLivro) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("sssii", $dataEmprestimo, $dataDevolucao, $estadoEmprestimo, $idEstudante, $idLivro);
                $stmt->execute();
                $stmt->close();
            }
        }
    }
    

    public function delete($id) {
        $conn = $this->db->getConnection();

        $sql = "DELETE FROM emprestimo WHERE idEmprestimo = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }
    }

    public function findByLivro($idLivro) {
        $conn = $this->db->getConnection();
    
        $sql = "SELECT idEmprestimo, dataEmprestimo, dataDevolucao, estadoEmprestimo, idEstudante, idLivro FROM emprestimo WHERE idLivro = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $idLivro);
            $stmt->execute();
            $result = $stmt->get_result();
    
            $emprestimos = [];
            while ($row = $result->fetch_assoc()) {
                $emprestimos[] = new Emprestimo(
                    $row["idEmprestimo"], 
                    $row["dataEmprestimo"], 
                    $row["dataDevolucao"], 
                    $row["idEstudante"], 
                    $row["idLivro"], 
                    $row["estadoEmprestimo"]
                );
            }
    
            $stmt->close();
            return $emprestimos;
        }
    }    

    public function findById($idEmprestimo) {
        $conn = $this->db->getConnection();

        $sql = "SELECT idEmprestimo, dataEmprestimo, dataDevolucao, estadoEmprestimo, idEstudante, idLivro FROM emprestimo WHERE idEmprestimo = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $idEmprestimo);
            $stmt->execute();
            $stmt->bind_result($idEmprestimo, $dataEmprestimo, $dataDevolucao, $estadoEmprestimo, $idEstudante, $idLivro);

            if ($stmt->fetch()) {
                $stmt->close();
                return new Emprestimo($idEmprestimo, $dataEmprestimo, $dataDevolucao, $idEstudante, $idLivro, $estadoEmprestimo);
            }
        }
    }

    public function findAll() {
        $conn = $this->db->getConnection();

        $sql = "SELECT idEmprestimo, dataEmprestimo, dataDevolucao, estadoEmprestimo, idEstudante, idLivro FROM emprestimo";
        $result = $conn->query($sql);

        $emprestimos = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $emprestimos[] = new Emprestimo(
                    $row["idEmprestimo"], 
                    $row["dataEmprestimo"], 
                    $row["dataDevolucao"], 
                    $row["idEstudante"], 
                    $row["idLivro"], 
                    $row["estadoEmprestimo"]
                );
            }
            $result->free();
        }
        
        return $emprestimos;
    }

    public function __destruct() {
        $this->db->closeConnection();
    }
}
?>
