<?php
namespace Repository;

include_once "../../Model/Livro.php";
require_once "../../db/Conexao.php";

use db\Conexao;
use Model\Livro;

class LivroRepository {
    private $db;

    public function __construct() {
        $this->db = new Conexao();
    }

    public function save(Livro $livro) {
        $conn = $this->db->getConnection();
    
        $titulo = $livro->getTitulo();
        $ano = $livro->getAno();
        $id = $livro->getId();
        $idAutor = $livro->getIdAutor();
    
        if ($id) {
            // Atualiza o livro existente
            $sql = "UPDATE livro SET titulo = ?, ano = ?, idAutor = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("siii", $titulo, $ano, $idAutor, $id); // Corrigido
                $stmt->execute();
                $stmt->close();
            }
        } else {
            // Insere um novo livro
            $sql = "INSERT INTO livro (titulo, ano, idAutor) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("sii", $titulo, $ano, $idAutor); // Corrigido
                $stmt->execute();
                $stmt->close();
            }
        }
    }
    
    public function delete($id) {
        $conn = $this->db->getConnection();

        $sql = "DELETE FROM livro WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }
    }

    public function findByTitulo($titulo) {
        $conn = $this->db->getConnection();

        $sql = "SELECT id, titulo, ano, idAutor FROM livro WHERE titulo = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $titulo);
            $stmt->execute();
            $stmt->bind_result($id, $titulo, $ano, $idAutor);

            if ($stmt->fetch()) {
                $stmt->close();
                return new Livro($id, $titulo, $ano, $idAutor);
            }

            $stmt->close();
        }
    }

    public function findById($id) {
        $conn = $this->db->getConnection();

        $sql = "SELECT id, titulo, ano, idAutor FROM livro WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($id, $titulo, $ano, $idAutor);

            if ($stmt->fetch()) {
                $stmt->close();
                return new Livro($id, $titulo, $ano, $idAutor);
            }
        }
    }

    public function findAll() {
        $conn = $this->db->getConnection();

        $sql = "SELECT id, titulo, ano, idAutor FROM livro";
        $result = $conn->query($sql);

        $livros = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $livros[] = new Livro($row["id"], $row["titulo"], $row["ano"], $row["idAutor"]);
            }
            $result->free();
        }
        
        return $livros;
    }

    public function __destruct() {
        $this->db->closeConnection();
    }
}
?>
