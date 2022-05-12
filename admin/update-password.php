<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
        <!--Get the id of the form-->
        <?php 
           if(isset($_GET['id'])){
               $id = $_GET['id'];
           }
        ?>
        <!--The form-->
        <form action="" method="POST">
                <table class="tbl-30">
                    <!--First Row-->
                    <tr>
                        <td>Current Password: </td>
                        <td><input type="password" name="current_password" placeholder="Current Password"></td>
                    </tr>
                <!--Second Row-->
                <tr>
                    <td>New Password: </td>
                    <td><input type="password" name="new_password" placeholder="New password"></td>
                </tr>
                <!--Third Row-->
                <tr>
                    <td >Confirm Password:</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm password"></td>
                </tr>
                <!--Fourth Row-->
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" value="Change Password" name="submit" class="btn-secondary">
                    </td>
                </tr>
                </table>

        </form>
    </div>
</div>

<!--We only change the password whenever the button is clicked-->
<?php 
//Check whether the submit button is clicked

if(isset($_POST['submit'])){
//echo 'clicked';-> for checking
//1. If button is clicked, get the data from the form
$id = $_POST['id'];
$current_password = md5($_POST['current_password']);
$new_password = md5($_POST['new_password']);
$confirm_password = md5($_POST['confirm_password']);

//2. Check whether the user with current id and password exist

     //first create an sql query
$sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
     
    // then execute the query
$res = mysqli_query($conn, $sql);

if($res==true){

    //check whether data is available
    $count = mysqli_num_rows($res);

    if($count ==1 ){
        //user exists and password can be changed
        //echo "User Found";
        //check whether the new password and confirm match or not
        if($new_password==$confirm_password){
            //update the password
            //to update the password, we create another sql query
            //execute the query,check for the successful execution of query

            $sql2 = "UPDATE tbl_admin SET password='$new_password'
                      WHERE id=$id";
            
            $res2 = mysqli_query($conn, $sql2);

            if($res2==true){
                //display success message

                $_SESSION['change-pwd'] = "<div class='success'> Password Changed Successfully</div>";
                header('location:'.SITEURL.'admin/manage.admin.php');
            }
            else{
                //display error message
                $_SESSION['change-pwd'] = "<div class='error'> Failed to Change Password </div>";
                header('location:'.SITEURL.'admin/manage.admin.php');

            }
           
        }
        else{
            //we redirect to manage admin page with error message
            $_SESSION['pwd-not-match'] = "<div class='error'> Password Do Not Match. </div>";
            header('location:'.SITEURL.'admin/manage.admin.php');
        }
    }
    else
    {
        //user does not exist, set a message and redirect
        $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";

        //redirect user
        header('location:'.SITEURL.'admin/manage.admin.php');


    }


}
     

//3. Check whether the current new passworrd and confirm password match


// 4. Change passwords if all above are met.



}



?>


<?php include('partials/footer.php'); ?>