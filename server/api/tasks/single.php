<?php
//api headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Tasks.php';

//initialize database
$database = new Database;
$conn = $database->connect();

//initialize tasks
$tasks = new Tasks($conn);

//Grab id in api params
$paramsId = isset($_GET['id']) ? $_GET['id'] : die();

$tasks->id = $paramsId;

$result = $tasks->getSingle();


// Create tasks array
$response = array();
$response['data'] = array();
$response['status'] = 'ok';


$row = $result->fetch(PDO::FETCH_ASSOC);

if($row){
    $tasks->id = $row['id'];
    $tasks->name = $row['name'];
    $tasks->description = $row['description'];
    $tasks->due = $row['due'];


    $data = array(
        'id' => $tasks->id,
        'name' => $tasks->name,
        'description' => $tasks->description,
        'due' => $tasks->due
    );
    
    //push to data
    array_push($response['data'], $data);
    
} else {
    $response['status'] = 'error';
    $response['msg'] = 'No tasks';
}

    // Convert to JSON
    print_r(json_encode($response));



?>