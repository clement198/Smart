<?php
session_start();
include_once 'dbconnection.php';


$email = mysqli_real_escape_string($dbconnection , $_POST['email']);
$password = mysqli_real_escape_string($dbconnection , $_POST['password']);

if(!empty($email) && !empty($password)){
    $sql = "SELECT * FROM user_db WHERE user_email = '$email' AND user_pass = '$password'";
    $send = mysqli_query($dbconnection , $sql);
    $data = mysqli_fetch_assoc($send);
    $user_id = $data['userID'];
    $unique_id = $data['uniqueID'];

    if($email === 'admin' && $password === 'admin') {
        $admin_sql = "SELECT * FROM user_db WHERE user_email = 'admin' AND user_pass = 'admin'";
        $check = mysqli_query($dbconnection , $admin_sql);
        $result = mysqli_fetch_assoc($check);
        $admin_id = $result['userID'];
        header('Location: ../admin/admin_page.php');
        $_SESSION['admin'] = $admin_id;
    }

    if($email === $data['user_email'] && $password === $data['user_pass'] 
    && $email != 'admin' && $password != 'admin') {
        header('Location: ../system_home/system_home_page.php');
        $_SESSION['id'] = $user_id;
        $_SESSION['unique'] = $unique_id;
        
    }
    else {
        echo "Login unsuccessfully";
    }
    
}

?>