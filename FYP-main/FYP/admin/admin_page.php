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
    <title>Admin</title>
</head>

<body>
    <header>
        <div class="logo">
            <img src="../home/logo3.png" alt="">
        </div>
        <div class="user">
            <li><a class="logout" href="../backend/logout.php">Logout<i class='bx bx-log-out'></i></a></li>
        </div>
    </header>

    <section class="menu">
        <div class="list">
            <a href="#" onclick="showUser()">
                <i class='bx bx-user bx-tada'></i>
                <h3>User Database</h3>
            </a>
        </div>
        <div class="list">
            <a href="#" onclick="showProject()">
                <i class='bx bx-task bx-tada'></i>
                <h3>Project Database</h3>
            </a>
        </div>

        <div class="list">
            <a href="#" onclick="showMsg()">
                <i class='bx bxs-chat bx-tada'></i>
                <h3>Chat History</h3>
            </a>
        </div>
    </section>

    <section class="user_table">
        <div class="table">
            <table>
                <tr class="tableHead">
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>User Password</th>
                    <th>Company Name</th>
                    <th>Role</th>
                    <th>Edit / Delete</th>
                </tr>

                <?php

                include_once '../backend/dbconnection.php';

                $user_sql = "SELECT * FROM user_db WHERE userID != 0";
                $check_db_result = mysqli_query($dbconnection, $user_sql);
                $check_row = mysqli_num_rows($check_db_result);
                if ($check_row > 0) {
                    while ($result = mysqli_fetch_assoc($check_db_result)) {
                        echo "<tr>";

                        echo "<td>" . $result['userID'] . "</td>";
                        echo "<td>" . $result['user_name'] . "</td>";
                        echo "<td>" . $result['user_email'] . "</td>";
                        echo "<td>" . $result['user_pass'] . "</td>";
                        echo "<td>" . $result['company_name'] . "</td>";
                        echo "<td>" . $result['role'] . "</td>";
                        echo "<td class='modifyBtn'>";
                        echo "<a href='user_edit_delete/edit_page.php?editID=" . $result['userID'] . "' class='edit'>Edit</a>";
                        echo "<a href='user_edit_delete/delete_confirmation.php?deleteID=" . $result['userID'] . "' class='delete'>Delete</a>";
                        echo "</td>";

                        echo "</tr>";
                    }
                }

                ?>

            </table>
        </div>
    </section>

    <section class="project_table">
        <div class="table">
            <table>
                <tr class="tableHead">
                    <th>Project ID</th>
                    <th>Project Name</th>
                    <th>Project Type</th>
                    <th>Project Start Date</th>
                    <th>Project End Date</th>
                    <th>Edit / Delete</th>
                </tr>

                <?php

                include_once '../backend/dbconnection.php';

                $user_sql = "SELECT * FROM project_db";
                $check_db_result = mysqli_query($dbconnection, $user_sql);
                $check_row = mysqli_num_rows($check_db_result);
                if ($check_row > 0) {
                    while ($result = mysqli_fetch_assoc($check_db_result)) {
                        echo "<tr>";

                        echo "<td>" . $result['projectID'] . "</td>";
                        echo "<td>" . $result['project_name'] . "</td>";
                        echo "<td>" . $result['project_type'] . "</td>";
                        echo "<td>" . $result['start_date'] . "</td>";
                        echo "<td>" . $result['due_date'] . "</td>";
                        echo "<td class='modifyBtn'>";
                        echo "<a href='project_edit_delete/edit_page.php?editID=" . $result['projectID'] . "' class='edit'>Edit</a>";
                        echo "<a href='project_edit_delete/delete_confirmation.php?deleteID=" . $result['projectID'] . "' class='delete'>Delete</a>";
                        echo "</td>";

                        echo "</tr>";
                    }
                }

                ?>

            </table>
        </div>
    </section>

    <section class="msg_table">
        <div class="table">
            <table>
                <tr class="tableHead">
                    <th>Message ID</th>
                    <th>Message Sender ID</th>
                    <th>Message Receiver ID</th>
                    <th>Message</th>
                    <th>Message File Name</th>
                </tr>

                <?php
                include_once '../backend/dbconnection.php';

                $data_per_page = 5;

                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }

                $default_page = ($page - 1) * 5;

                $user_sql = "SELECT * FROM msg_db LIMIT $default_page , $data_per_page";
                $check_db_result = mysqli_query($dbconnection, $user_sql);
                $check_row = mysqli_num_rows($check_db_result);
                if ($check_row > 0) {
                    while ($result = mysqli_fetch_assoc($check_db_result)) {
                        echo "<tr>";

                        echo "<td>" . $result['msgID'] . "</td>";
                        echo "<td>" . $result['sender_id'] . "</td>";
                        echo "<td>" . $result['receiver_id'] . "</td>";
                        echo "<td>" . $result['msg'] . "</td>";
                        echo "<td>" . $result['file'] . "</td>";

                        echo "</tr>";
                    }
                }

                ?>

            </table>
        </div>
        <div class="pagination">

            <?php

            $get_page_sql = "SELECT * FROM msg_db";
            $check_page_sql = mysqli_query($dbconnection, $get_page_sql);
            $page_result = mysqli_num_rows($check_page_sql);
            $total_page = ceil($page_result / $data_per_page);

            for ($i = 1; $i <= $total_page; $i++) {
                echo "
                        <div class='page_num'>
                            <a href='admin_page.php?page=" . $i . "'>" . $i . "</a>
                            </div>
                            ";
            }

            ?>

        </div>
    </section>




    <script type="text/javascript" src="index.js"></script>
</body>

</html>