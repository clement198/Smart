<?php

include_once 'dbconnection.php';

$search_user = $_POST['search'];
    $sql = "SELECT * FROM user_db WHERE user_email = '$search_user'";
    $check_result = mysqli_query($dbconnection , $sql);

    if(mysqli_num_rows($check_result) > 0){
        while($result = mysqli_fetch_assoc($check_result)){

            echo "
    
    <div class='list'>
        <img src='../system_home/user_image/".$result['user_img']."'>
        <div class='details'>
            <h2>".$result['user_name']."</h2>
            <h3>".$result['user_email']."</h3>
        </div>
    </div>
";

        } 
    }
    else {
        echo "No User Found";
    }

?>

<div class="add_user">
                <label for="">Team :</label>
                <a href="#" onclick="actSearch()">
                    <i class='bx bx-user-plus'></i>
                </a>
            </div>
            </form>

            <form action="#" method="POST" class="searchForm">
            <div class="search_bar">
                <p>Invite user to join Your Project</p>
                <input type="text" class="input_bar" name="search" placeholder="User Email...">
                <!-- <input type="submit" class="search_btn" value="Invite"> -->
                <button class="cancel" onclick="actSearch()">Cancel</button>

                <div class="wrap">
                
                </div>
            </div>
            </form>