<?php

session_start();
include_once 'dbconnection.php';

$task_id =  $_SESSION['taskid'];
$collab_id = $_GET['collab_id'];

$sql = "DELETE FROM collab_db WHERE colabID = $collab_id";
mysqli_query($dbconnection , $sql);
$_SESSION['message'] = "User Has Been Removed From This Task";

header('Location: ../system_home/task_details.php?taskid='.$task_id);

?>