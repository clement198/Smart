<?php
session_start();
include_once '../backend/dbconnection.php';

$id = $_SESSION['id'];

$sql = "SELECT * FROM user_db WHERE userID = $id";
$check_result = mysqli_query($dbconnection ,$sql);
$data = mysqli_fetch_assoc($check_result);

if(empty($id)){
    header('Location:../login/login.php');
}

$project_id = $_GET['projectid'];

$project_data = "SELECT * FROM project_db WHERE projectID = $project_id";
$check = mysqli_query($dbconnection ,$project_data);
$result = mysqli_fetch_assoc($check);

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
    <title>Project Edit Form</title>
</head>
<body>

    <div class="edit">
        <div class="form">
        <form action="../backend/edit_project_back.php?projectid=<?=$project_id?>" method="POST">
            <h1>Edit Project</h1>
            <div class="project_form">
                <label for="">Project Name :</label>
                <input type="text" name="projectName" value="<?=$result['project_name']?>">
            </div>

            <div class="project_form">
                <label for="">Project Type :</label>
                <select name="type">
                    <option value="">Choose Your Project Type</option>
                    <option value="Web Development"
                    <?php
                    
                    if($result['project_type'] == 'Web Development'){
                        echo "selected";
                    }
                    
                    ?>
                    >Web Development</option>
                    <option value="Mobile Development"
                    
                    <?php
                    
                    if($result['project_type'] == 'Mobile Development'){
                        echo "selected";
                    }
                    
                    ?>

                    >Mobile Development</option>
                </select>
            </div>

            <div class="project_form">
                <label for="start_date">Start Date :</label>
                <input type="date" value="<?=$result['start_date']?>" name="sdate">
            </div>

            <div class="project_form">
                <label for="due_date">Due Date :</label>
                <input type="date" value="<?=$result['due_date']?>" name="ddate">
            </div>

            <div class="subBtn">
            <input type="submit" name="submit" value="Update Project">
            <a href="system_home_page.php" class="cancel" >Cancel</a>
            </div>
            </form>
        </div>
    </div>

<script type="text/javascript" src="../home/search.js"></script>

</body>
</html>