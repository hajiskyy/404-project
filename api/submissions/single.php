<?php
//api headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Submissions.php';

//initialize database
$database = new Database;
$conn = $database->connect();

//initialize tasks
$submissions = new Submissions($conn);

//Grab id in api params
$paramsId = isset($_GET['id']) ? $_GET['id'] : die();

$submissions->studentId = $paramsId;

$result = $submissions->getSingle();


// Create response array
$response = array();
$response['data'] = array();
$response['status'] = 'ok';


$row = $result->fetch(PDO::FETCH_ASSOC);

if($row){
    $submissions->id = $row['id'];
    $submissions->path = $row['path'];
    $submissions->fileName = $row['filename'];

    $data = array(
        'id' => $submissions->id,
        'path' => $submissions->path,
        'filename' => $submissions->fileName
    );
    
    //push to data
    array_push($response['data'], $data);
    
} else {
    $response['status'] = 'error';
    $response['msg'] = 'No submissions';
}

    // Convert to JSON
    print_r(json_encode($response));



?>