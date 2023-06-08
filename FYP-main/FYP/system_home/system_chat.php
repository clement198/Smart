<?php
session_start();
include_once '../backend/dbconnection.php';

$id = $_SESSION['id'];
$unique = $_SESSION['unique'];

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
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <link rel="stylesheet" href="../home/index.css">
    <!-- Google Font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dongle:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- Google Font  -->
    <!-- Icon package -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Chat-Smart</title>
</head>
<body>
    <header class="top-bar">
        <div class="user">
        <a href="profile.php"><img src="../system_home/user_image/<?=$data['user_img']?>" alt=""></a>
        <li><a class="logout" href="../backend/logout.php">Logout<i class='bx bx-log-out'></i></a></li>
        </div>
        <div class="location">
            <h3>Chat</h3>
        </div>
    </header>
    <div class="side-bar">
        <div class="brand">
            <a href="#">
                <img src="../home/logo3.png" alt="">
            </a>
        </div>
        <ul class="menu-list">
        <li><a href="system_home_page.php"><i class='bx bxs-home' ></i>Home</a></li>
            <li><a href="system_dash.php"><i class='bx bxs-dashboard' ></i>Dashboard</a></li>
            <li><a href="#" class="active"><i class='bx bxs-chat' ></i>Chat</a></li>
            <li><a href="#"><i class='bx bxs-group' ></i>Team Member</a></li>
        </ul>
    </div>

    <div class="user_chat">
        <div class="side">
            <div class="main">
            <img src="../system_home/user_image/<?=$data['user_img']?>" alt="">
            </div>

            <div class="search">
                <input type="text" placeholder="Search...">
                <i class='bx bx-search'></i>
            </div>
            

            <?php
            $sql2 = "SELECT * FROM user_db WHERE userID != $id AND userID != 0";
            $check_result2 = mysqli_query($dbconnection,$sql2);
            if(mysqli_num_rows($check_result2) > 0){
                while($row = mysqli_fetch_assoc($check_result2)){
                    echo "<a id='open_msg' href='system_chat.php?userid= ".$row['userID']."' onclick='myMsg()'>";
                    echo "<div class='user_list'>";
                    echo "<img src='../system_home/user_image/".$row['user_img']."' alt=''>";
                    echo "<div class='detail'>";
                    echo "<span>".$row['user_name']."</span>";
                    echo "<p>Active Now</p>";
                    
                    echo "</div>";
                echo "</div>";
                echo "</a>";
                }
                
            }
            ?>
        </div>

        <div id="chat" class="chat_area">
        <?php
                if(isset($_GET['userid'])){

                    $userid = $_GET['userid'];
                    $sql3 = "SELECT * FROM user_db WHERE userID = $userid";
                    $check_result3 = mysqli_query($dbconnection , $sql3);
                    $result = mysqli_fetch_assoc($check_result3);
                
                    echo 
                    "<div class='user'>
                    <img src='../system_home/user_image/".$result['user_img']."'>
                
                        <div class='detail'>
                            <span>".$result['user_name']."</span>
                            <p>Active Now</p>
                        </div>
                    </div>
                    <div class='chat_area'>
                    <div class='msg_box'>


                    </div>
                    ";

                    echo "
                    </div>
                    <form action='#' method='POST' class='message' enctype='multipart/form-data' autocomplete='off'>
                        <input type='text' name='senderid' value=".$data['uniqueID']." hidden>
                        <input type='text' name='receiverid' value=".$result['uniqueID']." hidden>
                        <input type='text' name='msg' placeholder='Type your message here...'>
                        <input type='file' name='docs' id='fileBtn' >
                        <label for='fileBtn'>
                        <i class='bx bx-file'></i>
                        </label>
                        <button class='sndBtn'><i class='bx bxs-send'></i></button>
                    </form>
        
                ";
                }
                
            ?>
        </div>
    </div>
<script type="text/javascript" src="../home/index.js"></script>
</body>
</html>