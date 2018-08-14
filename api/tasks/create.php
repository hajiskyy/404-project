<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headsers: Access-Control-Allow-Headsers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With ');

include_once '../../config/Database.php';
include_once '../../models/Tasks.php';

//initialize database
$database = new Database;
$conn = $database->connect();

//initialize staffs
$tasks = new Tasks($conn);

$data = json_decode(file_get_contents("php://input"));

$tasks->name = $data->name;
$tasks->description = $data->description;
$tasks->due = $data->due;

if($tasks->create()){
    echo json_encode(array(
        "status" => "ok",
        "msg" => "New Task Added"
    ));
} else {
    echo json_encode(array(
        "status" => "error",
        "msg" => "Something went Wrong"
    ));
}
