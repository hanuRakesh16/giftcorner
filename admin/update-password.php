<?php
include 'partials/menu.php';
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1><br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
        ?>

        <form method="post" action="">
            <table class="tbl-30"></table>
            <tr>
                <td>Old Password:</td>
                <td><input type="password" name="current_password" placeholder="Current Password"></td>

            </tr>
            <tr>
                <td>New Password:</td>
                <td><input type="password" name="new_password" placeholder="New Password"></td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name = "id" value="<?php echo $id ?>">
                    <input type="submit" name="submit" class="btn-primary" value="change password">
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
    $current_password = md5($_POST['current_password']);
    $new_password =  md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

  //check whether data is existed
  $sql = "SELECT * FROM tbl_user WHERE id=$id AND password='$current_password'";

    //execute the mysqli_query
    $res = mysqli_query($conn,$sql);

    //check query is selected or not
    if($res==TRUE)
    {
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //user exists and password can change
            //check password are same
            if($new_password==$confirm_password){
                //change password
                $sql2 = "UPDATE tbl_user SET password='$new_password' WHERE id=$id";

                //execute the mysql
                $res2 = mysqli_query($conn,$sql2);
                //check executed
                if($res2==TRUE){
                    $_SESSION['change-pwd']="<div class='success'>Password Changed.</div>";
                    header("location:".SITEURL."admin/manage-user.php");
                }
                else{
                    $_SESSION['change-pwd']="<div class='error'>Failed to Change Password.</div>";
                    header("location:".SITEURL."admin/manage-user.php");
                }
            }
            else{
                //redirect
                $_SESSION['pwd-not-match']="<div class='error'>Password not Match.</div>";
                header("location:".SITEURL."admin/manage-user.php");
            }
        }
    }
    else{
      //user doesnot exists redirect
      $_SESSION['user-not-found']="<div class='error'>User not Found</div>";
      header("location:".SITEURL."admin/manage-user.php");
    }
}

?>




<?php include 'partials/footer.php'?>