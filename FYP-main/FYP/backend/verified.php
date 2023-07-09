<?php

session_start();
include_once 'dbconnection.php';

$user_email = $_GET['email'];
$verification_code = $_POST['verification'];

$sql = "SELECT * FROM verification_db WHERE email = '$user_email' AND verification_code = '$verification_code'";
$check_verification = mysqli_query($dbconnection, $sql);
$verification_result = mysqli_fetch_assoc($check_verification);

if ($verification_result['verification_code'] == $verification_code) {

    header('Location: ../system_home/reset_pass.php?email=' . $user_email);
} else {
    $_SESSION['message'] = "Invalid Verification Code";
    header('Location: ../system_home/verification.php?email=' . $user_email);
}
