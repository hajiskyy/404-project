<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
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
$staffs->password = $data->password;

if($staffs->changePassword()){
    echo json_encode(array(
        "status" => "success",
        "msg" => "Password Changed"
    ));
} else {
    echo json_encode(array(
        "status" => "error",
        "msg" => "Something went Wrong"
    ));
}
?>