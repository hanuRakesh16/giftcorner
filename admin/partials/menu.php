<?php include '../dbconnect.php';
//include('login-check.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="./admin.css">
</head>
<body>
        <!--main content  -->
        <div class="menu text-center"> 
            <div class="wrapper"> 
                <ul>
                    <li> <a href="index.php">Home</a> </li>
                    <li><a href="manage-user.php">Users</a></li>
                    <li><a href="manage-category.php">Shops</a></li>
                    <li><a href="manage-brand.php">Types</a></li>
                   
                    <li><a href="manage-products.php">Product</a></li>
                  
                    <li><a href="manage-order.php">Orders</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>