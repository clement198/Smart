<?php

session_start();
include_once 'dbconnection.php';

$task_id = $_GET['taskid'];
$user_id = $_SESSION['userid'];
$assign_userid = $_SESSION['id'];

$sql = "INSERT INTO collab_db (user_id, assign_userid , taskid) 
VALUES({$user_id} , {$assign_userid} , {$task_id})";
mysqli_query($dbconnection, $sql);

$take_task_sql = "SELECT * FROM task_db WHERE taskID = $task_id";
$check_task_sql = mysqli_query($dbconnection, $take_task_sql);
$result_task = mysqli_fetch_assoc($check_task_sql);

$create_history_sql = "INSERT INTO history_db (task_name , task_desc  , hist_status , hist_date , user_id ,assign_user_id)
VALUES ('{$result_task['task_name']}' , '{$result_task['description']}' ,
'{$result_task['status']}', '{$result_task['start_date']}'  , {$user_id} , {$assign_userid})";
mysqli_query($dbconnection, $create_history_sql);


$_SESSION['message'] = "User Has Been Added To This Task";
header('Location: ../system_home/task_details.php?taskid=' . $task_id);
