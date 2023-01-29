<?php
include 'partials/menu.php';
?>

    <div class=main-content>
    <div class="wrapper">
    <h1>Add Product</h1>
    <br><br>
    <?php
    if(isset($_SESSION['add'])){
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }
    if(isset($_SESSION['upload'])){
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }

    ?>
    <br><br>
    <form action="" method="POST" enctype="multipart/form-data">
    <table class="tbl-30">
        <tr>
        <td>Category:</td>
        <td>
            <select name = "category">
            <?php 
            $sql = "SELECT * FROM categories";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count>0){
                while($row = mysqli_fetch_assoc($res)){
                    $id = $row['cat_id'];
                    $catname = $row['cat_title'];
                    ?>
                        <option value="<?php echo $id;?>"><?php echo $catname;?></option>
                    <?php
                }

            }
            else{
                ?>
                     <option value="1">No categories</option>
                <?php
            }
            ?>
            
            </select>
        </td></tr>
        <tr>
        <td>Brand:</td>
        <td>
            <select name = "brand">
            <?php 
            $sql1 = "SELECT * FROM brands";
            $res1 = mysqli_query($conn, $sql1);
            $count1 = mysqli_num_rows($res1);
            if($count1>0){
                while($row = mysqli_fetch_assoc($res1)){
                    $id = $row['brand_id'];
                    $bname = $row['brand_title'];
                    ?>
                        <option value="<?php echo $id;?>"><?php echo $bname;?></option>
                    <?php
                }

            }
            else{
                ?>
                     <option value="1">No Brands</option>
                <?php
            }
            ?>
            </select>
        </td></tr>
        <tr>
        <td>Title:</td>
        <td>
            <input type="text" name="title" placeholder="title">
        </td></tr>
        
        <tr>
        <td>Price:</td>
        <td>
            <input type="number" name="price" placeholder="price">
        </td>
        
        </tr>
        <tr>
        <td>Image:</td>
        <td>
            <input type=file name="image">
        </td>
        </tr>
      
           

            <tr>
            <td colspan="2">
            <input type="submit" name="submit" value="Add Product" class="btn-primary">
            </td>
            </tr>
    </table>


    </form>

    <?php
    if(isset($_POST['submit'])){
       //get value from form
        $category = $_POST['category'];
        $brand = $_POST['brand'];
       $title = $_POST['title'];
      
       $price = $_POST['price'];
      
      
       
       //check img is uploaded
    if(isset($_FILES['image']['name'])){
        //upload the img
        $image_name = $_FILES['image']['name'];

        //upload only if img is selected
        if($image_name != ""){

        

        //auto rename images
        $ext = end(explode('.',$image_name));

        $image_name = "product-".rand(000,999).'.'.$ext;

        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../assets/prod_img/".$image_name;

        //finally upload the img

        $upload = move_uploaded_file($source_path, $destination_path);

        if($upload == false){
            $_SESSION['upload'] = "<div class='error'>upload failed</div>";
            header('location:'.SITEURL.'admin/add-product.php');

            //stop the process
            die();
        }
       

    }
    else{
        //not upload
        $image_name = "";
    }
       //create sql query for
       $sql2 = "INSERT INTO products SET 
       product_cat = '$category',
       product_brand = '$brand',
       product_title = '$title',
       product_price = '$price',
       product_image = '$image_name'
       ";
       //execute the query
       $res2 = mysqli_query($conn, $sql2);

       //checking execute query
        if($res2 == TRUE){
            $_SESSION['add'] = "<div class='success'>Added Successfully</div>";
            header('location:'.SITEURL.'admin/manage-products.php');
        }
        else{
            $_SESSION['add'] = "<div class='error'>Product Update Failed</div>";
            header('location:'.SITEURL.'admin/manage-products.php');
        }
    }
}


    ?>

    </div>
    </div>



<?php
include 'partials/footer.php';
?>