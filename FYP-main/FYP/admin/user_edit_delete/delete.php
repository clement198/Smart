<?php

session_start();
include_once '../../backend/dbconnection.php';

$userID = $_GET['deleteID'];

$sql = "DELETE FROM user_db WHERE userID = $userID";
mysqli_query($dbconnection , $sql);

header('Location: ../admin_page.php');

?>