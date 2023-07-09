<?php

session_start();
include_once 'dbconnection.php';

$user_email = $_GET['email'];
$newPass = $_POST['newpass'];
$rePass = $_POST['repass'];

$sql = "SELECT * FROM user_db WHERE user_email = '$user_email'";
$check_password = mysqli_query($dbconnection, $sql);
$check_pass_result = mysqli_fetch_assoc($check_password);

if ($newPass == $rePass) {
    if ($check_pass_result['user_pass'] == $newPass) {
        $_SESSION['message'] = "Password has been used or the new password same as the old one";
        header('Location: ../system_home/reset_pass.php?email=' . $user_email);
    } else {
        $update_sql = "UPDATE user_db SET user_pass = '$newPass' WHERE userID = '$check_pass_result[userID]'";
        mysqli_query($dbconnection, $update_sql);
        $_SESSION['message'] = "Password Changed Success";
        header('Location: ../login/login.php');
    }
} else {
    $_SESSION['message'] = "Password not match";
    header('Location: ../system_home/reset_pass.php?email=' . $user_email);
}
