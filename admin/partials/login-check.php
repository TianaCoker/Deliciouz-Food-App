<?php
// Authorization - Access Control

if(!isset($_SESSION['user'])){ //if user session is not set

     //it means user is not logged in, so
     // redirect to login page with message

     $_SESSION['no-login-message'] = "<div class='error text-center'>Please Login to Access Admin</div>";

     header('location:'.SITEURL.'admin/login.php');




}



?>