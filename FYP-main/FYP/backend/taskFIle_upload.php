<?php

session_start();
include_once 'dbconnection.php';

$task_id = $_GET['task_id'];
$project_id = $_SESSION['projectid'];
$sender_id = $_POST['senderid'];

$temp_file_name = $_FILES['task_file']['tmp_name'];
$file_name = $_FILES['task_file']['name'];
move_uploaded_file($temp_file_name , '../backend/task_upload_file/'.$file_name);

if(!empty($temp_file_name)){
    $sql = "INSERT INTO comment_db (file , senderID , task_id) VALUES ('{$file_name}', '{$sender_id}', {$task_id})";
    mysqli_query($dbconnection , $sql); 
    header('Location: ../system_home/task_details.php?taskid='.$task_id);
}
else {
    header('Location: ../system_home/task_details.php?taskid='.$task_id);
}




// $sql = "SELECT * FROM task_db JOIN project_db
// WHERE project_id = $project_id";
// $check = mysqli_query($dbconnection,$sql);
// $result = mysqli_fetch_assoc($check);

// echo $result['project_name'];



?>