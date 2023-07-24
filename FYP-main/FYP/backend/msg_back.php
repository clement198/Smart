<?php

include_once 'dbconnection.php';

$senderID = mysqli_real_escape_string($dbconnection, $_POST['senderid']);
$receiverID = mysqli_real_escape_string($dbconnection, $_POST['receiverid']);
$message = mysqli_real_escape_string($dbconnection, $_POST['msg']);

$msgDate = date('Y-m-d H:i:s');

$temp_file_name = $_FILES['docs']['tmp_name'];
$temp_file = $_FILES['docs']['name'];
$file_name = $temp_file;
move_uploaded_file($temp_file_name, '../backend/user_upload_file/' . $file_name);

if (!empty($message)) {
    $sql = "INSERT INTO msg_db (sender_id , receiver_id , msg , file , send_date) 
    VALUES ('{$senderID}' , '{$receiverID}' ,'{$message}' ,'{$file_name}' , '{$msgDate}') ";
    mysqli_query($dbconnection, $sql);
} else {
    $sql = "INSERT INTO msg_db (sender_id , receiver_id , file , send_date) 
    VALUES ('{$senderID}' , '{$receiverID}' ,'{$file_name}' , '{$msgDate}') ";
    mysqli_query($dbconnection, $sql);
}
