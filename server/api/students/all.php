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

//Students query
$result = $students->getAllStudents();

//get row count
$num = $result->rowCount();

//check if student exists
if($num > 0){
    // Create student array
    $response = array();
    $response['data'] = array();
    $response['status'] = 'ok';

    while($row = $result->fetch(PDO::FETCH_ASSOC)){

        extract($row); 
        $data = array(
            'id' => $id,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'advisor_id' => $advisor_id,
            'registered' => $registered
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