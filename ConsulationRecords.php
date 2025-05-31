 <?php
class ConsulationRecords {
    private $conn;
    private $tableName = "consulation_records";
    public $id;
    public $pet_id;
    public $consulation_date;
    public $veterinarian;
    public $anamesis;
    public $physical_exam;
    public $diagnosis
    public $treatment;
    public $pescription;
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
    consulation_date= consulation_date,
    veterinarian= veterinarian,
    anamesis=anamesis,
    physical_exam= physical_exam,
    diagnosis= diagnosis,
    treatment= treatment,
    prescription= prescription,
    notes= notes,
    created_at= created_at,
    updated_at = updated_at"; 

    $stmt = $this->conn->prepare($query);

    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->pet_id = htmlspecialchars(strip_tags($this->pet_id));
    $this->consulation_date = htmlspecialchars(strip_tags($this->consulation_date));
    $this->veterinarian = htmlspecialchars(strip_tags($this->veterinarian));
    $this->anamesis = htmlspecialchars(strip_tags($this->anamesis));
    $this->physical_exam = htmlspecialchars(strip_tags($this->physical_exam));
    $this->diagnosis = htmlspecialchars(strip_tags($this->diagnosis));
    $this->treatment = htmlspecialchars(strip_tags($this->treatment));
    $this->prescription = htmlspecialchars(strip_tags($this->prescription));
    $this->notes = htmlspecialchars(strip_tag($this->notes));
    $this->created_at = htmlspecialchars(strip_tags($this->created_at));
    $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));

    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':pet_id', $this->pet_id);
    $stmt->bindParam(':consulation_date', $this->consulation_date);
    $stmt->bindParam(':veterinarian', $this->veterinarian);
    $stmt->bindParam(':anamesis', $this->anamesis);
    $stmt->bindParam(':physical_exam', $this->physical_exam);
    $stmt->bindParam(':diagnosis', $this->diagnosis);
    $stmt->bindParam(':treatment', $this->treatmnent);
    $stmt->bindParam(':prescription', $this->prescription);
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
                SET consulation_date= consulation_date,
                veterinarian= veterinarian,anamesis=anamesis,
                physical_exam= physical_exam,
                diagnosis= diagnosis,
                treatment= treatment,
                prescription= prescription,
                notes= notes,
                created_at= created_at,
                 updated_at = updated_at
                WHERE id = :id"; 

        $stmt = $this->conn->prepare($query);

         $this->consulation_date = htmlspecialchars(strip_tags($this->consulation_date));
         $this->veterinarian = htmlspecialchars(strip_tags($this->veterinarian));
         $this->anamesis = htmlspecialchars(strip_tags($this->anamesis));
         $this->physical_exam = htmlspecialchars(strip_tags($this->physical_exam));
         $this->diagnosis = htmlspecialchars(strip_tags($this->diagnosis));
         $this->treatment = htmlspecialchars(strip_tags($this->treatment));
         $this->prescription = htmlspecialchars(strip_tags($this->prescription));
         $this->notes = htmlspecialchars(strip_tag($this->notes));
         $this->created_at = htmlspecialchars(strip_tags($this->created_at));
         $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));
    
         $stmt->bindParam(':consulation_date', $this->consulation_date);
         $stmt->bindParam(':veterinarian', $this->veterinarian);
         $stmt->bindParam(':anamesis', $this->anamesis);
         $stmt->bindParam(':physical_exam', $this->physical_exam);
         $stmt->bindParam(':diagnosis', $this->diagnosis);
         $stmt->bindParam(':treatment', $this->treatmnent);
         $stmt->bindParam(':prescription', $this->prescription);
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
