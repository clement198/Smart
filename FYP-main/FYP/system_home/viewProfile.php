<?php
session_start();
include_once '../backend/dbconnection.php';

$id = $_SESSION['id'];
$user_id = $_GET['userid'];

$sql = "SELECT * FROM user_db WHERE userID = $id";
$check_result = mysqli_query($dbconnection, $sql);
$data = mysqli_fetch_assoc($check_result);

if (empty($id)) {
    header('Location:../login/login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../home/index.css">
    <link rel="stylesheet" href="notification.css">
    <!-- Google Font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dongle:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Font  -->
    <!-- Icon package -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>User Profile</title>
</head>

<body>

    <?php

    $profile_sql = "SELECT * FROM user_db WHERE userID = $user_id";
    $check_profile = mysqli_query($dbconnection, $profile_sql);
    $profile_result = mysqli_fetch_assoc($check_profile);

    ?>

    <div class="view_profile">
        <div class="name_card">
            <a href="system_dash.php" class="revert">
                <img width="30" height="30" src="https://img.icons8.com/ios/50/000000/circled-left-2.png" alt="circled-left-2" />
            </a>
            <div class="card_img">
                <img src="user_image/<?= $profile_result['user_img'] ?>" alt="">
            </div>
            <div class=" card_detail">
                <h3><?= $profile_result['user_name'] ?></h3>
                <p><?= $profile_result['user_email'] ?></p>
                <p><?= $profile_result['department'] ?></p>
                <p><?= $profile_result['role'] ?></p>
            </div>
            <?php


            $sql = "SELECT * FROM user_db WHERE userID = '$user_id'";
            $check = mysqli_query($dbconnection, $sql);
            $result = mysqli_fetch_assoc($check);

            $addUser_sql = "SELECT * FROM userlist_db WHERE chat_ownerid = $id";
            $check_addUser_sql = mysqli_query($dbconnection, $addUser_sql);

            $status = "not added";

            while ($addUser_sql_result = mysqli_fetch_assoc($check_addUser_sql)) {
                if ($addUser_sql_result['added_userid'] == $result['userID']) {
                    $status = "added";
                    if ($status == "added") {
                        break;
                    }
                } else {
                    $status = "not added";
                }
            }

            if ($status == "not added") {

                echo "
                <a class='send' href='../backend/add_user.php?userid=" . $user_id . "'>Send Message<i class='bx bxs-send bx-fade-right' style='color:#fffbfb'></i></a>
                ";
            }

            ?>

        </div>
    </div>

    <script type="text/javascript" src="../home/index.js"></script>
</body>

</html>