<?php

include '../dbconnect.php';
//1.destroy the session
session_destroy();//unset $_SESSION['user]

//redirect to login
header('location:'.SITEURL.'admin/login.php');

?>