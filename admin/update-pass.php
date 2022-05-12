<?php include 'partials/menu.php';?>

<div class = "main-content">

   <div class="wrapper">
            <h1>Change Password</h1>
            <br><br>

            <?php
//Get ID
if (isset($_GET['id'])) {

    $id = $_GET['id'];
}

?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <!--1st Row-->
                    <tr>
                        <td>Current Password:</td>
                        <td><input type="password" name="current_password" placeholder="Current Password"></td>
                    </tr>

                    <!--2nd Row-->

                    <tr>
                        <td>New Password:</td>
                        <td><input type="password" name="new_password" placeholder="New Password"></td>
                    </tr>

                    <!--3rd Row-->

                    <tr>
                    <td>Confirm  Password: </td>
                        <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                    </tr>

                    <!--4th Row-->

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                        </td>
                    </tr>
                </table>


            </form>
   </div>

</div>

<?php
//check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    //echo 'clicked';

    //1. Get the data from form

    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //2. Check whether the user with current ID and current
    // password exists or not

    $sql = "SELECT * FROM tbl_admin WHERE id = $id AND PASSWORD = '$current_password'";

    //2b. execute the query

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        //check whether data is available
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            //user exist,password can be changed
            //echo "User Found";

            //check whether the new password and confirm match or not
            if ($new_password == $confirm_password) {
                //update the password. we do the ffw:
                //create a query
                $sql2 = "UPDATE tbl_admin SET password=$new_password WHERE id=$id";

                //execute the query
                $res2 = mysqli_query($conn, $sql2);

                //check whether the query is executed or not
                //update password

                if ($res2 == true) {
                    //display success message
                    $_SESSION['change-pwd'] = "<div class='success'> Password Changed Successfully. </div>";
                    // redirect user
                    header('location:' . SITEURL . 'admin/manage.admin.php');
                } else {
                    //display error message
                    $_SESSION['change-pwd'] = "<div class='error'> Failed to change password. </div>";
                    // redirect user
                    header('location:' . SITEURL . 'admin/manage.admin.php');
                }
            } else {
                //redirect to manage admin page with error message
                $_SESSION['pwd-not-match'] = "<div class='error'> Password Do Not Match. </div>";
                // redirect user
                header('location:' . SITEURL . 'admin/manage.admin.php');
            }
        } else {
            //user does not exist, set mesg and redirect
            $_SESSION['user-not-found'] = "<div class='error'> User Not Found. </div>";
            // redirect user
            header('location:' . SITEURL . 'admin/manage.admin.php');

        }
    }

    //3. Check whether the new password and confirm password
    // matches or not

    //4. Change password if all above is true
}

?>



<?php include 'partials/footer.php';?>