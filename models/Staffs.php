<?php
class Staffs {

  //database req
  private $conn;
  private $table = 'staffs';
  
  //staff properties
  public $id;
  public $firstName;
  public $lastName;
  public $password;
  public $head;
  
  //constuctor
  public function __construct($db){
      $this->conn = $db;
  }

  // Get staff by Id
  public function getStaffById(){
      $query = "SELECT * from $this->table WHERE id = ?";
      $stmt = $this->conn->prepare($query);
      // Bind Id
      $stmt->bindParam(1, $this->id);
      $stmt->execute();
      return $stmt;
  }

  //Get All Staff
  public function getAllStaff(){
    $query = "SELECT * from $this->table";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }
  // Create Staff Account
  public function createStaff(){
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
  
   // Change staff password
   public function changePassword(){

     //Query
     $query = "UPDATE $this->table SET password = :password
     WHERE id =:id ";

     $stmt = $this->conn->prepare($query);

     // Sanitize
     $this->id = htmlspecialchars(strip_tags($this->id));
     $this->password = htmlspecialchars(strip_tags($this->password));
     
      // set params
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