<?php

session_start();
include_once 'dbconnection.php';

$event_name = mysqli_real_escape_string($dbconnection , $_POST['event']);
$event_time = mysqli_real_escape_string($dbconnection , $_POST['time']);
$event_date = mysqli_real_escape_string($dbconnection , $_POST['date']);

$sql = "INSERT INTO event_db (event_name , event_time , event_date)
VALUES ('{$event_name}','{$event_time}','{$event_date}')";
mysqli_query($dbconnection, $sql);

$_SESSION['message'] = "Event has been created successfully";
header('Location: ../system_home/calender.php');

?>