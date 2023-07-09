<?php

session_start();
error_reporting(0);
include_once 'dbconnection.php';

$id = $_SESSION['id'];

$task_id = $_GET['taskid'];

$userEmail = mysqli_real_escape_string($dbconnection, $_POST['email']);

if (!empty($userEmail)) {

    $sql = "SELECT * FROM user_db WHERE user_email = '$userEmail'";
    $check = mysqli_query($dbconnection, $sql);
    $result = mysqli_fetch_assoc($check);
} else {
    header('Location: ../system_home/task_details.php?taskid=' . $task_id);
}

$valid_sql = "SELECT * FROM collab_db WHERE taskid = $task_id AND user_id = $result[userID]";
$check_valid = mysqli_query($dbconnection, $valid_sql);
$valid_result = mysqli_fetch_assoc($check_valid);

$user_id = $result['userID'];
$_SESSION['userid'] = $user_id;

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

    <div class="user_list_display">
        <div class="user">
            <table>
                <tr>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Company Name</th>
                    <th>Role</th>
                    <th>Invite / Cancel</th>
                </tr>

                <tr>
                    <td><?= $result['user_name'] ?></td>
                    <td><?= $result['user_email'] ?></td>
                    <td><?= $result['company_name'] ?></td>
                    <td><?= $result['role'] ?></td>
                    <td>
                        <a href="task_collab.php?taskid=<?= $task_id ?>" <?php

                                                                            if ($result['userID'] == $id || $valid_result['user_id'] == $result['userID']) {
                                                                                echo "style=display:none;";
                                                                            }

                                                                            ?>>Send Invite</a>
                        <a href="../system_home/task_details.php?taskid=<?= $task_id ?>">Cancel</a>
                    </td>
                </tr>
        </div>
    </div>

    <script type="text/javascript" src="../home/index.js"></script>
</body>

</html>