<?php
session_start();
include_once '../../backend/dbconnection.php';

$projectID = $_GET['editID'];

$project_data = "SELECT * FROM project_db WHERE projectID = $projectID";
$check = mysqli_query($dbconnection ,$project_data);
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
    <title>Project Edit Page</title>
</head>
<body>
<div class="blur">
        <div class="form">
        <form action="edit.php?projectID=<?=$projectID?>" method="POST">
            <h1>Edit Project</h1>
            <div class="database_form">
                <label for="">Project Name :</label>
                <input type="text" name="name" value="<?=$result['project_name']?>">
            </div>

            <div class="database_form">
                <label for="">Project Type :</label>
                <input type="text" value="<?=$result['project_type']?>" name="type">
            </div>

            <div class="database_form">
                <label for="">Start Date :</label>
                <input type="date" value="<?=$result['start_date']?>" name="sdate">
            </div>

            <div class="database_form">
                <label for="">End Date :</label>
                <input type="date" value="<?=$result['due_date']?>" name="ddate">
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