<?php 
include 'partials/menu.php';
?>
<div class = "main-content">
<div class = "wrapper">
<h1>Update Orders</h1>
        <br>
        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];

                $sql = "SELECT * FROM customer_order WHERE id=$id";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);
                if($count == 1){
                    $row = mysqli_fetch_assoc($res);
                    $status = $row['p_status'];
                }
                else{
                    header('location:'.SITEURL.'admin/update-order.php');
                }
            }
            else{
                header('location:'.SITEURL.'admin/update-order.php');
            }
        ?>

        <form action = "" method = "POST">
        <tr>
        <td>STATUS:</td>
        <td>
            <select name = "status">
            <option <?php if($status =="confirmed"){ echo 'selected'; } ?> value ="confirmed">Confirmed</option>
            <option <?php if($status =="ondelivery"){ echo 'selected'; } ?> value ="ondelivery">On Delivery</option>
            <option <?php if($status =="deliveried"){ echo 'selected'; } ?> value ="Deliveried">Deliveried</option>
            <option <?php if($status =="cancelled"){ echo 'selected'; } ?> value ="cancelled">Cancelled</option>
            
            </select>
        </td>
        </tr>
        <tr>
        <td colspan='2' ><br><br>
        <input type="hidden" name ="id" value = <?php echo $id; ?>>
        <input type = "submit" value = "Update" name = "submit" class = "btn btn-primary">
        </td>
        </tr>
        
        </form>

        <?php
if(isset($_POST['submit'])){
    $status = $_POST['status'];

    $sql2="UPDATE customer_order SET
    p_status = '$status' WHERE id=$id";

    $res2 = mysqli_query($conn,$sql2);

    if($res2 == TRUE){
        $_SESSION['update'] = "<div class='success'>Updated</div>";
        header('location'.SITEURL.'admin/manage-order.php');
    }
    else{
        $_SESSION['update'] = "<div class='error'>Update Failed</div>";
        header('location'.SITEURL.'admin/manage-order.php');
    }
}
        ?>

</div>

</div>

<?php 
include 'partials/footer.php';
?>