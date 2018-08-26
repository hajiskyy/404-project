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

//Grab id in api params
$paramsId = isset($_GET['id']) ? $_GET['id'] : die();
$password = isset($_GET['password']) ? $_GET['password'] : die();

$staffs->id = $paramsId;

//Get student data
$result = $staffs->getStaffById();

// Create response array
$response = array();
$response['msg'] = 'Success';
$response['status'] = 'ok';

//Fetch Data
$row = $result->fetch(PDO::FETCH_ASSOC);

if($row){
    $staffs->id = $row['id'];
    $staffs->firstName = $row['firstName'];
    $staffs->lastName = $row['lastName'];
    $staffs->password = $row['password'];
    $staffs->head= $row['head'];

    //Check Password
    if($password == $staffs->password){
        if($staffs->head == '1'){
            $response['role'] = 'head';
        }

        $response['data'] = array();
        $data = array(
            'id' => $staffs->id,
            'name' => "$staffs->firstName $staffs->lastName",
            'Token' => md5(uniqid(rand(), true))
            );
    
        //push to data
        array_push($response['data'], $data);

    } else {

        $response['status'] = 'error';
        $response['msg'] = 'Wrong Password';
    }
} else {

    $response['status'] = 'error';
    $response['msg'] = 'Account Has Not Been Registered';
}

// Convert to JSON response
print_r(json_encode($response));
?>