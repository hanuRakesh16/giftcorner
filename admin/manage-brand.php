<?php
include 'partials/menu.php';
?>
<div class="main-content">
<div class="wrapper">
<h1>Manage Type</h1>
<br>
<br><br> 
    <a href="add-brand.php" class="btn-primary">Add Type</a><br><br>

    <table class="tbl-full">
    <tr>
    <th>S.no</th>
    <th>Name</th>
    <th>Action</th>
    </tr>
    <?php
                //query to get all admin
                  $sql = "SELECT * FROM brands";
                  //execute the query
                  $res = mysqli_query($conn, $sql);
                  //check executed or not

                  if($res == TRUE){
                  $count = mysqli_num_rows($res);

                  $sn =1;//create variable and assign the value
                  if($count>0)
                  {
                      while($rows=mysqli_fetch_assoc($res))
                      {
                        $id = $rows['brand_id'];
                        $bname = $rows['brand_title'];
                     
            
                        //display in table
                        ?>
                             <tr>
                              <td><?php echo $sn++ ; ?></td>
                              <td><?php echo $bname; ?></td>
                            
                              
                              <td>
                                <!-- <a href="#" class="btn-primary">Change password</a> -->
                              <!-- <a href="<?php echo SITEURL;?>admin/update-user.php?id=<?php echo $id; ?>" class="btn-primary">Update</a> -->
                              <a href="<?php echo SITEURL;?>admin/delete-brand.php?id=<?php echo $id; ?>" class="btn-secondary">Delete</a>
                             
                            </td>
                            </tr> 


                        <?php

                      }  
                  }
                 
                }
                ?>
    </table>

</div>

</div>