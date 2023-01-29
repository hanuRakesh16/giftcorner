<?php 
include 'partials/menu.php';
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update User</h1><br><br>

        <?php
            //get id of admin
            $id =$_GET['id'];
            //create query
            $sql = "SELECT * FROM tbl_user WHERE id = $id";
            //execute query
            $res = mysqli_query($conn,$sql);

            //check if executed or not
            if($res==TRUE){
                $count = mysqli_num_rows($res);
                if($count==1){
                    //get the details
                    //echo "Admin Available";
                    $row = mysqli_fetch_assoc($res);
                    $full_name = $row['fname'];
                    $username = $row['u_name'];
                    $email = $row['u_email'];
                    $contact = $row['u_contact'];
                    $address = $row['u_address'];


                }
                else{
                    //redirect
                    header("location:".SITEURL."admin/manage-user.php");
                }

            }
        ?>

        <form method="POST" action="">
            <table class="tbl-30">
                <tr>
                    <td>Fullname</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name ?>"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="user_name" value="<?php echo $username ?>"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="email" value="<?php echo $email ?>"></td>
                </tr>
                <tr>
                    <td>
                        Address:
                    </td>
                    <td><textarea type="text" cols="22" rows="5" name="address" placeholder="address" ><?php echo $address; ?></textarea></td>
                </tr>
                <tr>
                    <td>
                        Contact:
                    </td>
                    <td><input type="number" name="contact" placeholder="phone number" value="<?php echo $contact ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn btn-primary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>
<?php
//check button is clicket or not
if(isset($_POST['submit'])){
    //echo "clicked";
    //get values from from
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['user_name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    //create sql query
    $sql = "UPDATE tbl_user SET 
    fname = '$full_name',
    u_name = '$username',
    u_email = '$email',
    u_contact = '$contact',
    u_address = '$address'
    WHERE id=$id ";

    //execute the mysqli_query
    $res = mysqli_query($conn,$sql);

    //check query is selected or not
    if($res==TRUE)
    {
        $_SESSION['update']="<div class='success'>User updated</div>";
        //redirect
        header('location:'.SITEURL.'admin/manage-user.php');
    }
    else{
        $_SESSION['update']="<div class='error'>User update failed</div>";
        //redirect
        header('location:'.SITEURL.'admin/manage-user.php');
    }
}
?>

<?php
include 'partials/footer.php';
?>