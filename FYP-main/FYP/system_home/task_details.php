<?php
session_start();
error_reporting(0);
include_once '../backend/dbconnection.php';
$id = $_SESSION['id'];

$task_id = $_GET['taskid'];
$_SESSION['taskid'] = $task_id;
$project_id = $_SESSION['projectid'];

$user_sql = "SELECT * FROM user_db WHERE userID = $id";
$check_user_sql = mysqli_query($dbconnection, $user_sql);
$data_user_sql = mysqli_fetch_assoc($check_user_sql);

$project_sql = "SELECT * FROM project_db WHERE projectID = $project_id";
$check_project_sql = mysqli_query($dbconnection, $project_sql);
$project_sql_data = mysqli_fetch_assoc($check_project_sql);

$task_sql = "SELECT * FROM task_db WHERE taskID = $task_id";
$check_task = mysqli_query($dbconnection, $task_sql);
$task_result = mysqli_fetch_assoc($check_task);

$permit_sql = "SELECT * FROM collab_db WHERE permit = 1 AND user_id = $id AND taskid = $task_id";
$check_permit = mysqli_query($dbconnection, $permit_sql);
$permit_result = mysqli_fetch_assoc($check_permit);

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
    <div class="task_detail_header">
        <div class="task_details">
            <div class="task_title">
                <h3><?= $task_result['task_name'] ?></h3>
                <div class="function">

                    <?php

                    if ($project_sql_data['ownerID'] == $data_user_sql['uniqueID']) {
                        echo "

                    <!-- Invite User -->
                    <a href='#' onclick='inviteFunc()'>
                        <i class='bx bx-user-plus'></i>
                    </a>
                    <!-- Invite User -->

                    <!-- Edit Task -->
                    <a href='#' onclick='edit_task()'>
                        <i class='bx bxs-edit-alt'></i>
                    </a>
                    <!-- Edit Task -->
                    
                    <!-- Delete Task -->
                    <a href='#' onclick='delete_task()'>
                        <i class='bx bx-trash'></i>
                    </a>
                    <!-- Delete Task -->
                    
                    ";
                    }

                    if ($data_user_sql['role'] == 'Supervisor') {
                        echo "

                    <!-- Invite User -->
                    <a href='#' onclick='inviteFunc()'>
                        <i class='bx bx-user-plus'></i>
                    </a>
                    <!-- Invite User -->
                    ";
                    }

                    ?>

                    <?php
                    if ($id == $permit_result['user_id'] || $project_sql_data['ownerID'] == $data_user_sql['uniqueID']) {
                        echo '
                        <!-- Upload file -->
                    <a href="#" onclick="insert_file()">
                        <i class="bx bxs-file-plus"></i>
                    </a>
                    <!-- Upload file -->
                        ';
                    }
                    ?>


                    <a href="task.php?projectid=<?= $project_id ?>">
                        <i class='bx bx-x'></i>
                    </a>
                </div>

            </div>

            <!-- Search user -->

            <div class="inv_user">
                <form action="../backend/search_result.php?taskid=<?= $task_result['taskID'] ?>" method="POST">
                    <div class="search_user">
                        <input type="text" name="email" placeholder="Enter User Email Address">
                        <div class="invBtn">
                            <input type="submit" value="Search User">
                            <a href="#" onclick="inviteFunc()">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Search user -->

            <!-- Insert File -->
            <div class="insert_file">
                <form action="../backend/taskFile_upload.php?task_id=<?= $task_result['taskID'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="file">
                        <p id="display"></p>
                        <div class="add_file">
                            <label for="file">
                                Insert File
                                <i class='bx bx-upload'></i>
                            </label>
                            <input type="file" name="task_file" onchange="myChange()" id="file" hidden>
                            <input type="text" name="senderid" value="<?= $id ?>" hidden>
                        </div>
                        <div class="subBtn">
                            <input type="submit" value="Upload">
                            <a href="#" onclick="insert_file()">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Insert File -->

            <!-- Edit Task -->
            <div class="task_detail_edit">
                <form action="../backend/task_edit_back.php?task_id=<?= $task_result['taskID'] ?>" method="POST">
                    <div class="detail_form">
                        <h3>Edit Task</h3>
                        <div class="task_input">
                            <label for="">Task Name : </label>
                            <input type="text" name="taskName" value="<?= $task_result['task_name'] ?>" required>
                        </div>

                        <div class="task_input">
                            <label for="">Description : </label>
                            <input type="text" name="description" value="<?= $task_result['description'] ?>" autocomplete="off" required>
                        </div>

                        <div class="task_input">
                            <label for="">Start Date : </label>
                            <input type="date" id="sdate" value="<?= $task_result['start_date'] ?>" name="sdate" required>
                        </div>

                        <div class="task_input">
                            <label for="">Due Date : </label>
                            <input type="date" id="ddate" value="<?= $task_result['due_date'] ?>" name="ddate" required>
                        </div>

                        <div class="task_input">
                            <label for="">Status : </label>
                            <select name="status">
                                <option value="New Task" <?php
                                                            if ($task_result['status'] == 'New Task') {
                                                                echo "selected";
                                                            }
                                                            ?>>New Task</option>
                                <option value="In Progress" <?php
                                                            if ($task_result['status'] == 'In Progress') {
                                                                echo "selected";
                                                            }
                                                            ?>>In Progress</option>
                                <option value="On Hold" <?php
                                                        if ($task_result['status'] == 'On Hold') {
                                                            echo "selected";
                                                        }
                                                        ?>>On Hold</option>
                                <option value="Cancelled" <?php
                                                            if ($task_result['status'] == 'Cancelled') {
                                                                echo "selected";
                                                            }
                                                            ?>>Cancelled</option>
                                <option value="In Review" <?php
                                                            if ($task_result['status'] == 'In Review') {
                                                                echo "selected";
                                                            }
                                                            ?>>In Review</option>
                                <option value="Completed" <?php
                                                            if ($task_result['status'] == 'Completed') {
                                                                echo "selected";
                                                            }
                                                            ?>>Completed</option>
                            </select>
                        </div>

                        <div class="subBtn">
                            <input type="submit" value="Edit Task">
                            <a href="#" onclick="edit_task()">Cancel</a>
                        </div>

                    </div>
                </form>
            </div>
            <!-- Edit Task -->

            <!-- Delete Task -->
            <div class="delete_alert">
                <div class="alert">
                    <p>Are you sure want to delete this task ? </p>
                    <a href="../backend/task_delete.php?taskid=<?= $task_result['taskID'] ?>">Yes</a>
                    <a onclick="delete_task()" href="#">No</a>
                </div>
            </div>
            <!-- Delete Task -->
            <div class="task_bar">
                <div class="info" id="task-status">
                    <label for="">Status : </label>
                    <p><?= $task_result['status'] ?></p>
                </div>
                <div class="info">
                    <label for="">Start Date : </label>
                    <p><?= $task_result['start_date'] ?></p>
                </div>
                <div class="info">
                    <label for="">Due Date : </label>
                    <p><?= $task_result['due_date'] ?></p>
                </div>
                <div class="info">
                    <label for="">Task Given Period : </label>
                    <p><?= $task_result['days'] ?> Days</p>
                </div>


                <!-- Days Countdown -->

                <?php
                $due_date = date($task_result['due_date']);
                $time = date('00:00:00');
                $count_date = $due_date . ' ' . $time;
                ?>

                <script type="text/javascript">
                    // Take date from php variable
                    var project_date = "<?php echo $count_date; ?>";
                    var countDownDate = new Date(project_date).getTime();
                    //Update the count down for every second 
                    var x = setInterval(function() {
                        //Get latest date
                        var now = new Date().getTime();
                        //Get the distance between latest date and the countdown date
                        var distance = countDownDate - now;
                        console.log(distance);

                        //Count Time 
                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        var hours = Math.floor(distance % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));

                        document.getElementById("countdown").innerHTML = days + " Days " + hours + " Hours " + "left";

                        if (distance < 1) {
                            clearInterval(x);
                            document.getElementById("countdown").innerHTML = "Due!!!";
                        }

                        var taskName = "<?php echo $task_result['task_name'] ?>"
                        Notification.requestPermission().then(perm => {
                            if (perm === "granted") {
                                if (document.getElementById("countdown").innerHTML == "Due!!!") {
                                    new Notification("You have received a notification", {
                                        body: "This task (" + taskName + ") has been Expired !!!",
                                    });
                                }
                            }
                        })

                    }, 1000);
                </script>

                <div class="info">
                    <label for="">Time Remaining : </label>
                    <?php

                    echo '
                <p id="countdown"></p>
                ';
                    ?>
                </div>

                <!-- Days Countdown -->

                <div class='info'>
                    <label for=''>User : </label>
                    <div class='task_user'>
                        <?php
                        $show_user_sql = "SELECT * FROM collab_db 
                        JOIN user_db
                        ON collab_db.user_id = user_db.userID 
                        WHERE taskid = $task_id";
                        $check_user_sql = mysqli_query($dbconnection, $show_user_sql);
                        $check_user_row = mysqli_num_rows($check_user_sql);
                        if ($check_user_row > 0) {
                            while ($result_user_sql = mysqli_fetch_assoc($check_user_sql)) {
                                if ($data_user_sql['role'] == "Manager") {
                                    echo "
                                    <img src='user_image/" . $result_user_sql['user_img'] . "' onclick='remove_user()'>
                                    ";
                                } else {
                                    echo "
                                    
                                    <img src='user_image/" . $result_user_sql['user_img'] . "'>
                                    
                                    ";
                                }
                            }
                        }

                        ?>
                    </div>
                    <div class='collab_user_detail'>

                        <?php

                        $show_user_sql = "SELECT * FROM collab_db 
                JOIN user_db
                ON collab_db.user_id = user_db.userID 
                WHERE taskid = $task_id";
                        $check_user_sql = mysqli_query($dbconnection, $show_user_sql);
                        $check_user_row = mysqli_num_rows($check_user_sql);



                        if ($check_user_row > 0) {

                            while ($result_user_sql = mysqli_fetch_assoc($check_user_sql)) {
                                echo "
                        <div class='user_details'>
                        <img src='user_image/" . $result_user_sql['user_img'] . "' alt=''>
                        <p>" . $result_user_sql['user_email'] . "</p>
                        <div class='remove'>
                            <a href='../backend/remove_collab_user.php?collab_id=" . $result_user_sql['colabID'] . "'>
                                <i class='bx bx-x'></i>
                            </a>
                        </div>
                        </div>
                        ";
                            }
                        }

                        ?>


                    </div>
                </div>
            </div>



            <div class="ext_function">
                <div class="desc">
                    <label for="">Description : </label>
                    <p><?= $task_result['description'] ?></p>
                </div>
            </div>



            <div class="comment_area">

                <?php

                //Sender SQl
                $comment_sql = "SELECT * FROM comment_db 
                    JOIN user_db 
                    ON comment_db.senderID = user_db.userID
                    WHERE comment_db.task_id = $task_id ORDER BY commentID DESC";
                $check_comment_sql = mysqli_query($dbconnection, $comment_sql);
                //Notification        

                if (mysqli_num_rows($check_comment_sql) > 0) {
                    while ($comment_result = mysqli_fetch_assoc($check_comment_sql)) {

                        echo "
                            <div class='display_comment'>
                            <img src='user_image/" . $comment_result['user_img'] . "' alt=''>
                            <div class='message_detail'>
                            <h6>" . $comment_result['user_name'] . " <span>(" . $comment_result['role'] . ")</span></h6>
                            <p>" . $comment_result['comment'] . "</p>
                            ";
                        if (!empty($comment_result['file'])) {
                            echo "
                                <p>Attach a File</p>
                                <a href='../backend/task_upload_file/" . $comment_result['file'] . "' download='" . $comment_result['file'] . "'>
                                " . $comment_result['file'] . "
                                <i class='bx bxs-download'></i>
                                </a>
                                ";
                        }
                        echo "</div>
                            </div>
                            ";
                    }
                }

                $sql = "SELECT * FROM comment_db 
                JOIN user_db 
                ON comment_db.senderID = user_db.userID
                WHERE comment_db.task_id = $task_id 
                AND comment_db.new_cmd = 1 
                AND senderID != $id";
                $result = mysqli_query($dbconnection, $sql);
                $msg_data = mysqli_fetch_assoc($result);

                // $user_sql = "SELECT * FROM user_db WHERE uniqueID = '$msg_data[sender_id]';";
                // $user_sql_result = mysqli_query($dbconnection, $user_sql);
                // $user_data = mysqli_fetch_assoc($user_sql_result);


                if (mysqli_num_rows($result) > 0) {

                    echo "
    <script>
    
    var notification = Notification.requestPermission().then(perm => {
        if (perm === 'granted') {
            new Notification('You have received a notification', {
            body: 'You got a new Message ', 
            });
        }
        })
        
</script>
    ";

                    $updateSql = "UPDATE comment_db SET new_cmd = 0 WHERE new_cmd = 1";
                    mysqli_query($dbconnection, $updateSql);
                }


                ?>

            </div>

            <?php




            if ($permit_result['user_id'] == $id || $project_sql_data['ownerID'] == $data_user_sql['uniqueID']) {

                echo "
                    <div class='comment_section'>
                    <form action='#' class='comment' method='POST'>
                        <div class='input_comment'>
                            <input type='text' name='taskid' value=" . $task_id . " hidden>
                            <input type='text' name='senderid' value=" . $id . " hidden>
                            <input name='comment' type='text' placeholder='Write your comment ...' autocomplete='off'>
                            <button class='snd_comment'>
                                <i class='bx bx-send'></i>
                            </button>
                        </div>
                    </form>
                </div>
                    ";
            }

            ?>



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
    <script type="text/javascript" src="../system_home/comment.js"></script>
</body>

</html>