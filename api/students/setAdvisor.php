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
$students->advisorId = $data->advisor;

if($students->setAdvisor()){
    echo json_encode(array(
        "status" => "ok",
        "msg" => "Student Advisor registered"
    ));
} else {
    echo json_encode(array(
        "status" => "error",
        "msg" => "Something went Wrong"
    ));
}


?>