<?php

$project_id = $_GET['projectid'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin/index.css">
    <!-- Google Font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dongle:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- Google Font  -->
    <!-- Icon package -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Confirmation</title>
</head>
<body>

    <!-- Delete Confirmation -->
    <div class="confirmation">
        <div class="delete">
            <div class="delete_msg">
            <p>Are you sure want to delete this task ? </p>
            <a href="../backend/delete.php?projectid=<?=$project_id?>">Yes</a>
            <a href="../system_home/system_home_page.php">No</a>
            </div>
        </div>
    </div>
    
    
<script type="text/javascript" src="index.js"></script>
</body>
</html>