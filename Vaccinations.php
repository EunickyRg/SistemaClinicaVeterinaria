<?php
class Vaccinations {
    private $conn;
    private $tableName = "vaccinations";
    public $id;
    public $pet_id;
    public $vaccine_name;
    public $vaccination_date;
    public $batch_number;
    public $veterinarian;
    public $notes;
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
    vaccine_name = vaccine_name,
    vaccination_date = vaccination_name,
    batch_number,
    veterinarian= veterinarian,
    notes = notes,
    created_at= created_at,
    updated_at = updated_at"; 

    $stmt = $this->conn->prepare($query);

    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->pet_id = htmlspecialchars(strip_tags($this->pet_id));
    $this->vaccine_name = htmlspecialchars(strip_tags($this->vaccine_name));
    $this->vaccination_date = htmlspecialchars(strip_tags($this->vaccination_date));
    $this->batch_number = htmlspecialchars(strip_tags($this->batch_number));
    $this->veterinarian = htmlspecialchars(strip_tags($this->veterinarian));
    $this->notes = htmlspecialchars(strip_tags($this->notes));
    $this->created_at = htmlspecialchars(strip_tags($this->created_at));
    $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));

    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':pet_id', $this->pet_id);
    $stmt->bindParam(':vaccine_name', $this->vaccine_name);
    $stmt->bindParam(':vaccination_date', $this->vaccination_date);
    $stmt->bindParam(':batch_number', $this->batch_number);
    $stmt->bindParam(':veterinarian', $this->veterinarian);
    $stmt->bindParam(':notes', $this->notes);
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
                SET 
                vaccine_name = vaccine_name,
                vaccination_date = vaccination_name,
                batch_number,
                veterinarian= veterinarian,
                notes = notes,
                created_at= created_at,
                updated_at = updated_at
                WHERE id = :id"; 

        $stmt = $this->conn->prepare($query);

        $this->vaccine_name = htmlspecialchars(strip_tags($this->vaccine_name));
        $this->vaccination_date = htmlspecialchars(strip_tags($this->vaccination_date));
        $this->batch_number = htmlspecialchars(strip_tags($this->batch_number));
        $this->veterinarian = htmlspecialchars(strip_tags($this->veterinarian));
        $this->notes = htmlspecialchars(strip_tags($this->notes));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));
        $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));

        $stmt->bindParam(':vaccine_name', $this->vaccine_name);
        $stmt->bindParam(':vaccination_date', $this->vaccination_date);
        $stmt->bindParam(':batch_number', $this->batch_number);
        $stmt->bindParam(':veterinarian', $this->veterinarian);
        $stmt->bindParam(':notes', $this->notes);
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
