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

        // Get All Students
        public function getAllStudents(){
            $query = "SELECT * from $this->table";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

    }



?>