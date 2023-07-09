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

$project_id = $_GET['projectid'];
$_SESSION['projectid'] = $project_id;

$project_data = "SELECT * FROM project_db WHERE projectID = $project_id";
$check = mysqli_query($dbconnection, $project_data);
$result = mysqli_fetch_assoc($check);
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
    <title>Task-Smart</title>
</head>

<body>
    <header class="top-bar">
        <div class="user_bar">
            <a href="profile.php"><img src="../system_home/user_image/<?= $data['user_img'] ?>" alt=""></a>
            <li><a class="logout" href="../backend/logout.php">Logout<i class='bx bx-log-out'></i></a></li>
        </div>
        <div class="location">
            <h3>Task</h3>
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

    <div class="task_section">
        <div class="project_detail">
            <h3><?= $result['project_name'] ?></h3>
            <?php
            if ($result['ownerID'] == $data['uniqueID']) {
                echo "
            <div class='add_task' onclick='myTask()'>
            <a href='#'>
                <i class='bx bx-list-plus'></i>
            </a>
            </div>
    ";
            }
            ?>
        </div>

        <div class="task_area">

            <div class="task_list">
                <div class="task_status" id="new">
                    <p>New Task</p>
                </div>
                <?php
                $task_sql = "SELECT * FROM task_db WHERE project_id = $project_id AND status = 'New Task'";
                $check_task = mysqli_query($dbconnection, $task_sql);
                if (mysqli_num_rows($check_task) > 0) {
                    while ($task_data = mysqli_fetch_assoc($check_task)) {
                        echo "
                    <a href='task_details.php?taskid=" . $task_data['taskID'] . "'>
                    <div class='task')'>
                    <div class='task_name'>
                        <p>
                        " . $task_data['task_name'] . "
                        </p>
                    </div>
                    </div>
                    </a>
                    ";
                    }
                }
                ?>

            </div>

            <div class="task_list">
                <div class="task_status" id="progress">
                    <p>In Progress</p>
                </div>
                <?php
                $task_sql = "SELECT * FROM task_db WHERE project_id = $project_id AND status = 'In Progress'";
                $check_task = mysqli_query($dbconnection, $task_sql);
                if (mysqli_num_rows($check_task) > 0) {
                    while ($task_data = mysqli_fetch_assoc($check_task)) {
                        echo "
                    <a href='task_details.php?taskid=" . $task_data['taskID'] . "'>
                    <div class='task'>
                    <div class='task_name'>
                        <p>
                        " . $task_data['task_name'] . "
                        </p>
                    </div>
                    </div>
                    </a>
                    ";
                    }
                }
                ?>
            </div>

            <div class="task_list">
                <div class="task_status" id="hold">
                    <p>On Hold</p>
                </div>
                <?php
                $task_sql = "SELECT * FROM task_db WHERE project_id = $project_id AND status = 'On Hold'";
                $check_task = mysqli_query($dbconnection, $task_sql);
                if (mysqli_num_rows($check_task) > 0) {
                    while ($task_data = mysqli_fetch_assoc($check_task)) {
                        echo "
                    <a href='task_details.php?taskid=" . $task_data['taskID'] . "'>
                    <div class='task'>
                    <div class='task_name'>
                        <p>
                        " . $task_data['task_name'] . "
                        </p>
                    </div>
                    </div>
                    </a>
                    ";
                    }
                }
                ?>
            </div>

            <div class="task_list">
                <div class="task_status" id="cancel">
                    <p>Cancelled</p>
                </div>
                <?php
                $task_sql = "SELECT * FROM task_db WHERE project_id = $project_id AND status = 'Cancelled'";
                $check_task = mysqli_query($dbconnection, $task_sql);
                if (mysqli_num_rows($check_task) > 0) {
                    while ($task_data = mysqli_fetch_assoc($check_task)) {
                        echo "
                    <a href='task_details.php?taskid=" . $task_data['taskID'] . "'>
                    <div class='task'>
                    <div class='task_name'>
                        <p>
                        " . $task_data['task_name'] . "
                        </p>
                    </div>
                    </div>
                    </a>
                    ";
                    }
                }
                ?>
            </div>

            <div class="task_list">
                <div class="task_status" id="review">
                    <p>In Review</p>
                </div>
                <?php
                $task_sql = "SELECT * FROM task_db WHERE project_id = $project_id AND status = 'In Review'";
                $check_task = mysqli_query($dbconnection, $task_sql);
                if (mysqli_num_rows($check_task) > 0) {
                    while ($task_data = mysqli_fetch_assoc($check_task)) {
                        echo "
                    <a href='task_details.php?taskid=" . $task_data['taskID'] . "'>
                    <div class='task'>
                    <div class='task_name'>
                        <p>
                        " . $task_data['task_name'] . "
                        </p>
                    </div>
                    </div>
                    </a>
                    ";
                    }
                }
                ?>
            </div>

            <div class="task_list">
                <div class="task_status" id="complete">
                    <p>Completed</p>
                </div>
                <?php
                $task_sql = "SELECT * FROM task_db WHERE project_id = $project_id AND status = 'Completed'";
                $check_task = mysqli_query($dbconnection, $task_sql);
                if (mysqli_num_rows($check_task) > 0) {
                    while ($task_data = mysqli_fetch_assoc($check_task)) {
                        echo "
                    <a href='task_details.php?taskid=" . $task_data['taskID'] . "'>
                    <div class='task'>
                    <div class='task_name'>
                        <p>
                        " . $task_data['task_name'] . "
                        </p>
                    </div>
                    </div>
                    </a>
                    ";
                    }
                }
                ?>
            </div>

        </div>

        <div class="task_creation">
            <form action="../backend/task_back.php?projectid=<?= $project_id ?>" method="POST">
                <div class="task_form">
                    <h3>Create Task</h3>
                    <div class="task_input">
                        <label for="">Task Name : </label>
                        <input type="text" name="taskName" placeholder="Task Name" required>
                    </div>

                    <div class="task_input">
                        <label for="">Description : </label>
                        <input type="text" name="description" placeholder="Description" autocomplete="off" required>
                    </div>

                    <div class="task_input">
                        <label for="">Start Date : </label>
                        <input type="date" id="sdate" name="sdate" required>
                    </div>

                    <div class="task_input">
                        <label for="">Due Date : </label>
                        <input type="date" id="ddate" name="ddate" required>
                    </div>

                    <div class="task_input">
                        <label for="">Status : </label>
                        <select name="status">
                            <option value="New Task">New Task</option>
                            <option value="In Progress">In Progress</option>
                            <option value="On Hold">On Hold</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="In Review">In Review</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>

                    <!-- <div class="task_input" hidden>
                    <label for="">Project ID : </label>
                    <input type="text" name="project_id" value="<?= $project_id ?>">
                </div> -->

                    <div class="subBtn">
                        <input type="submit" value="Create Task">
                        <a href="#" onclick="myTask()">Cancel</a>
                    </div>
                </div>
            </form>
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
</body>

</html>