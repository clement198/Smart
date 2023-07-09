<?php
session_start();
include_once 'dbconnection.php';
unset($_SESSION['id']);
unset($_SESSION['admin']);

header('Location: ../login/login.php');
