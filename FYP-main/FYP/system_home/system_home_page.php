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
    <title>Home-Smart</title>
</head>
<body>

    <header class="top-bar">
        <div class="user">
            <a href="profile.php"><img src="../system_home/user_image/<?=$data['user_img']?>" alt=""></a>
            <li><a class="logout" href="../backend/logout.php">Logout<i class='bx bx-log-out'></i></a></li>
        </div>
        <div class="location">
            <h3>Home</h3>
        </div>
    </header>
    <nav class="side-bar">
        <div class="brand">
            <a href="#">
                <img src="../home/logo3.png" alt="">
            </a>
        </div>
        <ul class="menu-list">
        <li><a href="#" class="active"><i class='bx bxs-home' ></i>Home</a></li>
            <li><a href="system_dash.php"><i class='bx bxs-dashboard' ></i>Dashboard</a></li>
            <li><a href="system_chat.php"><i class='bx bxs-chat' ></i>Chat</a></li>
            <li><a href="#"><i class='bx bxs-group' ></i>Team Member</a></li>
        </ul>
    </nav>

    <div class="project_area">
        <div class="add_project">
            <label for="">New Project : </label>
            <a href="#" class="btn" onclick="popUps()">
                <i class='bx bx-plus'></i>
            </a>
        </div>

        <div class="blur">
        <div class="popup_form">
            <form action="../backend/project_back.php" method="POST">
            <h1>New Project</h1>
            <div class="project_form">
                <label for="">Project Name :</label>
                <input type="text" name="projectName" placeholder="Project Name">
            </div>

            <div class="project_form">
                <label for="">Project Type :</label>
                <select name="type">
                    <option value="">Choose Your Project Type</option>
                    <option value="Web Development">Web Development</option>
                    <option value="Mobile Development">Mobile Development</option>
                </select>
            </div>

            <div class="project_form">
                <label for="start_date">Start Date :</label>
                <input type="date" name="sdate">
            </div>

            <div class="project_form">
                <label for="due_date">Due Date :</label>
                <input type="date" name="ddate">
            </div>

            <input type="text" name="ownerid" value="<?=$data['uniqueID']?>" hidden>

            <div class="subBtn">
            <input type="submit" name="submit" value="Create Project">
            <a class="cancel" onclick="popUps()">Cancel</a>
            </div>
            </form>
        </div>
        </div>
        <div class='project_box'>
        <?php
        
        include_once '../backend/dbconnection.php';
        
        $project_data = "SELECT * FROM project_db";
        $check = mysqli_query($dbconnection , $project_data);

        if(mysqli_num_rows($check) > 0){
            while($result = mysqli_fetch_array($check)) {
                echo "
                
                <div class='project_item'>
                <div class='progress_bar'>
                    <div class='outer'>
                        <div class='inner'>
                            <div class='number'>

                            </div>
                        </div>
                    </div>
                </div>
        
                <svg xmlns='http://www.w3.org/2000/svg' version='1.1' width='120px' height='120px'>
                <defs>
                    <linearGradient id='GradientColor'>
                    <stop offset='10%' stop-color='#e91e63' />
                    <stop offset='100%' stop-color='#673ab7' />
                    </linearGradient>
                </defs>
                <circle cx='60' cy='60' r='50' stroke-linecap='round' />
                </svg>

                <a href='task.php?projectid=".$result['projectID']."'>
                <div class='project_details'>
                <h3>".$result['project_name']."</h3>
                <h5>".$result['project_type']."</h5>
                <p>Start Date :".$result['start_date']."</p>
                <p>End Date :".$result['due_date']."</p>
                </div>

                <div class='team_member'>
                    <img src='user_image/default.png'>
                </div>
                <div class='team_member'>
                    <img src='user_image/user1.png'>
                </div>
                </a>";
                    
                if($data['uniqueID'] == $result['ownerID']){
                    echo "<div class='modify'>
                    <a href='edit.php?projectid=".$result['projectID']."'><i class='bx bx-edit'></i></a>
                    <p onclick='myConfirm(this)'>
                    <i class='bx bx-trash'></i>

                    <div class='confirmation'>
                        <div class='content'>
                            <h3>Are you sure you want to delete this project?</h3>
                            <a href='../backend/delete.php?projectid=".$result['projectID']."'>Yes</a>
                            <a href='#' onclick='myConfirm(this)'>No</a>
                        </div>
                    </div>

                    </p>
                    </div>";
                }

                echo "
                
                </div>";
            }
        }

        ?>
    </div>
    
<script type="text/javascript" src="../home/search.js"></script>

</body>
</html>