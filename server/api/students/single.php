<?php
//api headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Students.php';

//initialize database
$database = new Database;
$conn = $database->connect();

//initialize students
$students = new Students($conn);

//Grab id in api params
$paramsId = isset($_GET['id']) ? $_GET['id'] : die();

$students->id = $paramsId;

$result = $students->getStudentById();


// Create student array
$response = array();
$response['data'] = array();
$response['status'] = 'ok';


$row = $result->fetch(PDO::FETCH_ASSOC);

if($row){
    $students->id = $row['id'];
    $students->firstName = $row['firstName'];
    $students->lastName = $row['lastName'];
    $students->advisorId = $row['advisor_id'];
    $students->password = $row['password'];
    $students->registered = $row['registered'];

    $data = array(
        'id' => $students->id,
        'firstName' => $students->firstName,
        'lastName' => $students->lastName,
        'advisor_id' => $students->advisorId,
        'registered' => $students->registered
    );
    
    //push to data
    array_push($response['data'], $data);
    
} else {
    $response['status'] = 'error';
    $response['msg'] = 'No Students';
}

    // Convert to JSON
    print_r(json_encode($response));



?>