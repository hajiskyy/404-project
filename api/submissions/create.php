<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headsers: Access-Control-Allow-Headsers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With ');

include_once '../../config/Database.php';
include_once '../../models/Submissions.php';

//initialize database
$database = new Database;
$conn = $database->connect();

//initialize submissions
$submissions = new Submissions($conn);

// get data
$data = json_decode(file_get_contents("php://input"));

// assign data
$submissions->taskId = $data->task_id;
$submissions->studentId = $data->student_id;
$submissions->fileName = $data->filename;
$submissions->path = $data->path;

if($submissions->create()){
    echo json_encode(array(
        "status" => "ok",
        "msg" => "submission successfull"
    ));
} else {
    echo json_encode(array(
        "status" => "error",
        "msg" => "Something went Wrong"
    ));
}
