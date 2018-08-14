<?php
class Tasks {

    //database req
    private $conn;
    private $table = 'tasks';
    
    //tasks properties
    public $id;
    public $name;
    public $description;
    public $due;
    
    //constuctor
    public function __construct($db){
        $this->conn = $db;
    }

    //get all tasks
    public function getAllTasks(){
        $query = "SELECT * from $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    //get a single task
    public function getSingle(){
        $query = "SELECT * from $this->table WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        // Bind Id
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        return $stmt;
    }

    //create Tasks
    public function create(){
        $query = "INSERT INTO $this->table 
        SET
            id = :id,
            name = :name,
            description = :description,
            due = :due
        ";
        $stmt = $this->conn->prepare($query);

        //  sanitize data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->due = htmlspecialchars(strip_tags($this->due));

        // bind parameter
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':fname', $this->name);
        $stmt->bindParam(':lname', $this->description);
        $stmt->bindParam(':pass', $this->due);

        if($stmt->execute()){
            return true;
        } else {
            printf("Error %s \n", $stmt->error);
            return false;
        }   
    }

    //update task
    public function update(){
        $query = "UPDATE $this->table 
        SET
            name = :name,
            description = :description,
            due = :due
        WHERE id = :id
        ";
        $stmt = $this->conn->prepare($query);

        //  sanitize data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->due = htmlspecialchars(strip_tags($this->due));

        // bind parameter
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':fname', $this->name);
        $stmt->bindParam(':lname', $this->description);
        $stmt->bindParam(':pass', $this->due);

        if($stmt->execute()){
            return true;
        } else {
            printf("Error %s \n", $stmt->error);
            return false;
        } 
    }

    //delete task (if neccessary)
    public function delete(){
        $query = " DELETE FROM $this->table
        WHERE id =:id";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id)); 

        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()){
            return true;
        } else {
            printf("Error %s \n", $stmt->error);
            return false;
        }
    }


}


?>