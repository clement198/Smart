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
    <title>Profile-Smart</title>
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
            <h3>Profile</h3>
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
            <li><a href="calender.php"><i class='bx bxs-calendar'></i>Calendar</a></li>
            <li><a href="system_chat.php"><i class='bx bxs-chat'></i>Chat</a></li>
        </ul>
    </div>

    <div class="profile_details">
        <div class="profile">
            <div class="user_detail_header">
                <h3>Profile</h3>
            </div>
            <form action="../backend/profile_edit.php" method="POST" enctype="multipart/form-data">
                <div class="user_img">
                    <img src="user_image/<?= $data['user_img'] ?>" id="profile_img">
                    <input type="file" accept="image/png , image/jpeg" name="image" onchange="imgChange()" id="upload">
                    <div class="upload">
                        <label for="upload">Upload</label>
                    </div>

                </div>

                <div class="detail_input">

                    <label for="name">Full Name :</label>
                    <input type="text" name="fullname" value="<?= $data['user_name'] ?>" required>

                    <label for="name">Password :</label>
                    <input type="password" name="password" value="<?= $data['user_pass'] ?>" required>

                    <label for="email">Email :</label>
                    <p><?= $data['user_email'] ?></p>

                    <label for="com">Company Name :</label>
                    <p><?= $data['company_name'] ?></p>

                    <label for="role">Role / Position :</label>
                    <p><?= $data['role'] ?></p>

                    <input type="submit" class="saveBtn" value="Save">

                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="../home/index.js"></script>
    <script type="text/javascript" src="../home/profileDropdown.js"></script>
</body>

</html>