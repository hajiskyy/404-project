<?php
class Submissions {

    //database req
    private $conn;
    private $table = 'submissions';
    
    //submissions properties
    public $id;
    public $taskId;
    public $studentId;
    public $fileName;
    public $path;
    
    //constuctor
    public function __construct($db){
        $this->conn = $db;
    }

    //get all submissions
    public function getAllSubmissions(){
        $query = "SELECT * from $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    //get a student submission
    public function getStudentSubmission(){
        $query = "SELECT * from $this->table WHERE student_id = :id";
        $stmt = $this->conn->prepare($query);

        // Bind Id
        // Bind Id
        $stmt->bindParam(":id", $this->studentId);
        $this->studentId = htmlspecialchars(strip_tags($this->studentId));
        $stmt->execute();

        return $stmt;
    }

    // get single submissions
    public function getSingle(){
        $query = "SELECT * from $this->table 
        WHERE 
        student_id = :student_id
        AND
        task_id = :task_id
        ";
        $stmt = $this->conn->prepare($query);

        // Bind Id
        $stmt->bindParam(":student_id", $this->studentId);
        $stmt->bindParam(":task_id", $this->taskId);

        $this->taskId = htmlspecialchars(strip_tags($this->taskId));
        $this->studentId = htmlspecialchars(strip_tags($this->studentId));

        $stmt->execute();

        return $stmt;
    }

    //create submissions
    public function create(){
        $query = "INSERT INTO $this->table 
        SET
            task_id = :task_id,
            student_id = :student_id,
            filename = :filename,
            path = :path
        ";
        $stmt = $this->conn->prepare($query);

        //  sanitize data
        $this->taskId = htmlspecialchars(strip_tags($this->taskId));
        $this->studentId = htmlspecialchars(strip_tags($this->studentId));
        $this->fileName = htmlspecialchars(strip_tags($this->fileName));
        $this->path = htmlspecialchars(strip_tags($this->path));

        // bind parameter
        $stmt->bindParam(':task_id', $this->taskId);
        $stmt->bindParam(':student_id', $this->studentId);
        $stmt->bindParam(':filename', $this->fileName);
        $stmt->bindParam(':path', $this->path);

        if($stmt->execute()){
            return true;
        } else {
            printf("Error %s \n", $stmt->error);
            return false;
        }   
    }

    //update submission
    public function update(){
        $query = "UPDATE $this->table 
        SET
            task_id = :task_id,
            student_id = :student_id,
            filename = :filename,
            path = :path
        WHERE id = :id
        ";
        $stmt = $this->conn->prepare($query);

        //  sanitize data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->taskId = htmlspecialchars(strip_tags($this->taskId));
        $this->studentId = htmlspecialchars(strip_tags($this->studentId));
        $this->fileName = htmlspecialchars(strip_tags($this->fileName));
        $this->path = htmlspecialchars(strip_tags($this->path));

        // bind parameter
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':task_id', $this->taskId);
        $stmt->bindParam(':student_id', $this->studentId);
        $stmt->bindParam(':filename', $this->fileName);
        $stmt->bindParam(':path', $this->path);

        if($stmt->execute()){
            return true;
        } else {
            printf("Error %s \n", $stmt->error);
            return false;
        }  
    }
}


?>