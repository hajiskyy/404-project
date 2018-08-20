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

$file_name = basename($_FILES['file']['name']);
$file_loc = $_FILES['file']['tmp_name'];
$file_size = $_FILES['file']['size'];
$file_type = $_FILES['file']['type'];

//set folder path
$path="uploads/$stdId/$taskName/";

//   Create path
if(file_exists("../../$path") == false){
 mkdir("../../$path",0777,true);
} 

//upload the file
if(move_uploaded_file($file_loc,"../../$path$file_name")){
    // set origin path
    $path = "$path$file_name";
    
    // assign file
    $submissions->taskId = $taskId;
    $submissions->studentId = $stdId;
    $submissions->fileName = $file_name;
    $submissions->path = $path;

    // upload file submission details
    if($submissions->create()){
            echo json_encode(array(
                "status" => "ok",
                "msg" => "submission successfull"
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

?>
