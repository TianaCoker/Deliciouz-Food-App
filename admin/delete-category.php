<?php 
   include('../config/constants.php');
 
 // check whether the id and image name is set

 if (isset($_GET['id']) AND isset($_GET['image_name'])){
     // 1.get the value and delete it

     $id = $_GET['id'];
     $image_name = $_GET['image_name'];

     // 2. remove the image file
     if($image_name !=''){
         //image is not empty so remove it
         // to remove the image,we need the path

         $path = "../images/category/".$image_name;

         $remove = unlink($path);

         // if failed to remove image, send an error msg
         //redirect to manage category page
         // stop the process

         if($remove ==false){

            $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image</div>";
            header('location:'.SITEURL.'admin/manage.category.php');
            die();
         }
  
     }

     // 3. delete data from database
           // a. create sql query to delete data from DB
           // b. execute the query
           // c. check whether query was successful
           // i. if successful set a success
           //message and redirect 
           // ii. else set a failed msg and redirect
            
     $sql = "DELETE FROM tbl_category WHERE id=$id";
     $res = mysqli_query($conn, $sql);
     if($res==true){

        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
        header('location:'.SITEURL.'admin/manage.category.php');
     }
     else{
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Category</div>";
        header('location:'.SITEURL.'admin/manage.category.php');
     }

     // 4. redirect to manage category with success msg

 }
 else{

    //redirect to manage category page
    header('location:'.SITEURL.'admin/manage.category.php');
 }





?>