<?php

session_start();
include_once 'dbconnection.php';

$task_id = $_POST['taskid'];
$project_id = $_SESSION['projectid'];
$comment = mysqli_real_escape_string($dbconnection , $_POST['comment']);
$sender_id = mysqli_real_escape_string($dbconnection , $_POST['senderid']);

if(!empty($comment)){
    $sql = "INSERT INTO comment_db (comment , senderID  , task_id)
    VALUES ('{$comment}' , '{$sender_id}', {$task_id} )";
    mysqli_query($dbconnection , $sql);
}
else {
    header('Location: ../system_home/task_details.php?taskid='.$task_id);
}



// header('Location: ../system_home/task_details.php?taskid='.$task_id);

?>