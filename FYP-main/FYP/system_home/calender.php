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
            <a href="#" onclick="profileDrop()"><img src="../system_home/user_image/<?= $data['user_img'] ?>" alt=""></a>
            <li><a class="logout" href="../backend/logout.php">Logout<i class='bx bx-log-out'></i></a></li>
        </div>
        <div class="profile_dropdown">
            <a href="profile.php">My Profile</a>
            <a href="task_history.php">My Project / Task History</a>
        </div>
        <div class="location">
            <h3>Calendar</h3>
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
            <li><a href="#" class="active"><i class='bx bxs-calendar'></i>Calendar</a></li>
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

        <!-- <?php
                $todayDate = date('Y-m-d');
                $date = date('d');
                $notify_event_sql = "SELECT * FROM event_db";
                $check_notify = mysqli_query($dbconnection, $notify_event_sql);
                $count_event = mysqli_num_rows($check_notify);
                $all_event_date = array();

                if (mysqli_num_rows($check_notify) > 0) {
                    while ($row = mysqli_fetch_assoc($check_notify)) {
                    }
                }
                print_r(explode("-", '2023-03-08')[2]);
                ?> -->

        <script>

        </script>


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

    <script>
        // calender 

        const months = [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec"
        ];

        let prevBtn = document.querySelector("left");
        let nextBtn = document.querySelector("right");
        let monthDisplay = document.querySelector(".month");
        let yearDisplay = document.querySelector(".year");
        let dayDisplay = document.querySelector(".days");


        let currentMonth = new Date().getMonth();
        let currentYear = new Date().getFullYear();


        const displayCalendar = () => {
            let lastDate = new Date(currentYear, currentMonth + 1, 0).getDate();
            let prevMonthLastDate = new Date(currentYear, currentMonth, 0).getDate();
            let nextMonthFirstDate = new Date(currentYear, currentMonth, 1).getDate();
            let firstDay = new Date(currentYear, currentMonth, 1).getDay();
            let lastDay = new Date(currentYear, currentMonth, lastDate).getDay();
            let date = "";

            let balanceFirst = prevMonthLastDate - firstDay;
            for (let i = firstDay; i > 0; i--) {
                date += '<div class="day balanceDate">' + '<p>' + (balanceFirst += 1) + '</p>' + '</div>';
            }

            for (let i = 1; i <= lastDate; i++) {
                date += '<div class="day">' + '<p>' + i + '</p>' + '</div>';
            }

            dayDisplay.innerHTML = date;
        }
        displayCalendar();
        monthDisplay.innerHTML = months[currentMonth];
        yearDisplay.innerHTML = currentYear;


        // Set Event Date
        var date = new Date();
        var myYear = date.getFullYear();
        var myMonth = date.getMonth() + 1;
        var myDate = date.getDate();

        var myFullDate = myYear + "-" + (myMonth.length != 2 ? "0" + myMonth : myMonth) + "-" + myDate;

        //Get database Event Date
        const php = "<?php
                        $todayDate = date('Y-m-d');
                        $date = date('d');
                        $notify_event_sql = "SELECT * FROM event_db";
                        $check_notify = mysqli_query($dbconnection, $notify_event_sql);
                        $count_event = mysqli_num_rows($check_notify);

                        $all_event_date = array();

                        if ($count_event > 0) {
                            while ($row = mysqli_fetch_assoc($check_notify)) {
                                echo $row['event_date'];
                                echo " / ";
                            }
                        }
                        ?>";
        var database = php.split(" / ");
        // database.push(php.split(" / "));

        var databaseDate = database[0].split("-")[2];
        var filtered = database.filter(element => element);
        var newData = [];
        for (let i = 0; i < filtered.length; i++) {
            newData.push(filtered[i].split("-")[2]);
        }

        // Set Event Date

        const getDate = document.querySelectorAll(".day");
        var createTag = document.createElement("div");
        createTag.classList.add('event');

        let countDay = document.querySelectorAll(".day");
        for (let i = 0; i < countDay.length; i++) {
            if (countDay[i].innerText === new Date().getDate().toString()) {
                countDay[i].style.color = "red";

            }

            for (let x = 0; x < newData.length; x++) {
                if (countDay[i].innerText === newData[x]) {
                    countDay[i].appendChild(createTag.cloneNode(true));
                }
            }

        }



        //Display Add Event

        let calenderEvent = document.querySelector('.calender-event');
        let inputDate = document.getElementById("input-date");

        const addEvent = () => {
            calenderEvent.classList.toggle('openCalender');
        }

        const nextMonth = () => {
            if (currentMonth > 10) {
                currentMonth = -1;
                currentYear += 1;
            }
            currentMonth++;
            monthDisplay.innerHTML = months[currentMonth];
            yearDisplay.innerHTML = currentYear;
            displayCalendar();
        }

        const prevMonth = () => {
            if (currentMonth <= 0) {
                currentMonth = 12;
                currentYear -= 1;
            }
            currentMonth--;
            monthDisplay.innerHTML = months[currentMonth];
            yearDisplay.innerHTML = currentYear;
            displayCalendar();
        }

        let colorChanger = document.querySelectorAll(".name");
        let min = 0;
        let max = 5;
        let color = [
            "#9BB8ED",
            "#A39FE1",
            "#DEB3E0",
            "#FEC6DF",
            "#FFDDE4",
            "#FEECD6"
        ]

        colorChanger.forEach((n) => {
            n.style.background = color[Math.floor(Math.random() * (max - min))];
        });

        let drop = document.querySelectorAll(".drop-down");

        const dropDown = (button) => {
            let clickBtn = button;
            let showBtn = clickBtn.nextElementSibling;
            showBtn.classList.toggle("drop");
        }

        let event_display = document.querySelector(".event_display");

        const eventDisplay = () => {
            event_display.classList.toggle("event-show");
        }
    </script>

    <script type="text/javascript" src="../home/index.js"></script>

    <script type="text/javascript" src="../home/profileDropdown.js"></script>
</body>

</html>