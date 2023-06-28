<?php
session_start();
include_once 'dbconnection.php';

if(isset($_POST['submit']))

$projectName = mysqli_real_escape_string($dbconnection , $_POST['projectName']);
$projectType = mysqli_real_escape_string($dbconnection , $_POST['type']);
$start_date = mysqli_real_escape_string($dbconnection , $_POST['sdate']);
$end_date = mysqli_real_escape_string($dbconnection , $_POST['ddate']);
$owner_id = mysqli_real_escape_string($dbconnection , $_POST['ownerid']);

$sql = "INSERT INTO project_db(project_name , project_type , start_date , due_date , ownerID) 
VALUES ('{$projectName}' , 
'{$projectType}' , 
'{$start_date}' , 
'{$end_date}' ,
'{$owner_id}')";
mysqli_query($dbconnection , $sql);
$_SESSION['message'] = "Project Created !";

header('Location: ../system_home/system_home_page.php');

?>