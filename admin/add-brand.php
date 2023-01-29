<?php
include 'partials/menu.php';
?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Type</h1>

            <form action="" method="POST">

                <table class=tbl-30>
                    <tr>
                        <td>
                             Name:
                        </td>
                        <td><input type="text" name="bname" placeholder="Full Name"></td>
                    </tr>
                   
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Brand" class="btn-primary">
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
        $bname=$_POST['bname'];
       

        //query to save in db
        $sql = "INSERT INTO brands SET 
      
        brand_title = '$bname'

        
        ";

        //execut eand save in db
        $res = mysqli_query($conn, $sql) or die(mysqli_error());
        

        //check data is inserted
        if( $res == TRUE)
        {
            //echo "inserted";
            //create session variable
            $_SESSION['add']="<div class='success'> Added Successfully</div>";
            //redirect
            header("location:".SITEURL.'admin/manage-brand.php');
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

