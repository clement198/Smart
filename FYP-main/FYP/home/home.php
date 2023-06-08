<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <!-- Google Font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dongle:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- Google Font  -->

    <!-- Icon package -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Icon package -->
    <title>Home - Smart</title>
</head>
<body>
    <header class="nav">
        <div class="navbar">
            <div class="brand">
                <a href="#">
                    <img src="logo3.png" alt="">
                </a>
            </div>
            <ul id="navlist" class="list">
                <li><a href="#">Home</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>

            <div class="log">
                <a href="../login/login.php"><i class='bx bx-user'></i>Login</a>
                <a href="../register/register.php"><i class='bx bx-edit-alt'></i>Register</a>
                <i id="menu" onclick="myMenu()" class='bx bx-chevrons-left'></i>
            </div>
        </div>
    </header>
    

    <!-- <section class="showcase">
        <div class="title">
            <h1>
                Smart
                <span>Project Management</span>
            </h1>
            <a href="#">Get Started</a>
        </div>
    </section> -->

    <script type="text/javascript" src="index.js"></script>
</body>
</html>