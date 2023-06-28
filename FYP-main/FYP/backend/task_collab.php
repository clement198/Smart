<?php

session_start();
include_once 'dbconnection.php';

$task_id = $_GET['taskid'];
$user_id = $_SESSION['userid'];
$assign_userid = $_SESSION['id'];

$sql = "INSERT INTO collab_db (user_id, assign_userid , taskid) 
VALUES({$user_id} , {$assign_userid} , {$task_id})";
mysqli_query($dbconnection , $sql);

$_SESSION['message'] = "User Has Been Added To This Task";
header('Location: ../system_home/task_details.php?taskid='.$task_id);

?>