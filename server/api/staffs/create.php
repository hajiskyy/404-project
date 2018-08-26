<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headsers: Access-Control-Allow-Headsers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With ');

include_once '../../config/Database.php';
include_once '../../models/Staffs.php';

//initialize database
$database = new Database;
$conn = $database->connect();

//initialize staffs
$staffs = new Staffs($conn);

$data = json_decode(file_get_contents("php://input"));

$staffs->id = $data->id;
$staffs->firstName = $data->firstName;
$staffs->lastName = $data->lastName;
$staffs->password = $data->password;

//check if already registered
if(checkStaff($staffs->id, $conn)){
    if($staffs->createStaff()){
        echo json_encode(array(
            "status" => "success",
            "msg" => "New Account Created"
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
        "msg" => "Staff Account Already Exisits"
    ));
}


// check if staff account already exists
 function checkStaff($id, $conn){
    $staff = new Staffs($conn);
    $staff->id = $id;
    $result =  $staff->getStaffById();
     $row = $result->fetch(PDO::FETCH_ASSOC);
     if($row){
         return false;
     } else {
         return true;
     }
 }