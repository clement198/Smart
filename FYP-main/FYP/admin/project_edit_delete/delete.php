<?php

session_start();
include_once '../../backend/dbconnection.php';

$projectID = $_GET['deleteID'];

$sql = "DELETE FROM project_db WHERE projectID = $projectID";
mysqli_query($dbconnection , $sql);

header('Location: ../admin_page.php');

?>