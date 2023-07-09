<?php

session_start();
include_once 'dbconnection.php';

$event_id = $_GET['eventid'];

$sql = "DELETE FROM event_db WHERE eventID = $event_id";
mysqli_query($dbconnection , $sql);
$_SESSION['message'] = "Event Has been Deleted";

header('Location: ../system_home/calender.php');
