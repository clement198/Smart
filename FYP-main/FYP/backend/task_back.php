<?php

session_start();
include_once 'dbconnection.php';

$project_id = $_GET['projectid'];

$task_name = mysqli_real_escape_string($dbconnection , $_POST['taskName']);
$description = mysqli_real_escape_string($dbconnection , $_POST['description']);
$start_date = mysqli_real_escape_string($dbconnection , $_POST['sdate']);
$due_date = mysqli_real_escape_string($dbconnection , $_POST['ddate']);
$status = mysqli_real_escape_string($dbconnection , $_POST['status']);

$convert_sDate = strtotime($start_date);
$convert_dDate = strtotime($due_date);

function daysCalc ($convert_sDate , $convert_dDate){
    $calcRange = $convert_dDate - $convert_sDate;
    $days = floor($calcRange / (60 * 60 * 24));
    return $days;
}


$daysResult = daysCalc($convert_sDate , $convert_dDate);

if(!empty($task_name) && !empty($description) 
&&!empty($start_date) && !empty($due_date) && !empty($status)){
    $sql = "INSERT INTO task_db (task_name , description, start_date, due_date , days , status , project_id) 
    VALUES (
        '{$task_name}' ,
        '{$description}' ,
        '{$start_date}' ,   
        '{$due_date}' ,   
        '{$daysResult}' ,   
        '{$status}' ,   
        {$project_id}
    )";

    mysqli_query($dbconnection , $sql);
    header('Location: ../system_home/task.php?projectid='.$project_id);
}





?>