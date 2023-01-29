<?php
include 'partials/menu.php';

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Orders</h1>
        <br><br>
        <?php
          if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
          }
        ?>

        <table class="tbl-full">
            <tr>
                <th>S.no</th>
                <th>User ID</th>
                <th>PRoduct Id</th>
                
                <th>Product name</th>
                <th>Price</th>

                <th>Quantity</th>
             
                <th>Status</th>
                <th>Actions</th>
                

            </tr>

            <?php
                  $sql = "SELECT * FROM customer_order ORDER BY id DESC";
                  $res = mysqli_query($conn,$sql);
                  $count = mysqli_num_rows($res);
                  $sn=1;

                  if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                      $id = $row['id'];
                      $uid = $row['uid'];
                      $pid = $row['pid'];
                      $pname = $row['p_name'];
                      $price = $row['p_price'];
                      $qty = $row['p_qty'];
                     
                    
                      $status = $row['p_status']; ?>
            <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $uid; ?></td>
                <td><?php echo $pid; ?></td>
                
              
                <td><?php echo $pname; ?></td>
                <td><?php echo $price; ?></td>
                <td><?php echo $qty; ?></td>
               
                <td><?php echo $status; ?></td>
                <td>
                    <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-primary">Update</a>
                </td>
            </tr>
            <?php
                    }


                  }
                  else{
                    echo "<tr><td colspan='12' class='error'>No Orders</td></tr>";
                  }
                ?>



        </table>

        <div class="clearfix"></div>

    </div>

</div>






<?php
include 'partials/footer.php';
?>