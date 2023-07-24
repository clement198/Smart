<?php
session_start();
include_once 'dbconnection.php';

$task_id = $_GET['task_id'];
$project_id = $_SESSION['projectid'];

$sql1 = "SELECT * FROM project_db WHERE projectID = $project_id";
$check_sql = mysqli_query($dbconnection, $sql1);
$sql_result = mysqli_fetch_assoc($check_sql);

$sql = "UPDATE task_db SET recycle = 0 WHERE taskID = $task_id";
mysqli_query($dbconnection, $sql);

$sql2 = "SELECT * FROM task_db WHERE status = 'Completed' AND project_id  = $project_id";
$check_sql2 = mysqli_query($dbconnection, $sql2);
$sql_result2 = mysqli_num_rows($check_sql2);

$count = $sql_result['total_task'];
$count++;

$update_project_task_total = "UPDATE project_db SET total_task = $count  WHERE projectID = $project_id";
mysqli_query($dbconnection, $update_project_task_total);

$count1 = $sql_result2;

if ($count == $count1) {
    $update_project_task_total1 = "UPDATE project_db SET completed_task = $count1 , status = 1 WHERE projectID =$project_id";
    mysqli_query($dbconnection, $update_project_task_total1);
} else {
    $update_project_task_total2 = "UPDATE project_db SET completed_task = $count1 , status = 0 WHERE projectID =$project_id";
    mysqli_query($dbconnection, $update_project_task_total2);
}


header('Location: ../system_home/task.php?projectid=' . $project_id);
