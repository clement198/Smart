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


$event_sql = "SELECT * FROM event_db";
$check_event = mysqli_query($dbconnection, $event_sql);


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
    <!-- Google Font  -->
    <!-- Icon package -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Dashboard-Smart</title>
</head>

<body>
    <header class="top-bar">
        <div class="user_bar">
            <a href="profile.php"><img src="../system_home/user_image/<?= $data['user_img'] ?>" alt=""></a>
            <li><a class="logout" href="../backend/logout.php">Logout<i class='bx bx-log-out'></i></a></li>
        </div>
        <div class="location">
            <h3>Calender</h3>
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
            <li><a href="#" class="active"><i class='bx bxs-calendar'></i>Calender</a></li>
            <li><a href="system_chat.php"><i class='bx bxs-chat'></i>Chat</a></li>
        </ul>
    </div>

    <div class="calender">
        <div class="month_year">
            <i class='bx bx-chevron-left' id="left" onclick="prevMonth()"></i>
            <h1 class="month"></h1>
            <h2 class="year"></h2>
            <i class='bx bx-chevron-right' id="right" onclick="nextMonth()"></i>

            <div class="features">
                <i class='bx bx-list-ul' onclick="eventDisplay()"></i>
                <i class='bx bx-plus-circle' onclick="addEvent()"></i>
            </div>

        </div>

        <div class="weekdays">
            <div>Sun</div>
            <div>Mon</div>
            <div>Tue</div>
            <div>Wed</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>
        </div>

        <div class="days">
        </div>
    </div>

    <div class="event_display">
        <div class="event_heading">
            <h3>Upcoming Events</h3>
            <i class='bx bx-chevrons-right bx-burst' onclick="eventDisplay()"></i>
        </div>

        <?php
        if (mysqli_num_rows($check_event) > 0) {
            while ($event_data_result = mysqli_fetch_assoc($check_event)) {
                echo "
            <div class='event_details'>
                <div class='event_card'>
                    <i class='bx bx-dots-vertical-rounded menu-dot' onclick='dropDown(this)'></i>
                    <div class='drop-down'>
                    <a href='#" . $event_data_result['eventID'] . "'>
                    <i class='bx bxs-edit-alt'>Edit</i>
                    </a>
                    <a href='../backend/delete_event.php?eventid=" . $event_data_result['eventID'] . "'>
                    <i class='bx bx-trash-alt'>Delete</i>
                    </a>
                    </div>
                    <div class='name'>
                    <h3>" . $event_data_result['event_name'] . "</h3>
                    </div>
                    <div class='date_time'>
                    <p>" . $event_data_result['event_date'] . "</p>
                    <p>" . $event_data_result['event_time'] . "</p>
                    </div>
                </div>
            </div>";
            }
        }
        ?>
    </div>

    <div class="calender-event">
        <div class="event-detail">
            <i class='bx bx-x' onclick="addEvent()"></i>
            <h1>Add Event</h1>
            <form action="../backend/event.php" method="POST">
                <div class="input-detail">
                    <label for="">Add Event : </label>
                    <input type="text" name="event" placeholder="Event Name">
                </div>

                <div class="input-detail">
                    <label for="">Date : </label>
                    <input type="date" name="date">
                </div>

                <div class="input-detail">
                    <label for="">Time : </label>
                    <input type="time" name="time">
                </div>

                <div class="subBtn">
                    <input type="submit">
                </div>
            </form>
        </div>
    </div>

    <?php

    if (isset($_SESSION['message'])) {
        echo "
        <figure class='notification'>
            <div class='notification_body'>
            <i class='bx bx-check-circle'></i>
                <p>" . $_SESSION['message'] . "</p>
                <i class='bx bx-party'></i>
            </div>
            <div class='progress_bar'></div>
        </figure>
        ";
        unset($_SESSION['message']);
    }

    ?>

    <script type="text/javascript" src="../home/index.js"></script>
    <script type="text/javascript" src="../home/calender.js"></script>
</body>

</html>