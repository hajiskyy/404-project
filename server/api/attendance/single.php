<?php
//api headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Attendance.php';

//initialize database
$database = new Database;
$conn = $database->connect();

//initialize attendance
$attendance = new Attendance($conn);

//Grab id in api params
$paramsId = isset($_GET['id']) ? $_GET['id'] : die();

$attendance->studentId = $paramsId;

$result = $attendance->single();


// Create attendance array
$response = array();
$response['data'] = array();
$response['status'] = 'ok';


$row = $result->fetch(PDO::FETCH_ASSOC);

if($row){
    extract($row); 
    $data = array(
        'id' => $id,
        'student_id' => $student_id,
        'advisor_id' => $advisor_id,
        'week' => $week,
        'total' => $total,
        'attended' => $attended
    );
    
    //push to data
    array_push($response['data'], $data);
    
} else {
    $response['status'] = 'error';
    $response['msg'] = 'No attendance';
}

    // Convert to JSON
    print_r(json_encode($response));



?>