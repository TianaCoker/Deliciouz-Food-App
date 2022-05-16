<?php include('../config/constants.php');



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login- Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br>

        <!--Display error message from failed login-->
        <?php 
          if (isset($_SESSION['login'])){
              echo $_SESSION['login'];
              unset($_SESSION['login']);
          }

          if (isset($_SESSION['no-login-message'])){
              echo $_SESSION['no-login-message'];
              unset($_SESSION['no-login-message']);
          }
        
        
        ?>


        <!--Login Form-->
        <form action="" method="POST" class="text-center">
            <br>
            Username:
            <input type="text" name="username" placeholder="Enter your Username">
            <br><br>
            Password:
            <input type="password" name="password" placeholder="Enter Your Password">
            <br><br>
            <input type="submit" value="Login" name="submit" class="btn-primary btn-center">
            <br><br>
        </form>
        <!--Login Form Ended-->

        <p class="text-center">Created By - <a href="www.tianacoker.com">Tiana Coker</a></p>
    </div>
</body>
</html>

<?php
//Adding the functionality

    if(isset($_POST['submit'])){

        // 1.get data from the from

        $username =mysqli_real_escape_string($conn, $_POST['username']);
        $password = md5($_POST['password']);

        // 2.SQL Query to check whether the username
        // and password match and exist or not

        $sql = "SELECT * FROM tbl_admin WHERE username='$username'
                 AND password='$password'";

        // 3.Execute the query

        $res = mysqli_query($conn, $sql);

        // 4. Count the rows to check whether the user
        // exist or not

        $count = mysqli_num_rows($res);

        if ($count==1){
    
        //user available so set session message for successful login

        $_SESSION['login'] = "<div class='success text-center'>Login Successful</div>";
        $_SESSION['user'] = $username;

        // redirect user to homepage/dashboard

        header('location:'.SITEURL.'admin/');

        }
        else{
        //user not available so set session message for failed login

        $_SESSION['login'] = "<div class='error text-center'>Username and Password does not match</div>";

        // redirect user to login page 

        header('location:'.SITEURL.'admin/login.php');

        }




    }


?>