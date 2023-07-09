<?php
session_start();
include_once 'dbconnection.php';

$id = $_SESSION['id'];

$name = mysqli_real_escape_string($dbconnection, $_POST['fullname']);
$pass = mysqli_real_escape_string($dbconnection, $_POST['password']);

$temp_file_name = $_FILES['image']['tmp_name'];
$temp_image = $_FILES['image']['name'];
$img_date = date("YmdHis");
$image_name = $img_date . $temp_image;
move_uploaded_file($temp_file_name, '../system_home/user_image/' . $image_name);

if (empty($temp_image)) {
    $sql = "UPDATE user_db SET 
    user_name = '$name',
    user_pass = '$pass'
    WHERE userID = $id";
    mysqli_query($dbconnection, $sql);
} else {
    $sql = "UPDATE user_db SET 
    user_name = '$name',
    user_pass = '$pass',
    user_img = '$image_name'
    WHERE userID = $id";
    mysqli_query($dbconnection, $sql);
}




header('Location: ../system_home/profile.php');
