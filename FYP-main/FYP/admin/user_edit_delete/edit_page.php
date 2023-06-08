<?php
session_start();
include_once '../../backend/dbconnection.php';

$userID = $_GET['editID'];

$user_data = "SELECT * FROM user_db WHERE userID = $userID";
$check = mysqli_query($dbconnection ,$user_data);
$result = mysqli_fetch_assoc($check);

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <!-- Google Font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dongle:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- Google Font  -->
    <!-- Icon package -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>User Edit Page</title>
</head>
<body>
<div class="blur">
        <div class="form">
        <form action="edit.php?userID=<?=$userID?>" method="POST">
            <h1>Edit User</h1>
            <div class="database_form">
                <label for="">Name :</label>
                <input type="text" name="name" value="<?=$result['user_name']?>">
            </div>

            <div class="database_form">
                <label for="">Email :</label>
                <input type="text" value="<?=$result['user_email']?>" name="email">
            </div>

            <div class="database_form">
                <label for="">Password :</label>
                <input type="text" value="<?=$result['user_pass']?>" name="pass">
            </div>

            <div class="database_form">
                <label for="">Company Name :</label>
                <input type="text" value="<?=$result['company_name']?>" name="company">
            </div>

            <div class="database_form">
                <label for="">Role :</label>
                <input type="text" value="<?=$result['role']?>" name="role">
            </div>

            <div class="subBtn">
            <input type="submit" name="submit" value="Update User">
            <a href="../admin_page.php" class="cancel" >Cancel</a>
            </div>
            </form>
        </div>
    </div>

    <script type="text/javascript" src=""></script>
</body>
</html>