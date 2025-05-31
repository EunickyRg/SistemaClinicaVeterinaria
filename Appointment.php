<?php
class Appointment {
    private $conn;
    private $tableName = "appointments";
    public $id;
    public $pet_id;
    public $appointment_day;
    public $reason;
    public $veterinarian;
    public $status;
    public $created_at;
    public $updated_at;

    public function __construct($db) {
        $this->conn= $db;
    }

//criar agendamento
public function create(){
    $query= "INSERT TO" . $this->tableName. "
    SET id= id,
    pet_id= pet_id,
    appointment_day= appointment_day,
    reason= reason,
    veterinarian= veterinarian,
    status= status,
    created_at= created_at,
    updated_at = updated_at"; 

    $stmt = $this->conn->prepare($query);

    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->pet_id = htmlspecialchars(strip_tags($this->pet_id));
    $this->appointment_day = htmlspecialchars(strip_tags($this->appointment_day));
    $this->reason = htmlspecialchars(strip_tags($this->reason));
    $this->veterinarian = htmlspecialchars(strip_tags($this->veterinarian));
    $this->status = htmlspecialchars(strip_tags($this->status));
    $this->created_at = htmlspecialchars(strip_tags($this->created_at));
    $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));

    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':pet_id', $this->pet_id);
    $stmt->bindParam(':appointment_day', $this->appointment_day);
    $stmt->bindParam(':reason', $this->reason);
    $stmt->bindParam(':veterinarian', $this->veterinarian);
    $stmt->bindParam(':created_at', $this->created_at);
    $stmt->bindParam(':updated_at', $this->updated_at);

    if($stmt->execute()){
            return true;
        }
        return false;
}

public function readByPet($pet_id) {
        $query = "SELECT * FROM " . $this->tableName . " 
                 WHERE pet_id = ? 
                 ORDER BY procedure_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $pet_id);
        $stmt->execute();
        return $stmt;
    }

public function update() {
        $query = "UPDATE " . $this->tableName . " 
                SET appointment_day= appointment_day,
                reason= reason,
                veterinarian= veterinarian,
                status= status,
                created_at= created_at,
                updated_at = updated_at
                WHERE id = :id"; 

        $stmt = $this->conn->prepare($query);

        $this->appointment_day = htmlspecialchars(strip_tags($this->appointment_day));
        $this->reason = htmlspecialchars(strip_tags($this->reason));
        $this->veterinarian = htmlspecialchars(strip_tags($this->veterinarian));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));
        $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));

        $stmt->bindParam(':appointment_day', $this->appointment_day);
        $stmt->bindParam(':reason', $this->reason);
        $stmt->bindParam(':veterinarian', $this->veterinarian);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':updated_at', $this->updated_at);

        return $stmt->execute();
    }

 public function delete() {
        $query = "DELETE FROM " . $this->tableName . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
