<?php

session_start();
include_once 'dbconnection.php';

$task_id = $_GET['taskid'];
$project_id = $_SESSION['projectid'];

$sql1 = "SELECT * FROM project_db WHERE projectID = $project_id";
$check_sql = mysqli_query($dbconnection, $sql1);
$sql_result = mysqli_fetch_assoc($check_sql);

$sql = "DELETE FROM task_db WHERE taskID = $task_id";
mysqli_query($dbconnection, $sql);

$count = $sql_result['total_task'];
$count--;

$update_project_task_total = "UPDATE project_db SET total_task = $count  WHERE projectID =$project_id";
mysqli_query($dbconnection, $update_project_task_total);

$_SESSION['message'] = "Task Has Been Deleted";

header('Location: ../system_home/task.php?projectid=' . $project_id);
