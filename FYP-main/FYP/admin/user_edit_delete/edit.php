<?php

session_start();
include_once '../../backend/dbconnection.php';

$userID = $_GET['userID'];

$name = mysqli_real_escape_string($dbconnection , $_POST['name']);
$password = mysqli_real_escape_string($dbconnection , $_POST['pass']);
$email = mysqli_real_escape_string($dbconnection , $_POST['email']);
$company = mysqli_real_escape_string($dbconnection , $_POST['company']);
$role = mysqli_real_escape_string($dbconnection , $_POST['role']);

$sql = "UPDATE user_db SET 
    user_name = '$name',
    user_email = '$email',
    user_pass = '$password',
    company_name = '$company',
    role = '$role'
    WHERE userID = $userID";
    mysqli_query($dbconnection , $sql);

    header('Location: ../admin_page.php');

?>