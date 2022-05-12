<?php include('partials/menu.php'); ?>
<?php 
//check whether id is set

if (isset($_GET['id'])){
    //get all details
    $id = $_GET['id'];
    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
    $res2 = mysqli_query($conn, $sql2);

    $row2 = mysqli_fetch_assoc($res2);

    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
}else{
    //redirect to manage food
    header('location:'.SITEURL.'admin/manage.food.php');
}

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <!--Creating Form-->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td><textarea name="description"  cols="22" rows="5" ><?php echo $description; ?></textarea></td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td> <?php 
                        if($current_image == ""){
                                echo "<div class='error'>Image Not Available</div>";
                        }else{
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                                <?php
                        }
                    
                      ?></td>
                </tr>

                <tr>
                    <td> Select New Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Category</td>
                    <td><select name="category" >
                        <?php 
                        //query to get active categories
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if($count > 0){
                                while($row = mysqli_fetch_assoc($res)){
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];
                                    //echo "<option value='$category_id'>$category_title</option>";
                                    ?>
                                    <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                    <?php
                                }

                            }
                            else{
                                echo "<option value='0'>Category Not Available</option>";
                            }
                        
                        
                        ?>

                    </select></td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td><input <?php if($featured=='Yes'){echo "checked='checked'"; }?>type="radio" name="featured" value="Yes">  Yes
                         <input <?php if($featured=='No'){echo "checked='checked'"; }?>type="radio" name="featured" value="No">  No
                    </td>
                </tr>
                
                <tr>
                    <td>Active: </td>
                    <td><input <?php if($active=='Yes'){echo "checked='checked'"; }?> type="radio" name="active" value="Yes">  Yes
                         <input <?php if($active=='No'){echo "checked='checked'"; }?>type="radio" name="active" value="No">  No
                    </td>
                </tr>

                <tr>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <td><input type="submit" name="submit" value="Update Food" class="btn-secondary"></td>
                </tr>

            </table>

        </form>
        <!--Updating-->
        <?php 
        // 1. check whether button is clicked

         if (isset($_POST['submit'])){

            // 2. get all details from form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];
            // 3. upload image, if need be
            // 4. and remove old image, and replace with new image.
            if(isset($_FILES['image']['name'])){
                $image_name = $_FILES['image']['name'];

                if($image_name!=""){
                    $ext = end(explode('.',$image_name));
                    $image_name = "Food-Name-".rand(0000, 9999).'.'.$ext;
                    $src_path = $_FILES['image']['tmp_name'];
                    $dest_path = "../images/food/".$image_name;
                    $upload = move_uploaded_file($src_path, $dest_path);
                    
                    if($upload == false){
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload New Image. </div>";
                        header('location:'.SITEURL.'admin/manage.food.php');
                        die();
                    }

                    if($current_image!=""){
                        $remove_path="../images/food/".$current_image;
                        $remove = unlink($remove_path);

                        if ($remove ==false){
                            $_SESSION['remove-failed'] = "<div class='error'>Failed to Remove Current Image. </div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                            die();
                        }
                    }

                }else{
                    $image_name = $current_image;
                }
            }
            else{
                $image_name = $current_image;
            }
            
            // 5. update the database and
            // redirect with session message

            $sql3 = "UPDATE tbl_food SET 
                     title= '$title',
                     description = '$description',
                     price = $price,
                     image_name = '$image_name',
                     category_id = '$category',
                     featured = '$featured',
                     active = '$active'
                     WHERE id=$id;
                     ";

            $res3 = mysqli_query($conn, $sql3);
            if($res3==true){
                $_SESSION['update'] = "<div class='success'>Food Updated Successfully. </div>";
                header('location:'.SITEURL.'admin/manage.food.php');
            }
            else{
                $_SESSION['update'] = "<div class='error'>Failed to Update Food. </div>";
                header('location:'.SITEURL.'admin/manage.food.php');
            }
            
         }
        
        
        ?>
    </div>
</div>




<?php include('partials/footer.php'); ?>