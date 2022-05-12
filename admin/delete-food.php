<?php 
include('../config/constants.php');

if (isset($_GET['id']) && isset($_GET['image_name'])){
    //process delete
    // 1.get id and image name
    // 2. remove image if available
    // 3. delete food from database
    // 4. redirect to manage food with session message

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if ($image_name !=""){
        $path = "../images/food/".$image_name;
        $remove = unlink($path);

        if ($remove == false){
            $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File</div>";
            header('location:'.SITEURL.'admin/manage.food.php');
            die();
        }
    }

    $sql = "DELETE FROM tbl_food WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if($res == true){
        $_SESSION['delete']="<div class='success'> Food Deleted Successfully</div>";
        header('location:'.SITEURL.'admin/manage.food.php');
    }
    else{
        $_SESSION['delete']="<div class='error'> Failed to Delete </div>";
        header('location:'.SITEURL.'admin/manage.food.php');
    }
    
}

else{
    //redirect to manage food page

    $_SESSION['unauthorized'] = "<div class='error'> Unauthorised Access </div>";
    header('location:'.SITEURL.'admin/manage.food.php');
}


?>