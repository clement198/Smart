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

$project_id = $_GET['projectid'];

$project_data = "SELECT * FROM project_db WHERE projectID = $project_id";
$check = mysqli_query($dbconnection , $project_data);
$result = mysqli_fetch_assoc($check);
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
    <title>Task-Smart</title>
</head>
<body>
    <header class="top-bar">
        <div class="user">
        <a href="profile.php"><img src="../system_home/user_image/<?=$data['user_img']?>" alt=""></a>
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
        <li><a href="system_home_page.php"><i class='bx bxs-home' ></i>Home</a></li>
            <li><a href="system_dash.php" ><i class='bx bxs-dashboard' ></i>Dashboard</a></li>
            <li><a href="system_chat.php"><i class='bx bxs-chat' ></i>Chat</a></li>
            <li><a href="#"><i class='bx bxs-group' ></i>Team Member</a></li>
        </ul>
    </div>

    <div class="task_section">
        <div class="project_detail">
            <h3><?=$result['project_name']?></h3>
        </div>

        <div class="task_area">

        <div class="task_list">
            <div class="task_status" id="new">
                <p id="status">New Task</p>
                <p class="count">1</p>
            </div>

            <div class="task">
                <div class="task_name">
                    <p>Lorem </p>
                </div>
            </div>

            <div class="task">
                <div class="task_name">
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>
            </div>
            <div class="add_task" onclick="myTask()"> 
                <a href="#">
                    Task
                    <i class='bx bx-list-plus'></i>
                </a>
            </div>
        </div>

        <div class="task_list">
            <div class="task_status" id="progress">
                <p id="status">In Progress</p>
                <p class="count">1</p>
            </div>
            <div class="task">
                <div class="task_name">
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>
            </div>
            <div class="add_task">
                <a href="#" onclick="myTask()">
                    Task
                    <i class='bx bx-list-plus'></i>
                </a>
            </div>
        </div>

        <div class="task_list">
            <div class="task_status" id="hold">
                <p id="status">On Hold</p>
                <p class="count">1</p>
            </div>
            <div class="task">
                <div class="task_name">
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>
            </div>
            <div class="add_task" onclick="myTask()">
                <a href="#">
                    Task
                    <i class='bx bx-list-plus'></i>
                </a>
            </div>
        </div>

        <div class="task_list">
            <div class="task_status" id="cancel">
                <p>Cancelled</p>
                <p class="count">1</p>
            </div>
            <div class="task">
                <div class="task_name">
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>
            </div>
            <div class="add_task" onclick="myTask()">
                <a href="#">
                    Task
                    <i class='bx bx-list-plus'></i>
                </a>
            </div>
        </div>

        <div class="task_list">
            <div class="task_status" id="review">
                <p>In Review</p>
                <p class="count">1</p>
            </div>
            <div class="task">
                <div class="task_name">
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>
            </div>
            <div class="add_task" onclick="myTask()">
                <a href="#">
                    Task
                    <i class='bx bx-list-plus'></i>
                </a>
            </div>
        </div>

        <div class="task_list">
            <div class="task_status" id="complete">
                <p>Completed</p>
                <p class="count">1</p>
            </div>
            <div class="task">
                <div class="task_name">
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>
            </div>
            <div class="add_task" onclick="myTask()">
                <a href="#">
                    Task
                    <i class='bx bx-list-plus'></i>
                </a>
            </div>
        </div>

    </div>

    <div class="task_creation">
        <form action="#">
            <div class="task_form">
            <h3>Create Task</h3>
                <div class="task_input">
                    <label for="">Task Name : </label>
                    <input type="text" placeholder="Task Name">
                </div>

                <div class="task_input">
                    <label for="">Description : </label>
                    <input type="text" placeholder="Description">
                </div>

                <div class="task_input">
                    <label for="">Start Date : </label>
                    <input type="date" >
                </div>

                <div class="task_input">
                    <label for="">Due Date : </label>
                    <input type="date">
                </div>

                <div class="task_input">
                    <label for="">Status : </label>
                    <input type="text" id="input_status" value="">
                </div>

                <div class="task_input" hidden>
                    <label for="">Project ID : </label>
                    <input type="text" value="<?=$project_id?>">
                </div>

                <div class="subBtn">
                    <input type="submit" value="Create Task">
                    <a href="#" onclick="myTask()">Cancel</a>
                </div>
            </div>
        </form>
    </div>

<script type="text/javascript" src="../home/index.js"></script>
</body>
</html>