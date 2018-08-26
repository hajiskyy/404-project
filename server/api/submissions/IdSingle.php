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

$result = $submissions->getStudentSubmission();

// get row count
$num = $result->rowCount();

//check if submission exists
if($num > 0){
    // Create response array
    $response = array();
    $response['data'] = array();
    $response['status'] = 'ok';

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $data = array(
            'id' => $id,
            'path' => $path,
            'filename' => $filename,
            'student_id' =>$student_id,
            'task_id' => $task_id
        );
        
        //push to data
        array_push($response['data'], $data);
    }

    // Convert to JSON
    echo json_encode($response);

} else {
    echo json_encode(array('status' => 'error','msg'=> 'No Students'));
}


?>