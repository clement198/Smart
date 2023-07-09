<?php

session_start();
include_once 'dbconnection.php';

$task_id = $_GET['task_id'];
$project_id = $_SESSION['projectid'];

$task_name = mysqli_real_escape_string($dbconnection, $_POST['taskName']);
$description = mysqli_real_escape_string($dbconnection, $_POST['description']);
$start_date = mysqli_real_escape_string($dbconnection, $_POST['sdate']);
$due_date = mysqli_real_escape_string($dbconnection, $_POST['ddate']);
$status = mysqli_real_escape_string($dbconnection, $_POST['status']);

$convert_sDate = strtotime($start_date);
$convert_dDate = strtotime($due_date);

function daysCalc($convert_sDate, $convert_dDate)
{
    $calcRange = $convert_dDate - $convert_sDate;
    $days = floor($calcRange / (60 * 60 * 24));
    return $days;
}

$latestDate = date('Y-m-d');
$convert_lDate = strtotime($latestDate);

function daysRemaining($convert_lDate, $convert_dDate)
{
    $calcRemain = $convert_dDate - $convert_lDate;
    $remaining = floor($calcRemain / (60 * 60 * 24));
    return $remaining;
}

$remainResult = daysRemaining($convert_lDate, $convert_dDate);
$daysResult = daysCalc($convert_sDate, $convert_dDate);

$sql = "UPDATE task_db SET 
task_name = '$task_name',
description = '$description',
start_date = '$start_date',
due_date = '$due_date',
days = '$daysResult',
remaining = '$remainResult',
status = '$status'
WHERE taskID = '$task_id'
";
mysqli_query($dbconnection, $sql);

$sql1 = "SELECT * FROM project_db WHERE projectID = $project_id";
$check_sql = mysqli_query($dbconnection, $sql1);
$sql_result = mysqli_fetch_assoc($check_sql);

$sql2 = "SELECT * FROM task_db WHERE status = 'Completed' AND project_id  = $project_id";
$check_sql2 = mysqli_query($dbconnection, $sql2);
$sql_result2 = mysqli_num_rows($check_sql2);

$count = $sql_result2;

if ($sql_result['total_task'] == $count) {
    $update_project_task_total1 = "UPDATE project_db SET completed_task = $count , status = 1 WHERE projectID =$project_id";
    mysqli_query($dbconnection, $update_project_task_total1);
} else {
    $update_project_task_total2 = "UPDATE project_db SET completed_task = $count , status = 0  WHERE projectID =$project_id";
    mysqli_query($dbconnection, $update_project_task_total2);
}



$_SESSION['message'] = "Task Has Been Updated";

header('Location: ../system_home/task.php?projectid=' . $project_id);
