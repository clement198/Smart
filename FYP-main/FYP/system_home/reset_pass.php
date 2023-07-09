<?php
session_start();
$user_email = $_GET['email'];

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
    <title>Reset Password</title>
</head>

<body>
    <div class="reset">
        <a href="../login/login.php"><i class='bx bx-x'></i></a>
        <form action="../backend/reset_pass_back.php?email=<?= $user_email ?>" method="POST">
            <h1>Reset Password</h1>
            <p>Please enter your new password</p>
            <div class="newpass">
                <input type="password" id="newPass-input" placeholder="New Password" name="newpass" required>
                <i class='bx bx-hide' onclick="showNewPass()" id="newPass"></i>
            </div>

            <div class="repass">
                <input type="password" id="rePass-input" placeholder="Re-Type Password" name="repass" required>
                <i class='bx bx-hide' onclick="showRePass()" id="rePass"></i>
            </div>

            <input type="submit">
        </form>
    </div>

    <?php
    if (isset($_SESSION['message'])) {
        echo "
        <figure class='notification'>
            <div class='notification_body'>
            <i class='bx bx-alarm-exclamation'></i>
                <p>" . $_SESSION['message'] . "</p>
                <i class='bx bx-shield-x' ></i>
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