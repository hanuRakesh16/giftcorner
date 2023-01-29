<?php 
    //access control
    if(!isset($_SESSION['user'])){
         $_SESSION['no-login-msg'] = "<div class='error text-center'>Please Login</div><br>";
         header('location:'.SITEURL.'admin/login.php');
    }
?>