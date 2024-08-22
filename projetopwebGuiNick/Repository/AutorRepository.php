<?php

    namespace Repository;

    require_once '../db/Conexao.php';
    include_once '../Model/Autor.php';

    use db\Conexao;
    use Model\Autor;

    class AutorRepository {
        private $db;

        public function __construct() {
            $this->db = new Conexao();
        }

        public function save(Autor $autor) {
            $conn = $this->db->getConnection();

            $nome = $autor->getNome();
            $nacionalidade = $autor->getNacionalidade();
            $id = $autor->getId(); // Pode ser null se for uma inserção

            if ($id) {
                $sql = "UPDATE autor SET nome=?, nacionalidade=? WHERE id=?";
                $stmt = $conn->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param("ssi", $nome, $nacionalidade, $id);
                    $stmt->execute();
                    $stmt->close();
                }
            } else {
                $sql = "INSERT INTO autor (nome, nacionalidade) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param("ss", $nome, $nacionalidade);
                    $stmt->execute();
                    $stmt->close();
                }
            }
        }

        public function delete($id) {
            $conn = $this->db->getConnection();
            
            $sql = "DELETE FROM autor WHERE id=?";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->close();
            }
        }

        public function findById($id) {
            $conn = $this->db->getConnection();
            
            $sql = "SELECT id, nome, nacionalidade FROM autor WHERE id=?";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->bind_result($id, $nome, $nacionalidade);

                if ($stmt->fetch()) {
                    $stmt->close();
                    return new Autor($id, $nome, $nacionalidade);
                }

                $stmt->close();
            }
            return null;
        }

        public function findAll() {
            $conn = $this->db->getConnection();
            
            $sql = "SELECT id, nome, nacionalidade FROM autor";
            $result = $conn->query($sql);

            $autores = [];
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $autores[] = new Autor($row['id'], $row['nome'], $row['nacionalidade']);
                }
                $result->free();
            }

            return $autores;
        }

        public function __destruct() {
            $this->db->closeConnection(); // Fecha a conexão quando o objeto for destruído
        }
    }
?>
