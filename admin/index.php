<?php
include 'partials/menu.php';
?>


<!-- menu section -->
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>
        <?php 
               $sql = "SELECT * FROM categories";
               $res = mysqli_query($conn, $sql);
               $count = mysqli_num_rows($res);
               ?>
        <div class="col-4 text-center">
            <h1><?php echo $count;?></h1><br>
            Categories
        </div>
        <?php 
               $sql2 = "SELECT * FROM brands";
               $res2 = mysqli_query($conn, $sql2);
               $count2 = mysqli_num_rows($res2);
               ?>
        <div class="col-4 text-center">
            <h1><?php echo $count2; ?></h1><br>
            Brands
        </div>
        <?php 
               $sql3 = "SELECT * FROM products";
               $res3 = mysqli_query($conn, $sql3);
               $count3 = mysqli_num_rows($res3);
               ?>
        <div class="col-4 text-center">
            <h1><?php echo $count3;?></h1><br>
            Products
        </div>
        <?php 
               $sql4 = "SELECT * FROM customer_order";
               $res4 = mysqli_query($conn, $sql4);
               $count4 = mysqli_num_rows($res4);
               ?>
        <div class="col-4 text-center">
            <h1><?php echo $count4; ?></h1><br>
            Total Orders
        </div>
        <div class="clearfix"></div>

    </div>

</div>


<?php
      include 'partials/footer.php';
      ?>