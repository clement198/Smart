<?php
session_start();
include_once '../backend/dbconnection.php';

$id = $_SESSION['id'];
$user_id = $_GET['userid'];

$sql = "SELECT * FROM user_db WHERE userID = $id";
$check_result = mysqli_query($dbconnection, $sql);
$data = mysqli_fetch_assoc($check_result);

$sql1 = "SELECT * FROM user_db WHERE userID = $user_id";
$check_result1 = mysqli_query($dbconnection, $sql1);
$data1 = mysqli_fetch_assoc($check_result1);

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
    <div class="profile_header">
        <h3>Profile</h3>
    </div>
    <div class="view_profile">


        <div class="name_card">

            <a href="system_dash.php" class="back">
                <i class='bx bx-arrow-back'></i>
            </a>
            <div class="card_img">
                <img src="user_image/<?= $profile_result['user_img'] ?>" alt="">
            </div>

            <div class="card">
                <div class=" card_detail">
                    <h3><?= $profile_result['user_name'] ?></h3>
                    <p><?= $profile_result['department'] ?></p>
                    <p><?= $profile_result['role'] ?></p>
                </div>
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

        <div class="history_table">
            <div class="user_task_history">
                <?php

                if ($data1['role'] == "Manager") {
                    echo "
        <div class='employee_history_task'>
        <div class='history_header'>
            <h3>Project / Task History</h3>
        </div>

        <div class='history'>
            <table>
                <tr>
                    <th>Project Name</th>
                    <th>Project Type</th>
                    <th>Created Date</th>
                    <th>Handles By</th>
                </tr>
                ";

                    $data_per_page = 4;

                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }

                    $default_page = ($page - 1) * 3;


                    $history_sql = "SELECT * FROM history_db 
                JOIN user_db ON user_db.uniqueID = project_owner WHERE uniqueID = $data1[uniqueID] LIMIT $default_page , $data_per_page";
                    $check_history = mysqli_query($dbconnection, $history_sql);
                    if (mysqli_num_rows($check_history) > 0) {
                        while ($history_data = mysqli_fetch_assoc($check_history)) {
                            echo "
                        <tr>
                        <td>" . $history_data['task_name'] . "</td>
                        <td>" . $history_data['task_desc'] . "</td>
                        <td>" . $history_data['hist_date'] . "</td>
                        <td>" . $history_data['user_name'] . "</td>
                        <td>" . $history_data['hist_status'] . "</td>
                        </tr>
                        ";
                        }
                    }


                    echo "</table>
            <div class='pagination'>";
                    $get_page_sql = "SELECT * FROM history_db";
                    $check_page_sql = mysqli_query($dbconnection, $get_page_sql);
                    $page_result = mysqli_num_rows($check_page_sql);
                    $total_page = ceil($page_result / $data_per_page);

                    for ($i = 1; $i < $total_page; $i++) {
                        echo "
                        <div class='page_num'>
                            <a href='task_history.php?page=" . $i . "'>" . $i . "</a>
                            </div>
                            ";
                    }
                    echo "
        </div>

        ";
                } else {
                    echo "
        <div class='employee_history_task'>
        <div class='history_header'>
            <h3>Project / Task History</h3>
        </div>

        <div class='history'>
            <table>
                <tr>
                    <th>Task Name</th>
                    <th>Task Description</th>
                    <th>Assigned Date</th>
                    <th>Assigned By</th>
                    <th>Task Status</th>
                </tr>
                ";
                    $data_per_page = 4;

                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }

                    $default_page = ($page - 1) * 3;

                    $history_sql = "SELECT * FROM history_db 
                JOIN user_db ON user_db.userID = assign_user_id WHERE user_id = $user_id LIMIT $default_page , $data_per_page";
                    $check_history = mysqli_query($dbconnection, $history_sql);
                    if (mysqli_num_rows($check_history) > 0) {
                        while ($history_data = mysqli_fetch_assoc($check_history)) {
                            echo "
                        <tr>
                        <td>" . $history_data['task_name'] . "</td>
                        <td>" . $history_data['task_desc'] . "</td>
                        <td>" . $history_data['hist_date'] . "</td>
                        <td>" . $history_data['user_name'] . "</td>
                        <td>" . $history_data['hist_status'] . "</td>
                        </tr>
                        ";
                        }
                    }


                    echo "</table>
        </div>
        <div class='pagination'>";
                    $get_page_sql = "SELECT * FROM history_db";
                    $check_page_sql = mysqli_query($dbconnection, $get_page_sql);
                    $page_result = mysqli_num_rows($check_page_sql);
                    $total_page = ceil($page_result / $data_per_page);

                    for ($i = 1; $i < $total_page; $i++) {
                        echo "
                        <div class='page_num'>
                        <a href='viewProfile.php?page=" . $i . "&userid=" . $user_id . "'>" . $i . "</a>
                            </div>
                            ";
                    }
                    echo "
        </div>
        ";
                }

                ?>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../home/index.js"></script>
</body>

</html>