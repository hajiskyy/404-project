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

//attendance query
$result = $attendance->getAll();

//get row count
$num = $result->rowCount();

//check attendance exists
if($num > 0){
    // Create response array
    $response = array();
    $response['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){

        extract($row); 
        $data = array(
            'id' => $id,
            'student_id' => $student_id,
            'advisor_id' => $advisor_id,
            'week' => $week,
            'total' => $total,
            'attended' => $attended
        );

        $response['status'] = 'ok';
        //push to data
        array_push($response['data'], $data);

    }
    // Convert to JSON
    echo json_encode($response);

} else {
    echo json_encode(array('status' => 'error', 'msg'=> 'No attendance'));
}

?>