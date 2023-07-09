<?php
session_start();
include_once '../backend/dbconnection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

$code = date('Hi') * rand(2, 10);


if (isset($_POST['submit'])) {

    $email = $_POST['email'];

    $email_sql = "SELECT * FROM user_db WHERE user_email = '$email'";
    $check_email = mysqli_query($dbconnection, $email_sql);


    if (mysqli_num_rows($check_email) > 0) {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'looimihdih@gmail.com';
        $mail->Password   = 'tgbkrqllimnsklci';
        $mail->Port       = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->isHTML(true);
        $mail->setFrom('looimihdih@gmail.com');
        $mail->addAddress($email);
        $mail->Subject = "Please Verify To Change Password";
        $mail->Body = "<p>Verification Code :</p>
        <h1 style='color:#232c3b'> " . $code . "</h1>";
        $mail->send();

        $sql = "INSERT INTO verification_db (email , verification_code) 
VALUES ('{$email}' , '{$code}')";
        mysqli_query($dbconnection, $sql);

        header('Location: verification.php?email=' . $email);
    } else {
        $_SESSION['message'] = "User is not Exits";
        header('Location: ../login/login.php');
    }
}
