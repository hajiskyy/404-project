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

//Staffs query
$result = $staffs->getAllStaff();

//get row count
$num = $result->rowCount();

//check staffs exists
if($num > 0){
    // Create response array
    $response = array();
    $response['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){

        extract($row); 
        $data = array(
            'id' => $id,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'head' => $head
        );

        $response['status'] = 'success';
        //push to data
        array_push($response['data'], $data);

    }
    // Convert to JSON
    echo json_encode($response);

} else {
    echo json_encode(array('status' => 'error', 'msg'=> 'No Students'));
}

?>