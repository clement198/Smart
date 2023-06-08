<?php

session_start();
include_once '../../backend/dbconnection.php';

$projectID = $_GET['projectID'];

$name = mysqli_real_escape_string($dbconnection , $_POST['name']);
$project_type = mysqli_real_escape_string($dbconnection , $_POST['type']);
$start_date = mysqli_real_escape_string($dbconnection , $_POST['sdate']);
$end_date = mysqli_real_escape_string($dbconnection , $_POST['ddate']);


$sql = "UPDATE project_db SET 
    project_name = '$name',
    project_type = '$project_type',
    start_date = '$start_date',
    due_date = '$end_date'
    WHERE projectID = $projectID";
    mysqli_query($dbconnection , $sql);

    header('Location: ../admin_page.php');

?>