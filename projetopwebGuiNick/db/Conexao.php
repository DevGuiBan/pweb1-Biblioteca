<?php
namespace db;

class Conexao {
    private $conn;

    public function __construct() {
        $servername = "127.0.0.1";
        $username = "root"; // Substitua pelo seu usuário do MySQL
        $password = "aluno"; // Substitua pela sua senha do MySQL
        $dbname = "biblioteca"; // Substitua pelo nome do seu banco de dados

        // Criar conexão
        $this->conn = new \mysqli($servername, $username, $password, $dbname);

        // Verificar conexão
        if ($this->conn->connect_error) {
            die("Conexão falhou: " . $this->conn->connect_error);
        }else{
            echo 'Conexão bem sucedida';
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}

new Conexao();
?>
