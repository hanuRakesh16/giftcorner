<?php
include 'partials/menu.php';
?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Add User</h1>

            <form action="" method="POST">

                <table class=tbl-30>
                    <tr>
                        <td>
                            Full Name:
                        </td>
                        <td><input type="text" name="fname" placeholder="Full Name"></td>
                    </tr>
                    <tr>
                        <td>
                            Username:
                        </td>
                        <td><input type="text" name="u_name" placeholder="Username"></td>
                    </tr>
                    <tr>
                        <td>
                           Email:
                        </td>
                        <td><input type="email" name="u_email" placeholder="mail"></td>
                    </tr>
                    <tr>
                        <td>
                            Password :
                        </td>
                        <td><input type="password" name="password" placeholder="Password"></td></td>
                    </tr>
                    <tr>
                        <td>
                            Address:
                        </td>
                        <td><textarea type="text" cols="22" rows="5" name="address" placeholder="address"></textarea></td>
                    </tr>
                    <tr>
                        <td>
                            Contact:
                        </td>
                        <td><input type="number" name="contact" placeholder="phone number"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add User" class="btn-primary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>





<?php
include 'partials/footer.php';
?>

<?php
        //process the value from form
        if(isset($_POST['submit']))
        {
        $full_name=$_POST['fname'];
        $username=$_POST['u_name'];
        $email=$_POST['u_email'];
        $password=md5($_POST['password']);
        $address=$_POST['address'];
        $contact=$_POST['contact'];

        //query to save in db
        $sql = "INSERT INTO tbl_user SET 
        fname='$full_name',
        u_name = '$username',
        u_email = '$email',
        u_password = '$password',
        u_address = '$address',
        u_contact = '$contact'

        
        ";

        //execut eand save in db
        $res = mysqli_query($conn, $sql) or die(mysqli_error());
        

        //check data is inserted
        if( $res == TRUE)
        {
            //echo "inserted";
            //create session variable
            $_SESSION['add']="<div class='success'>User Added Successfully</div>";
            //redirect
            header("location:".SITEURL.'admin/manage-user.php');
        }
    }
        // else{
        //      //echo "failed";
        //     //create session variable
        //     $_SESSION['add']="Failed to add admin";
        //     //redirect
        //     header("location:".SITEURL.'admin/manage-admin.php');

        // }

?>

