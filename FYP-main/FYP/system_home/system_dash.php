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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Font  -->
    <!-- Icon package -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Dashboard-Smart</title>
</head>

<body>

    <!-- <div id="loader">
        <img class="loading" src="../home/Smart-Project-1--unscreen.gif">
    </div> -->

    <header class="top-bar">
        <div class="user_bar">
            <a href="profile.php"><img src="../system_home/user_image/<?= $data['user_img'] ?>" alt=""></a>
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
            <li><a href="#" class="active"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="system_home_page.php"><i class='bx bx-world'></i>Project Management</a></li>
            <li><a href="calender.php"><i class='bx bxs-calendar'></i>Calender</a></li>
            <li><a href="system_chat.php"><i class='bx bxs-chat'></i>Chat</a></li>
        </ul>
    </div>

    <?php

    $total_task_sql = "SELECT * FROM task_db";
    $check_task_sql = mysqli_query($dbconnection, $total_task_sql);
    $check_total_task = mysqli_num_rows($check_task_sql);

    $total_project_sql = "SELECT * FROM project_db ";
    $check_project_sql = mysqli_query($dbconnection, $total_project_sql);
    $check_total_project = mysqli_num_rows($check_project_sql);

    $total_complete_project_sql = "SELECT * FROM project_db WHERE status = 1";
    $check_complete_project_sql = mysqli_query($dbconnection, $total_complete_project_sql);
    $check_total_complete_project = mysqli_num_rows($check_complete_project_sql);

    $complete_task_sql = "SELECT * FROM task_db WHERE status = 'Completed'";
    $check_complete_task_sql = mysqli_query($dbconnection, $complete_task_sql);
    $complete_task_result = mysqli_num_rows($check_complete_task_sql);

    ?>

    <div class="dashboard-container" id="myWord">
        <div class="dashboard_details">
            <div class="dashboard_card">
                <img width="60" height="60" src="https://img.icons8.com/bubbles/50/task.png" alt="task" />
                <h3>Total Task</h3>
                <p><?php echo $check_total_task ?></p>
            </div>

            <div class="dashboard_card">
                <img width="60" height="60" src="https://img.icons8.com/bubbles/50/project-setup.png" alt="project-setup" />
                <h3>Total Project</h3>
                <p><?php echo $check_total_project ?></p>
            </div>

            <div class="dashboard_card">
                <img width="60" height="60" src="https://img.icons8.com/bubbles/50/ok.png" alt="ok" />
                <h3>Completed Project</h3>
                <p><?php echo $check_total_complete_project ?></p>
            </div>
        </div>

        <div class="dashboard2">

            <div class="task_dashboard">
                <h3>Task Statistics</h3>
                <div class="task_static">

                    <div class="statistic">
                        <div class="info">
                            <p>New Task</p>
                            <?php
                            $new_task_sql = "SELECT * FROM task_db WHERE status = 'New Task'";
                            $check_new_task_sql = mysqli_query($dbconnection, $new_task_sql);
                            $total_new_task_task = mysqli_num_rows($check_new_task_sql);
                            ?>
                            <p id="task_count"><?php echo $total_new_task_task ?>/<?php echo $check_total_task ?></p>
                        </div>
                        <!-- Progress Bar -->
                        <div class="container">
                            <div class="progress progress-striped">
                                <div class="progress-bar" id="new">
                                </div>
                            </div>
                        </div>
                        <!-- Progress Bar -->
                        <!-- Javascript dynamic progress bar  -->
                        <script>
                            let totalNew = "<?php echo $total_new_task_task ?>"; //2
                            let totalTask = "<?php echo $check_total_task ?>"; //5
                            let count = (100 / totalTask); //20
                            let progress = count * totalNew;

                            let progressBar = document.getElementById('new');
                            progressBar.style.setProperty('--end-width', progress + '%');
                        </script>
                        <!-- Javascript dynamic progress bar  -->
                    </div>

                    <div class="statistic">
                        <div class="info">
                            <p>In Progress</p>
                            <?php
                            $progress_sql = "SELECT * FROM task_db WHERE status = 'In Progress'";
                            $check_progress_sql = mysqli_query($dbconnection, $progress_sql);
                            $total_progress_task = mysqli_num_rows($check_progress_sql);
                            ?>
                            <p id="task_count"><?php echo $total_progress_task ?>/<?php echo $check_total_task ?></p>
                        </div>
                        <!-- Progress Bar -->
                        <div class="container">
                            <div class="progress progress-striped">
                                <div class="progress-bar" id="progress">
                                </div>
                            </div>
                        </div>
                        <!-- Progress Bar -->


                        <script>
                            // Get html element
                            let progressBar1 = document.getElementById('progress');
                            // Get html element

                            let totalInProgress = "<?php echo $total_progress_task ?>";
                            let totalTask1 = "<?php echo $check_total_task ?>";
                            let count1 = (100 / totalTask1);
                            let progress1 = count1 * totalInProgress;

                            progressBar1.style.setProperty('--end-width', progress1 + '%');
                        </script>
                        <!-- Javascript dynamic progress bar  -->
                    </div>

                    <div class="statistic">
                        <div class="info">
                            <p>On Hold</p>
                            <?php
                            $on_hold_sql = "SELECT * FROM task_db WHERE status = 'On Hold'";
                            $check_onhold_sql = mysqli_query($dbconnection, $on_hold_sql);
                            $total_hold_task = mysqli_num_rows($check_onhold_sql);
                            ?>
                            <p id="task_count"><?php echo $total_hold_task ?>/<?php echo $check_total_task ?></p>
                        </div>
                        <!-- Progress Bar -->
                        <div class="container">
                            <div class="progress progress-striped">
                                <div class="progress-bar" id="hold">
                                </div>
                            </div>
                        </div>
                        <!-- Progress Bar -->
                        <script>
                            // Get html element
                            let progressBar2 = document.getElementById('hold');
                            // Get html element

                            let totalOnHold = "<?php echo $total_hold_task ?>";
                            let totalTask2 = "<?php echo $check_total_task ?>";
                            let count2 = (100 / totalTask2);
                            let progress2 = count2 * totalOnHold;

                            progressBar2.style.setProperty('--end-width', progress2 + '%');
                        </script>
                    </div>

                    <div class="statistic">
                        <div class="info">
                            <p>Cancelled</p>
                            <?php
                            $cancelled_sql = "SELECT * FROM task_db WHERE status = 'Cancelled'";
                            $check_cancelled_sql = mysqli_query($dbconnection, $cancelled_sql);
                            $total_cancelled_task = mysqli_num_rows($check_cancelled_sql);
                            ?>
                            <p id="task_count"><?php echo $total_cancelled_task ?>/<?php echo $check_total_task ?></p>
                        </div>
                        <!-- Progress Bar -->
                        <div class="container">
                            <div class="progress progress-striped">
                                <div class="progress-bar" id="cancel">
                                </div>
                            </div>
                        </div>
                        <!-- Progress Bar -->
                        <script>
                            // Get html element
                            let progressBar3 = document.getElementById('cancel');
                            // Get html element

                            let totalCancelled = "<?php echo $total_cancelled_task ?>";
                            let totalTask3 = "<?php echo $check_total_task ?>";
                            let count3 = (100 / totalTask3);
                            let progress3 = count3 * totalCancelled;

                            progressBar3.style.setProperty('--end-width', progress3 + '%');
                        </script>
                    </div>

                    <div class="statistic">
                        <div class="info">
                            <p>In Review</p>
                            <?php
                            $in_review_sql = "SELECT * FROM task_db WHERE status = 'In Review'";
                            $check_in_review_sql = mysqli_query($dbconnection, $in_review_sql);
                            $total_in_review_task = mysqli_num_rows($check_in_review_sql);
                            ?>
                            <p id="task_count"><?php echo $total_in_review_task ?>/<?php echo $check_total_task ?></p>
                        </div>
                        <!-- Progress Bar -->
                        <div class="container">
                            <div class="progress progress-striped">
                                <div class="progress-bar" id="review">
                                </div>
                            </div>
                        </div>
                        <!-- Progress Bar -->
                        <script>
                            // Get html element
                            let progressBar4 = document.getElementById('review');
                            // Get html element

                            let totalInReview = "<?php echo $total_in_review_task ?>";
                            let totalTask4 = "<?php echo $check_total_task ?>";
                            let count4 = (100 / totalTask4);
                            let progress4 = count4 * totalInReview;

                            progressBar4.style.setProperty('--end-width', progress4 + '%');
                        </script>
                    </div>

                    <div class="statistic">
                        <div class="info">
                            <p>Completed</p>
                            <?php
                            $completed_sql = "SELECT * FROM task_db WHERE status = 'Completed'";
                            $check_completed_sql = mysqli_query($dbconnection, $completed_sql);
                            $total_completed_task = mysqli_num_rows($check_completed_sql);
                            ?>
                            <p id="task_count"><?php echo $total_completed_task ?>/<?php echo $check_total_task ?></p>
                        </div>
                        <!-- Progress Bar -->
                        <div class="container">
                            <div class="progress progress-striped">
                                <div class="progress-bar" id="completed">
                                </div>
                            </div>
                        </div>
                        <!-- Progress Bar -->
                        <script>
                            // Get html element
                            let progressBar5 = document.getElementById('completed');
                            // Get html element

                            let totalCompleted = "<?php echo $total_completed_task ?>";
                            let totalTask5 = "<?php echo $check_total_task ?>";
                            let count5 = (100 / totalTask5);
                            let progress5 = count5 * totalCompleted;

                            progressBar5.style.setProperty('--end-width', progress5 + '%');
                        </script>
                    </div>

                </div>
            </div>

            <div class="employee_dashboard">
                <h3>Employee</h3>
                <div class="employee_details">

                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Profile</th>
                        </tr>

                        <?php
                        $data_per_page = 4;

                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }

                        $default_page = ($page - 1) * 4;
                        $user_details_sql = "SELECT * FROM user_db WHERE userID != 0 LIMIT $default_page , $data_per_page";
                        $check_user_sql = mysqli_query($dbconnection, $user_details_sql);


                        if (mysqli_num_rows($check_user_sql) > 0) {
                            while ($user_details = mysqli_fetch_assoc($check_user_sql)) {
                                echo "
                <tr>
                        <td>" . $user_details['user_name'] . "</td>
                        <td>" . $user_details['user_email'] . "</td>
                        <td>" . $user_details['role'] . "</td>
                        <td>";
                                if ($user_details['userID'] != $id) {
                                    echo "
                            <a href='viewProfile.php?userid=" . $user_details['userID'] . "'>View Profile</a>
                            ";
                                }

                                echo "</td>
                    </tr>
                ";
                            }
                        }

                        ?>

                    </table>
                </div>

                <div class="pagination">

                    <?php

                    $get_page_sql = "SELECT * FROM user_db";
                    $check_page_sql = mysqli_query($dbconnection, $get_page_sql);
                    $page_result = mysqli_num_rows($check_page_sql);
                    $total_page = ceil($page_result / $data_per_page);

                    for ($i = 1; $i <= $total_page; $i++) {
                        echo "
                        <div class='page_num'>
                            <a href='system_dash.php?page=" . $i . "'>" . $i . "</a>
                            </div>
                            ";
                    }

                    ?>

                </div>

            </div>


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
</body>

</html>