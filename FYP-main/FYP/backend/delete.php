<?php

session_start();
include_once 'dbconnection.php';

$project_id = $_GET['projectid'];

$sql = "DELETE FROM project_db WHERE projectID = $project_id";
mysqli_query($dbconnection , $sql);
$_SESSION['message'] = "Project Has been Deleted";

header('Location: ../system_home/system_home_page.php');

?>