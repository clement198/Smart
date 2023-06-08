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
    <!-- Icon package -->
    <title>Register</title>
</head>
<body>
<form action="../backend/register_back.php" method="POST">
<div class="input-box">
        <div class="brand">
            <img src="../home/logo3.png" alt="">
        </div>

        <div class="input">
            <div class="greet">
                <h2>Create Account</h2>
            </div>

                <label for="name">Name :</label>
                <input type="text" name="username" placeholder="Name" required>

                <label for="email">Email :</label>
                <input type="text" name="email" placeholder="Email" required>
                
                <label for="pass">Password :</label>
                <div class="myPass">
                    <input class="pass" name="pass"  type="password" placeholder="Password" required>
                    <i id="show" onclick="showPass()" class='bx bx-hide'></i>
                </div>
                

                <input type="submit" value="Complete">
                <a class="" href="../login/login.php">Already Have Account ? Log in</a>
            
        </div>
    </div>
    </form>
    
<script type="text/javascript" src="../home/index.js"></script>
</body>
</html>