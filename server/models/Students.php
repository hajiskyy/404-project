<?php
    class Students {

        //database req
        private $conn;
        private $table = 'students';

        //student propertis
        public $id;
        public $firstName;
        public $lastName;
        public $password;
        public $advisorId;
        public $registered;

        //constuctor
        public function __construct($db){
            $this->conn = $db;
        }

        // Get student by Id
        public function getStudentById(){
            $query = "SELECT * from $this->table WHERE id = ?";
            $stmt = $this->conn->prepare($query);

            // Bind Id
            $stmt->bindParam(1, $this->id);
            $stmt->execute();

            return $stmt;
        }

        // get student by Advisor
        public function getStudentsByAdvisor($advisorId){
            $query = "SELECT * from $this->table WHERE advisor_id = :value";
            $stmt = $this->conn->prepare($query);
            //Bind advisor id
            $stmt->execute(['value' => $advisorId]);
            
            return $stmt;
        }

        //set an advisor
        public function setAdvisor(){
            $query = "UPDATE $this->table SET advisor_id = :advisor
                WHERE id = :id
            ";

            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));            
            $this->password = htmlspecialchars(strip_tags($this->advisorId));

            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":advisor", $this->advisorId);

            if($stmt->execute()){
                return true;
            } else {
                printf("Error %s \n", $stmt->error);
                return false;
            }
        }

        // Get All Students
        public function getAllStudents(){
            $query = "SELECT * from $this->table";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        // get unregitsered students
        public function getUnregisteredStudents(){
            $query = "SELECT * from $this->table WHERE registered = 0";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        // get regitsered students
        public function getRegisteredStudents(){
            $query = "SELECT * from $this->table WHERE registered = 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        // register student
        public function register(){
                $query = "INSERT INTO $this->table 
                SET
                    id = :id,
                    firstName = :fname,
                    lastName = :lname,
                    password = :pass
             ";
             $stmt = $this->conn->prepare($query);

            //  sanitize data
             $this->id = htmlspecialchars(strip_tags($this->id));
             $this->firstName = htmlspecialchars(strip_tags($this->firstName));
             $this->lastName = htmlspecialchars(strip_tags($this->lastName));
             $this->password = htmlspecialchars(strip_tags($this->password));

            // bind parameter
             $stmt->bindParam(':id', $this->id);
             $stmt->bindParam(':fname', $this->firstName);
             $stmt->bindParam(':lname', $this->lastName);
             $stmt->bindParam(':pass', $this->password);

             if($stmt->execute()){
                 return true;
             } else {
                 printf("Error %s \n", $stmt->error);
                 return false;
             }
        }

        // Validate registeration
        public function validateStudent(){
            $query = "UPDATE $this->table SET registered = 1
            WHERE id =:id ";

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

        // Delete Student
        public function deleteStudent(){
            $query = " DELETE FROM $this->table
            WHERE id =:id AND registered = 0";

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

        // Change student password
        public function changePassword(){
            $query = "UPDATE $this->table SET password = :password
            WHERE id =:id ";

            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));            
            $this->password = htmlspecialchars(strip_tags($this->password));

            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":password", $this->password);

            if($stmt->execute()){
                return true;
            } else {
                printf("Error %s \n", $stmt->error);
                return false;
            }
        }

    }



?>