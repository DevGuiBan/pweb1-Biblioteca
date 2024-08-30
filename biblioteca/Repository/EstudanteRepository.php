<?php

include_once "../Model/Estudante.php";
require_once "../db/Conexao.php";

use db\Conexao;
use Model\Estudante;

Class EstudanteRepository {

    private $db;

    public function __construct() {
        $this->db = new Conexao();
    }

    public function save(Estudante $estudante) {
        $conn = $this -> db -> getConnection();

        $id = $estudante -> getId();
        $nome = $estudante -> getNome();

        if($id) {
            $sql = "UPDATE estudante SET nome = ? WHERE id = ?";
            $stmt = $conn -> prepare($sql);
            if($stmt) {
                $stmt->bind_Param("si", $nome, $id);
                $stmt->execute();
                $stmt->close();
            } else {
                $sql = "INSERT INTO estudante (nome) VALUES (?)";
                $stmt = $conn -> prepare($sql);
                if($stmt) {
                    $stmt->bind_Param("s", $nome);
                    $stmt->execute();
                    $stmt->close();
                }
            }
        }
    }
}
?>