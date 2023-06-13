<?php
    session_start();
    include_once '../backend/dbconnection.php';

    $task_id = $_GET['taskid'];

    $task_sql = "SELECT * FROM task_db WHERE taskID = $task_id";
    $check_task = mysqli_query($dbconnection , $task_sql);
    $task_result = mysqli_fetch_assoc($check_task);
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
    <div class="task_detail_header">
        <div class="task_details">
            <div class="task_title">
            <h3><?=$task_result['task_name']?></h3>
            </div>
            <div class="task_bar">
                <div class="status">
                <label for="">Status : </label>
                <!-- <p><?=$task_result['status']?></p> -->
                <select name="status">
                    <option value="New Task">New Task</option>
                    <option value="In Progress">In Progress</option>
                    <option value="On Hold">On Hold</option>
                    <option value="Cancelled">Cancelled</option>
                    <option value="In Review">In Review</option>
                    <option value="Completed">Completed</option>
                </select>
                </div>
                <div class="sdate">
                <label for="">Start Date : </label>
                <p><?=$task_result['start_date']?></p>
                </div>
                <div class="ddate">
                <label for="">Due Date : </label>
                <p><?=$task_result['due_date']?></p>
                </div>
                <div class="days">
                <label for="">Days : </label>
                <p><?=$task_result['days']?></p>
                </div>
            </div>

            <div class="ext_function">
                <div class="desc">
                    <label for="">Description : </label>
                    <p><?=$task_result['description']?></p>
                </div>
                <div class="add_file">
                    <label for="file">
                        Insert File
                        <i class='bx bx-upload'></i>
                    </label>
                    <input type="file" onchange="myChange()" id="file" hidden>
                </div>
            </div>
            <a href="#" id="display"></a>
        </div>
    </div> 
    <script type="text/javascript" src="../home/index.js"></script>
</body>
</html>