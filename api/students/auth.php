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

//Grab id in api params
$paramsId = isset($_GET['id']) ? $_GET['id'] : die();
$password = isset($_GET['password']) ? $_GET['password'] : die();

$students->id = $paramsId;

//Get student data
$result = $students->getStudentById();

// Create response array
$response = array();
$response['msg'] = 'Success';
$response['status'] = 'ok';

//Fetch Data
$row = $result->fetch(PDO::FETCH_ASSOC);

if($row){
    $students->id = $row['id'];
    $students->firstName = $row['firstName'];
    $students->lastName = $row['lastName'];
    $students->advisorId = $row['advisor_id'];
    $students->password = $row['password'];
    $students->registered = $row['registered'];


    //If students is not registered
    if($students->registered == 1){
        //Check Password
        if($password == $students->password){

            $response['data'] = array();
            $data = array(
                'id' => $students->id,
                'name' => $students->firstName+ ""+$students->lastName,
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
        $response['msg'] = 'Student is not Registered';
    }
} else {

    $response['status'] = 'error';
    $response['msg'] = 'Account Has Not Been Registered';
}

// Convert to JSON response
print_r(json_encode($response));
?>