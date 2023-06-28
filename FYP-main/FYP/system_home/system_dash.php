<?php
session_start();
include_once '../backend/dbconnection.php';

$id = $_SESSION['id'];

$sql = "SELECT * FROM user_db WHERE userID = $id";
$check_result = mysqli_query($dbconnection ,$sql);
$data = mysqli_fetch_assoc($check_result);

if(empty($id)){
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
    <title>Dashboard-Smart</title>
</head>
<body>
    <header class="top-bar">
        <div class="user_bar">
        <a href="profile.php"><img src="../system_home/user_image/<?=$data['user_img']?>" alt=""></a>
        <li><a class="logout" href="../backend/logout.php">Logout<i class='bx bx-log-out'></i></a></li>
        </div>
        <div class="location">
            <h3>Dashboard</h3>
        </div>
    </header>
    <div class="side-bar">
        <div class="brand">
            <a href="#">
                <img src="../home/logo3.png" alt="">
            </a>
        </div>
        <ul class="menu-list">
        <li><a href="system_home_page.php"><i class='bx bxs-home' ></i>Project Management</a></li>
            <li><a href="#" class="active"><i class='bx bxs-dashboard' ></i>Dashboard</a></li>
            <li><a href="calender.php"><i class='bx bxs-chat' ></i>Calender</a></li>
            <li><a href="system_chat.php"><i class='bx bxs-chat' ></i>Chat</a></li>
            <li><a href="#"><i class='bx bxs-group' ></i>Team Member</a></li>
        </ul>
    </div>

    <div class="dashboard-container">
        
    </div>

<script type="text/javascript" src="../home/index.js"></script>
</body>
</html>