<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headsers: Access-Control-Allow-Headsers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With ');

include_once '../../config/Database.php';
include_once '../../models/Attendance.php';

//initialize database
$database = new Database;
$conn = $database->connect();

//initialize attendance
$attendance = new Attendance($conn);

$data = json_decode(file_get_contents("php://input"));

$attendance->id = $data->id;
$attendance->studentId = $data->student_id;
$attendance->advisorId = $data->advisor_id;
$attendance->week = $data->week;
$attendance->attended = $data->attended;

if($attendance->put()){
    echo json_encode(array(
        "status" => "ok",
        "msg" => "Attendace Saved"
    ));
} else {
    echo json_encode(array(
        "status" => "error",
        "msg" => "Something went Wrong"
    ));
}
