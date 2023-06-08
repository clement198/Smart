<?php

include_once 'dbconnection.php';

$send_id = mysqli_real_escape_string($dbconnection , $_POST['senderid']);
$receive_id = mysqli_real_escape_string($dbconnection , $_POST['receiverid']);


 // Take Message from DB
$msg_sql = "SELECT * FROM msg_db WHERE sender_id = $send_id AND receiver_id = $receive_id 
OR sender_id = $receive_id AND receiver_id = $send_id";
$check_msg = mysqli_query($dbconnection , $msg_sql);

//sender Image
$sql = "SELECT user_img FROM user_db WHERE uniqueID = $send_id";
$check_query = mysqli_query($dbconnection , $sql);
$sender = mysqli_fetch_assoc($check_query);

//receiver Image
$sql = "SELECT user_img FROM user_db WHERE uniqueID = $receive_id";
$check_query = mysqli_query($dbconnection , $sql);
$receiver = mysqli_fetch_assoc($check_query);

if(mysqli_num_rows($check_msg) > 0){
    while($msg = mysqli_fetch_assoc($check_msg)){
        if($msg['sender_id'] === $send_id){
            if($msg['msg'] != ''){
                echo " <div class='send'>
                <p>".$msg['msg']."</p>
                <img src='../system_home/user_image/".$sender['user_img']."'>
            </div>";
            }
            
        if($msg['file'] != null || $msg['file'] != ''){
            echo " <div class='send'>
            <a href='../backend/user_upload_file/".$msg['file']."' download='".$msg['file']."'>".$msg['file']."
            <i class='bx bxs-download'></i>
            </a>
            <img src='../system_home/user_image/".$sender['user_img']."'>
        </div>";
        }
        }else {
            if($msg['msg'] != ''){
                echo "<div class='receive'>
                <img src='../system_home/user_image/".$receiver['user_img']."'>
                <p>".$msg['msg']."</p>
                </div>";
            }
            
            if($msg['file'] != null || $msg['file'] != ''){
                echo "<div class='receive'>
            <img src='../system_home/user_image/".$receiver['user_img']."'>
            <a href='../backend/user_upload_file/".$msg['file']."' download='".$msg['file']."'>".$msg['file']."
            <i class='bx bxs-download'></i>
            </a>
            </div>";
            }
        }

        // if($msg['file'] != null) {
        //     echo " <div class='send'>
        //     <a href='../backend/user_upload_file/".$msg['file']."' download='".$msg['file']."'>".$msg['file']."</a>
        //     <img src='../system_home/user_image/".$sender['user_img']."'>
        // </div>";
        // }else {
        //     echo "<div class='receive'>
        //     <img src='../system_home/user_image/".$receiver['user_img']."'>
        //         <p>".$msg['file']."</p>
        //     </div>";
        // }
    }
}
?>