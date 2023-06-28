<?php
session_start();
include_once 'dbconnection.php';

$project_id = $_GET['projectid'];

$projectName = mysqli_real_escape_string($dbconnection , $_POST['projectName']);
$projectType = mysqli_real_escape_string($dbconnection , $_POST['type']);
$start_date = mysqli_real_escape_string($dbconnection , $_POST['sdate']);
$end_date = mysqli_real_escape_string($dbconnection , $_POST['ddate']);

$sql = "UPDATE project_db SET 
    project_name = '$projectName',
    project_type = '$projectType',
    start_date = '$start_date',
    due_date = '$end_date'
    WHERE projectID = $project_id";
    mysqli_query($dbconnection , $sql);
    $_SESSION['message'] = "Project Has been Updated";

    header('Location: ../system_home/system_home_page.php');

?>