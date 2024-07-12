<?php
class Feedback {
    private $conn;
    private $table_name = "tbfeedback";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    

    public function criar($idUsu, $feedback, $data)
    {
        return $this->registrar($idUsu, $feedback, $data);
    }

    public function lerFeed() {
        $query = "SELECT tbfeedback.idFeed, usuarios.nickname AS nickname, tbfeedback.feedback, tbfeedback.data  FROM tbfeedback INNER JOIN usuarios ON tbfeedback.idUsu = usuarios.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function lerPorId($idUsu)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE idFeed = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idUsu]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarFeed($idfeed, $feedback)
    {
        $query = "UPDATE " . $this->table_name . " SET feedback = ? WHERE idFeed = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$feedback, $idfeed]);
        return $stmt;
    }

    public function deletarFeed($idfeed)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE idfeed = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idfeed]);
        return $stmt;
    }
    
    public function registrar($idUsu, $data, $feedback)
    {
        $query = "INSERT INTO " . $this->table_name . " (idusu, data, feedback) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idUsu, $data, $feedback]);
        return $stmt;
    }

}
?>