<?php

include '../dbconnect.php';
//get the id
$id = $_GET['id'];  

//create sqllll to deelete
$sql = "DELETE FROM brands WHERE brand_id=$id";

//execute the query
$res = mysqli_query($conn, $sql);

//check query is executed
if($res==True) {
    //echo "success ";
    $_SESSION['delete'] =" <div class='success'> Deleted Successfully</div>";
    header('location:'.SITEURL.'admin/manage-brand.php');
}
else{
    //echo "failed";
    $_SESSION['delete'] = "failed to delete ";
    header('location:'.SITEURL.'admin/manage-brand.php');
}

//redirect to manage admin page with msg
?>