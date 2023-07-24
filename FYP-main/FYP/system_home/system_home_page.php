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
    <link rel="stylesheet" href="notification.css">
    <!-- Google Font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dongle:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- Google Font  -->
    <!-- Icon package -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Home-Smart</title>
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
            <h3>Home</h3>
        </div>
    </header>
    <nav class="side-bar">
        <div class="brand">
            <a href="#">
                <img src="../home/logo3.png" alt="">
            </a>
        </div>
        <ul class="menu-list">
            <li><a href="system_dash.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="#" class="active"><i class='bx bx-world'></i>Project Management</a></li>
            <li><a href="calender.php"><i class='bx bxs-calendar'></i>Calendar</a></li>
            <li><a href="system_chat.php"><i class='bx bxs-chat'></i>Chat</a></li>
        </ul>
    </nav>

    <div class="project_area">

        <?php

        $privilege_sql = "SELECT role FROM user_db WHERE role = 'Manager'";
        $check_privilege_sql = mysqli_query($dbconnection, $privilege_sql);
        $privilege_result = mysqli_fetch_assoc($check_privilege_sql);

        if ($privilege_result['role'] == $data['role']) {
            echo "
            <div class='add_project'>
                <label for=''>New Project : </label>
                <a href='#' class='btn' onclick='popUps()'>
                    <i class='bx bx-plus'></i>
                </a>
            </div>
            ";
        }

        ?>

        <div class="blur">
            <div class="popup_form">
                <form action="../backend/project_back.php" method="POST">
                    <h1>New Project</h1>
                    <div class="project_form">
                        <label for="">Project Name :</label>
                        <input type="text" name="projectName" placeholder="Project Name">
                    </div>

                    <div class="project_form">
                        <label for="">Project Type :</label>
                        <select name="type">
                            <option value="">Choose Your Project Type</option>
                            <option value="Web Development">Web Development</option>
                            <option value="Mobile Development">Mobile Development</option>
                        </select>
                    </div>

                    <div class="project_form">
                        <label for="start_date">Start Date :</label>
                        <input type="date" name="sdate">
                    </div>

                    <div class="project_form">
                        <label for="due_date">Due Date :</label>
                        <input type="date" name="ddate">
                    </div>

                    <input type="text" name="ownerid" value="<?= $data['uniqueID'] ?>" hidden>

                    <div class="subBtn">
                        <input type="submit" name="submit" value="Create Project">
                        <a class="cancel" onclick="popUps()">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

        <div class='project_box'>
            <?php

            include_once '../backend/dbconnection.php';

            $project_data = "SELECT * FROM project_db";
            $check = mysqli_query($dbconnection, $project_data);

            if (mysqli_num_rows($check) > 0) {
                while ($result = mysqli_fetch_array($check)) {
                    echo "
                
                <div class='project_item'>";

                    if ($result['project_type'] == 'Mobile Development') {
                        echo " <img width='64' height='64' src='https://img.icons8.com/nolan/64/mobile-navigator.png' alt='mobile-navigator'/>";
                    } else {
                        echo "<img width='64' height='64' src='https://img.icons8.com/nolan/64/backend-development.png' alt='backend-development'/>";
                    }

                    echo "<a href='task.php?projectid=" . $result['projectID'] . "'>
                <div class='project_details'>
                <h3>" . $result['project_name'] . "</h3>
                <h5>" . $result['project_type'] . "</h5>
                <p>Start Date :" . $result['start_date'] . "</p>
                <p>End Date :" . $result['due_date'] . "</p>
                </div>

                
                </a>";

                    if ($data['uniqueID'] == $result['ownerID']) {
                        echo "<div class='modify'>
                    <a href='edit.php?projectid=" . $result['projectID'] . "'><i class='bx bx-edit'></i></a>
                    <a href='project_deleteConfirmation.php?projectid=" . $result['projectID'] . "'><i class='bx bx-trash'></i></a>
                    </div>";
                    }

                    echo "
                
                </div>";
                }
            }
            ?>
        </div>

        <!-- Chat Notification -->

        <?php

        $sql = "SELECT * FROM msg_db WHERE new_msg = 1 AND receiver_id = '$data[uniqueID]'";
        $result = mysqli_query($dbconnection, $sql);
        $msg_data = mysqli_fetch_assoc($result);

        // $user_sql = "SELECT * FROM user_db WHERE uniqueID = '$msg_data[sender_id]';";
        // $user_sql_result = mysqli_query($dbconnection, $user_sql);
        // $user_data = mysqli_fetch_assoc($user_sql_result);


        if (mysqli_num_rows($result) > 0) {

            echo "
<script>
    
    Notification.requestPermission().then(perm => {
        if (perm === 'granted') {
            new Notification('You have received a notification', {
            body: 'You got a new Message ', 
            });
        }
        })
</script>
";

            $updateSql = "UPDATE msg_db SET new_msg = 0 WHERE new_msg = 1";
            mysqli_query($dbconnection, $updateSql);
        }



        ?>


        <!-- Chat Notification -->
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


        <script type="text/javascript" src="../home/search.js"></script>
        <script type="text/javascript" src="../home/profileDropdown.js"></script>

</body>

</html>