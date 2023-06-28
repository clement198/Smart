<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../home/index.css">
    <link rel="stylesheet" href="../system_home/notification.css">
    <!-- Google Font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dongle:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- Google Font  -->

    <!-- Icon package -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Icon package -->
    <title>Login</title>
</head>

<body>

    <?php
    session_start();
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
    <div class="login-box">
        <div class="brand">
            <img src="../home/logo3.png" alt="">
        </div>

        <div class="login">
            <div class="greet">
                <h2>Welcome!</h2>
            </div>

            <form action="../backend/login_back.php" method="POST">

                <label for="username">Email :</label>
                <input type="text" name="email" placeholder="Email" required>

                <label for="pass">Password :</label>
                <div class="myPass">
                    <input class="pass" name="password" type="password" placeholder="Password" required>
                    <i id="show" onclick="showPass()" class='bx bx-hide'></i>
                </div>

                <a href="#">Forgot Password ?</a>

                <input type="submit" value="Login">
                <a href="../register/register.php">Do not have account yet ?</a>

            </form>

        </div>
    </div>


    <script type="text/javascript" src="../home/index.js"></script>
</body>

</html>