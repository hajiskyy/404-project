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
$studentId = isset($_GET['student_id']) ? $_GET['student_id'] : die();
$taskId = isset($_GET['task_id']) ? $_GET['task_id']: die();

$submissions->studentId = $studentId;
$submissions->taskId = $taskId;

$result = $submissions->check();

// Create response array
$response = array();
$response['status'] = 'ok';


$row = $result->fetch(PDO::FETCH_ASSOC);

// if data exists
if($row){
    $response['submitted'] = true;
} else {
    $response['status'] = 'error';
    $response['submitted'] = false;
}

    // Convert to JSON
    print_r(json_encode($response));



?>