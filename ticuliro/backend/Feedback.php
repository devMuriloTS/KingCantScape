<?php
class Feedback {
    private $conn;
    private $db;
    private $table_name = "tbfeedback";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    

    public function criar($idUsu, $feedback, $data)
    {
        return $this->registrar($idUsu, $feedback, $data);
    }

    public function ler($search = '', $order_by = '') {
        $query = "SELECT f.id, u.nickname as usuario, f.feedback, f.data 
                  FROM usuarios AS u 
                  INNER JOIN tbfeedback AS f ON u.id = f.idUsu";
        $conditions = [];
        $params = [];

        if ($search) {
            $conditions[] = "(f.feedback LIKE :search)";
            $params[':search'] = '%' . $search . '%';
        }

        if ($order_by === 'feedback') {
            $query .= " ORDER BY f.feedback";
        } elseif ($order_by === 'data') {
            $query .= " ORDER BY f.data";
        }

        if (count($conditions) > 0) {
            $query .= " WHERE " . implode(' AND ', $conditions);
        }

        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
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