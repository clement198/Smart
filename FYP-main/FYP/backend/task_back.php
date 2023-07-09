<?php

session_start();
include_once 'dbconnection.php';

$project_id = $_GET['projectid'];

$sql1 = "SELECT * FROM project_db WHERE projectID = $project_id";
$check_sql = mysqli_query($dbconnection, $sql1);
$sql_result = mysqli_fetch_assoc($check_sql);

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

if (
    !empty($task_name) && !empty($description)
    && !empty($start_date) && !empty($due_date) && !empty($status)
) {
    $sql = "INSERT INTO task_db (task_name , description, start_date, due_date , days , remaining , status , project_id) 
    VALUES (
        '{$task_name}' ,
        '{$description}' ,
        '{$start_date}' ,   
        '{$due_date}' ,   
        '{$daysResult}' ,   
        '{$remainResult}' ,   
        '{$status}' ,   
        {$project_id}
    )";

    mysqli_query($dbconnection, $sql);

    $count = $sql_result['total_task'];
    $count++;

    $update_project_task_total = "UPDATE project_db SET total_task = $count WHERE projectID =$project_id";
    mysqli_query($dbconnection, $update_project_task_total);

    header('Location: ../system_home/task.php?projectid=' . $project_id);
}
