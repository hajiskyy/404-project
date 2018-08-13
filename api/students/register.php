<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headsers: Access-Control-Allow-Headsers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With ');

include_once '../../config/Database.php';
include_once '../../models/Students.php';

//initialize database
$database = new Database;
$conn = $database->connect();

//initialize students
$students = new Students($conn);

$data = json_decode(file_get_contents("php://input"));

$students->id = $data->id;
$students->firstName = $data->firstName;
$students->lastName = $data->lastName;
$students->password = $data->password;

//check if already registered
if(checkStudent($students->id, $students)){
    if($students->register()){
        echo json_encode(array(
            "status" => "success",
            "msg" => "Student Registered"
        ));
    } else {
        echo json_encode(array(
            "status" => "error",
            "msg" => "Something went Wrong"
        ));
    }
} else {
    echo json_encode(array(
        "status" => "error",
        "msg" => "Student has already registered"
    ));
}


// check if student is already registered
 function checkStudent($id, $table){
    $result =  $table->getStudentById($id);
     $row = $result->fetch(PDO::FETCH_ASSOC);
     if($row){
         return false;
     } else {
         return true;
     }
 }
?>