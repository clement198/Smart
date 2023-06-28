<?php

session_start();
include_once 'dbconnection.php';

$task_id = $_GET['taskid'];
$project_id = $_SESSION['projectid'];

$sql = "DELETE FROM task_db WHERE taskID = $task_id";
mysqli_query($dbconnection , $sql);
$_SESSION['message'] = "Task Has Been Deleted";

header('Location: ../system_home/task.php?projectid='.$project_id);

?>