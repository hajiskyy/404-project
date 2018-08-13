<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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

// Check if student is registered
if(checkStudent($students->id, $students)){
    if($students->deleteStudent()){
        echo json_encode(array(
            "status" => "success",
            "msg" => "Student Removed"
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
        "msg" => "Cannot Delete a Validated Student"
    ));
}


// Check if student is registered
function checkStudent($id, $table){
    $result =  $table->getStudentById($id);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if($row['registered'] == 1){
        return false;
    } else {
        return true;
    }
}

?>