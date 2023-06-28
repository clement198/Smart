<?php
session_start();
include_once 'dbconnection.php';

$name = mysqli_real_escape_string($dbconnection , $_POST['username']);
$email = mysqli_real_escape_string($dbconnection , $_POST['email']);
$password = mysqli_real_escape_string($dbconnection , $_POST['pass']);
$department = mysqli_real_escape_string($dbconnection , $_POST['department']);
$role = mysqli_real_escape_string($dbconnection , $_POST['role']);
$unique = date('YmdHis');
if(!empty($name) && !empty($email) && !empty($password) && !empty($department) && !empty($role)) {

    if(filter_var($email , FILTER_VALIDATE_EMAIL)){
        $check_email = "SELECT user_email FROM user_db WHERE user_email = '$email'";
        $send_sql1 = mysqli_query($dbconnection , $check_email);
        $check_email_result = mysqli_num_rows($send_sql1);

        if($check_email_result < 1){

            $check_pass = "SELECT user_pass FROM user_db WHERE user_pass = '$password'";
            $send_sql2 = mysqli_query($dbconnection , $check_pass);
            $check_pass_result = mysqli_num_rows($send_sql2);

            if($check_pass_result < 1){
                $sql = "INSERT INTO user_db(uniqueID , user_name , user_email , user_pass , department , role) 
                VALUES ('{$unique}','{$name}','{$email}' , '{$password}' , '{$department}' , '{$role}')";
                mysqli_query($dbconnection , $sql);
                header('Location:../login/login.php');
                $_SESSION['message'] = "Register successfully";
            }
            else {
                echo 'Password has been use';
            }
        }
        else {
            echo 'Email has been used';
        }
    }
    else {
        echo 'Invalid Email Format';
    }
}

?>