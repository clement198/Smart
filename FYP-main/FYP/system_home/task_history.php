<?php
session_start();
include_once '../backend/dbconnection.php';

$id = $_SESSION['id'];
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
    <!-- Google Font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dongle:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- Google Font  -->
    <!-- Icon package -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>History-Smart</title>
</head>

<body>
    <header class="top-bar">
        <div class="user_bar">
            <a href="#" onclick="profileDrop()"><img src="../system_home/user_image/<?= $data['user_img'] ?>" alt=""></a>
            <li><a class="logout" href="../backend/logout.php">Logout<i class='bx bx-log-out'></i></a></li>
        </div>
        <div class="profile_dropdown">
            <a href="profile.php">My Profile</a>
            <a href="task_history.php">My Project / Task History</a>
        </div>
        <div class="location">
            <h3>Task History</h3>
        </div>
    </header>
    <div class="side-bar">
        <div class="brand">
            <a href="#">
                <img src="../home/logo3.png" alt="">
            </a>
        </div>
        <ul class="menu-list">
            <li><a href="system_dash.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="system_home_page.php"><i class='bx bx-world'></i>Project Management</a></li>
            <li><a href="calender.php"><i class='bx bxs-calendar'></i>Calender</a></li>
            <li><a href="system_chat.php"><i class='bx bxs-chat'></i>Chat</a></li>
        </ul>
    </div>
    <div class="employee_history">


        <?php

        if ($data['role'] == "Manager") {
            echo "
        <div class='employee_history_task'>
        <div class='history_header'>
            <h3>Your Task History</h3>
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

            $data_per_page = 3;

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }

            $default_page = ($page - 1) * 3;


            $history_sql = "SELECT * FROM history_db 
                JOIN user_db ON user_db.uniqueID = project_owner WHERE uniqueID = $data[uniqueID] LIMIT $default_page , $data_per_page";
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
            <h3>Your Task History</h3>
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
            $data_per_page = 3;

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }

            $default_page = ($page - 1) * 3;

            $history_sql = "SELECT * FROM history_db 
                JOIN user_db ON user_db.userID = assign_user_id WHERE user_id = $id LIMIT $default_page , $data_per_page";
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

            for ($i = 1; $i <= $total_page; $i++) {
                echo "
                        <div class='page_num'>
                            <a href='task_history.php?page=" . $i . "'>" . $i . "</a>
                            </div>
                            ";
            }
            echo "
        </div>
        ";
        }

        ?>

    </div>











    <script type="text/javascript" src="../home/index.js"></script>
    <script type="text/javascript" src="../home/profileDropdown.js"></script>
</body>

</html>