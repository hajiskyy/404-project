<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headsers: Access-Control-Allow-Headsers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With ');

include_once '../../config/Database.php';
include_once '../../models/Tasks.php';

//initialize database
$database = new Database;
$conn = $database->connect();

//initialize students
$tasks = new Tasks($conn);
$data = json_decode(file_get_contents("php://input"));

$tasks->id = $data->id;

if($tasks->delete()){
    echo json_encode(array(
        "status" => "ok",
        "msg" => "Task Deleted"
    ));
} else {
    echo json_encode(array(
        "status" => "error",
        "msg" => "Something went Wrong"
    ));
}
?>