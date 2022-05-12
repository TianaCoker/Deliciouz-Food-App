<?php

//include the constants.php file

include('../config/constants.php');


//We are deleting Admin
// 1. First step, get the ID of the Admin to be deleted

$id = $_GET['id'];


// 2.create sql query to delete Admin

$sql = "DELETE FROM tbl_admin WHERE id=$id";


// 3. execute the sql query 

$res = mysqli_query($conn, $sql);

// 4. check whether the query is successfully executed or not

 if (res==true){
  // query successfully executed and admin deleted
  // 4. echo "Admin Deleted";
  //create a session variable to display message

  $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div";

  // 5.Redirect to Manage Admin Page with message (success/error msg)
 
  header('location:'.SITEURL.'admin/manage.admin.php');
 }
else{
  // failed to delete admin
 //echo "Failed to Delete Admin";

 $_SESSION['delete'] = "<div class='error'>Failed to delete Admin. Try Again Later!</div>";

 header('location:'.SITEURL.'admin/manage.admin.php');
}







?>