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

//tasks query
$result = $tasks->getAllTasks();

//get row count
$num = $result->rowCount();

//check tasks exists
if($num > 0){
    // Create response array
    $response = array();
    $response['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){

        extract($row); 
        $data = array(
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'due' => $due
        );

        $response['status'] = 'ok';
        //push to data
        array_push($response['data'], $data);

    }
    // Convert to JSON
    echo json_encode($response);

} else {
    echo json_encode(array('status' => 'error', 'msg'=> 'No Tasks'));
}

?>