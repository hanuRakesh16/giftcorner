<?php

include '../dbconnect.php';
//get the id

if(isset($_GET['id']) AND isset($_GET['image_name'])){
    $id = $_GET['id']; 
    $image_name = $_GET['image_name'];

    if($image_name != ""){
        $path = "../assets/prod_img/".$image_name;
        $remove = unlink($path);

        if($remove == FALSE){
            $_SESSION['remove']="<div class='error'>Failed to remove Image</div>";
            header('location:'.SITEURL.'admin/manage-products.php');
            die();
        }
    }

 

//create sqllll to deelete
$sql = "DELETE FROM products WHERE product_id=$id";

//execute the query
$res = mysqli_query($conn, $sql);


//check query is executed
if($res==True) {
    //echo "success ";
    $_SESSION['delete-product'] =" <div class='success'>Deleted Successfully</div>";
    header('location:'.SITEURL.'admin/manage-products.php');
}
else{
    //echo "failed";
    $_SESSION['delete-product'] = "failed to delete";
    header('location:'.SITEURL.'admin/manage-products.php');
}
}
else{
    header('location:'.SITEURL.'admin/manage-products.php');
}

//redirect to manage admin page with msg
