<?php
//api headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Staffs.php';

//initialize database
$database = new Database;
$conn = $database->connect();

//initialize staffs
$staffs = new Staffs($conn);

//Grab id in params
$paramsId = isset($_GET['id']) ? $_GET['id'] : die();

$staffs->id = $paramsId;

$result = $staffs->getStaffById();


// Create response array
$response = array();
$response['data'] = array();
$response['status'] = 'success';

$row = $result->fetch(PDO::FETCH_ASSOC);

if($row){
    $staffs->id = $row['id'];
    $staffs->firstName = $row['firstName'];
    $staffs->lastName = $row['lastName'];
    $staffs->password = $row['password'];
    $staffs->head = $row['head'];

    $data = array(
        'id' => $staffs->id,
        'firstName' => $staffs->firstName,
        'lastName' => $staffs->lastName,
        'head' => $staffs->head
    );
    
    //push to data
    array_push($response['data'], $data);
    
} else {
    $response['status'] = 'error';
    $response['msg'] = 'No staff';
}

    // Convert to JSON
    print_r(json_encode($response));



?>