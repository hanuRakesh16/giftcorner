<?php
include '../dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<br><br><br><br><br><br>
<div class="adminadd">
    <?php
        if (isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset ($_SESSION['login']);
        }
        if(isset($_SESSION['no-login-msg']))
        {
            echo $_SESSION['no-login-msg'];
            unset ($_SESSION['no-login-msg']);
        }
    ?>


    <form action = "" method = "POST" class="text-center">

        <tr>
            <td>Username</td>
            <td>
                <input type="text" name = "username" placeholder="username"><br>
            </td>
        </tr>
        <br>
        <tr>
            <td>password</td>
            <td>
                <input type="password" name = "password" placeholder="Password"><br>
            </td>
        </tr>

        <tr>
            <td colspan="2">
               <br> <input type="submit" name = "submit" value="Login" class="btn-secondary"><br>
            </td>
        </tr>


    </form>
</div>
</body>
</html>
<?php


//process the value ans save
if (isset($_POST['submit'])) {
    //echo "Button clicked";
  //getting login info
  $username = $_POST['username'];
  $password = $_POST['password'];

  //sql query
  $sql = "SELECT * FROM tbl_admin where username ='$username' AND password='$password'";

  $res= mysqli_query($conn, $sql);

  $count = mysqli_num_rows($res);
  if($count == 1)
  {
      //not avail user
      $_SESSION['login'] = "<div class='success text-center'>Login succesfull</div>";
      $_SESSION['user'] =$username; //checking whether the user is logged in or not
      header("location:".SITEURL.'admin/index.php');
  }
  else{
      $_SESSION['login'] = "<div class='password text-center error'>Username or Password did not match</div>";
      header("location:".SITEURL.'admin/login.php');
  }


}

?>