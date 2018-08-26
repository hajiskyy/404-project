<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headsers: Access-Control-Allow-Headsers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With ');

include_once '../../config/Database.php';
include_once '../../models/Submissions.php';

//initialize database
$database = new Database;
$conn = $database->connect();

//initialize submissions
$submissions = new Submissions($conn);

// get data
$taskId = $_POST['task_id'];
$taskName = $_POST['task_name'];
$stdId = $_POST['student_id'];

//create response array
$response = array();

// get previous submission
$submissions->taskId = $taskId;
$submissions->studentId = $stdId;
$result = $submissions->getSingle();
$row = $result->fetch(PDO::FETCH_ASSOC);

if($row){
    $submissions->id = $row['id'];
    $submissions->studentId = $row['student_id'];
    $submissions->taskId = $row['task_id'];
    $submissions->path = $row['path'];
    $submissions->fileName = $row['filename'];
    
    //get file details
    $file_name = basename($_FILES['file']['name']);
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];

    //set folder path
    $path = $submissions->path;

    //   Create path
    if(file_exists("../../$path") != false){
        unlink("../../$path");
    } 

    $path="uploads/$stdId/$taskName/";

    //upload the file
    if(move_uploaded_file($file_loc,"../../$path$file_name")){
            // upload file submission details
            if($submissions->update()){
                echo json_encode(array(
                    "status" => "ok",
                    "msg" => "re submission successfull"
                ));
            } else {
                echo json_encode(array(
                    "status" => "error",
                    "msg" => "Something went Wrong"
                ));
            }

    } else {
        echo json_encode(array(
            "status" => "error",
            "msg" => "Upload Error"
        ));
    }
    
} else {
    $response['status'] = 'error';
    $response['msg'] = 'No submissions';
    // / Convert to JSON
    echo json_encode($response);
}

?>
