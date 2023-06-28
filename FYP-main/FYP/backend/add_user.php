<?php

session_start();
include_once 'dbconnection.php';

$user_id = $_GET['userid'];
$owner_userid = $_SESSION['id'];

$sql = "INSERT INTO userlist_db (chat_ownerid , added_userid) 
VALUES({$owner_userid} , {$user_id})";
mysqli_query($dbconnection , $sql);

$_SESSION['message'] = "User Has Been Added To Your Chat List";
header('Location: ../system_home/system_chat.php');

?>