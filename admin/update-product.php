<?php
include 'partials/menu.php';
?>
     <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $category = $_POST['category'];
            $brand = $_POST['brand'];
            $title = $_POST['title'];
           
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
           
            $image = $_POST['image'];
           
            //img selected or not
            if (isset($_FILES['image']['name'])) {

                $image_name = $_FILES['image']['name'];
                if ($image_name != "") {
                    //auto rename images
                    $ext = end(explode('.', $image_name));

                    $image_name = "product-" . rand(000, 999) . '.' . $ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../assets/prod_img/" . $image_name;

                    //finally upload the img

                    $upload = move_uploaded_file($source_path, $destination_path);

                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>upload failed</div>";
                        header('location:' . SITEURL . 'admin/manage-products.php');

                        //stop the process
                        die();
                    }
                   // remove current_image
                    if ($current_image != "") {
                        $remove_path = '../assets/prod_img/' . $current_image;
                        $remove = unlink($remove_path);
                        if ($remove == false) {
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove Image.</div>";
                            header("location:" . SITEURL . "admin/manage-products.php");
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }


            //update db
            $sql2 = "UPDATE products SET
                product_cat = '$category',
                product_brand = '$brand',
                product_title='$title',
               
                product_price = '$price',
                product_image = '$image'
               
                WHERE product_id='$id'";

            //execute query
            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == TRUE) {
                $_SESSION['update'] = "<div class='success'>Updated Successfully.</div>";
                header("location:" . SITEURL . "admin/manage-products.php");
            } else {
                $_SESSION['update'] = "<div class='error'>Update Failed.</div>";
                header("location:" . SITEURL . "admin/update-product.php");
            }
        }
        ?>

<div class="main-content">

    <div class="wrapper">
        <h1>Update Product</h1>
        <br><br>

        <?php
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
            $sql = "SELECT * FROM products WHERE product_id='$id'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                $row = mysqli_fetch_array($res);
                $current_category = $row['product_cat'];
                $current_brand = $row['product_brand'];
                $title = $row['product_title'];
                $current_image = $row['product_image'];
                
                $price = $row['product_price'];
               
            } else {
                $_SESSION['no-category-found'] = "<div class='error'>No product Found</div>";
                header("location:" . SITEURL . 'admin/manage-products.php');
            }
        } else {
            header('location:' . SITEURL . 'admin/manage-products.php');
        }
        ?>



        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                        <?php
                            $upcat = "SELECT * FROM categories";
                            $res =mysqli_query($conn, $upcat);
                            $count = mysqli_num_rows($res);
                            if($count>0){
                                    while($row = mysqli_fetch_assoc($res)){
                                        $id = $row['cat_id'];
                                        $cname = $row['cat_title'];

                                        ?>
                                         <option <?php if($current_category ==$id){echo "selected";}?> value="<?php echo $id;?>"><?php echo $cname;?></option>
                                         <?php
                                    } 
                            }
                        ?>

                           


                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Type:</td>
                    <td>
                    <select name="brand">
                        <?php
                            $upbrand = "SELECT * FROM brands";
                            $res =mysqli_query($conn, $upbrand);
                            $count = mysqli_num_rows($res);
                            if($count>0){
                                    while($row = mysqli_fetch_assoc($res)){
                                        $id = $row['brand_id'];
                                        $bname = $row['brand_title'];

                                        ?>
                                         <option <?php if($current_brand ==$id){echo "selected";}?> value="<?php echo $id;?>"><?php echo $bname;?></option>
                                         <?php
                                    } 
                            }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
               
                <tr>
                    <td>price:</td>
                    <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php if ($current_image != "") {
                        ?>
                        <img src="<?php echo SITEURL; ?>assets/prod_img/<?php echo $current_image; ?>" width="100px"
                            height="100px">
                        <?php
                        } else {
                            echo "<div class='error'>Image not Added</div>";
                        } ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td><input type="file" name="image" value=""></td>
                </tr>
              

                <tr>
                    <td colspan="2"><br>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Product" class="btn-primary">
                    </td>
                </tr>


            </table>
        </form>

   

    </div>

</div>



<?php
include 'partials/footer.php';
?>