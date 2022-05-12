<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <!--Displaying Session Message-->
        <?php  
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        
        ?>
        <br>

        <!--Category Form starts here-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <!--First Row-->
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Category Title"></td>
                </tr>
                <!--Second Row-->
                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                 <!--Third Row-->
                <tr>
                    <td>Featured: </td>
                    <td><input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
               <!--Fourth Row-->
                <tr>
                    <td> Active: </td>
                    <td><input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <!--Fifth Row with submit button-->
                <tr>
                    <td colspan="2"> <input type="submit" value="Add Category" name="submit"
                    class="btn-secondary"></td>
                </tr>

        </table>    
        </form>
        <!--Category Form ends here-->
        <?php 
        // Check whether the submit button is clicked or not.

        if(isset($_POST['submit'])){
              // 1.get the value from form

              $title = $_POST['title'];

              // for radio input type
              //we need to check whether
              //the button is selected or not

              if(isset($_POST['featured'])){
                  //get the featured value from form
                  
                  $featured = $_POST['featured'];

              }
              else{
                  //set a default value

                  $featured = "No";
              }


              if(isset($_POST['active'])){
                  //get the active value from form
                  $active = $_POST['active'];
              }
              else{
                  $active = "No";
              }

              //get the image value from form
              // check whether image is selected or not
              //print_r($_FILES['image']);

              if(isset($_FILES['image']['name'])){
                //upload the image
                // we need image name and
                // source path and destination path

                $image_name = $_FILES['image']['name'];
                //upload image only if it is not empty

                if($image_name !=""){

                
                //lets AutoRename the uploaded image name
                //get the extension of the image
                //use the explode function

                $ext = end(explode('.', $image_name));

                //then rename the image

                $image_name = "Food_Category_".rand(000,999).'.'.$ext;

        
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/category/".$image_name;

                //to upload the image

                $upload = move_uploaded_file($source_path, $destination_path);

                //check whether image is uploaded or not
                //if image is not uploaded,
                //stop the process and redirect with error msg

                if($upload==false){
                    //set msg

                    $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                    //redirect to add-category page
                    header('location:'.SITEURL.'admin/add-category.php');
                    //stop the process
                    die();
                }
            }
                

              }
              else{
                  //dont upload image
                  //set the image name value as blank

                  $image_name = "";
              }

              

              //2. create sql query to insert
              // the data into database

              $sql = "INSERT INTO tbl_category SET
                       title='$title',
                       image_name ='$image_name',
                       featured = '$featured',
                       active = '$active'";

            // 3. execute the query and
            // save in database

            $res = mysqli_query($conn, $sql);

            //4. check whether query is successful

            if($res==true){
                //query executed and category added
                $_SESSION['add'] = "<div class='success'> Category Added Successfully</div>";
                
                //redirect to manage category page
                 header('location:'.SITEURL.'admin/manage.category.php');

            }
            else{
                //failed to add category
                $_SESSION['add'] = "<div class='error'>Failed to Add Category</div>";

                //redirect to manage category page
                header('location:'.SITEURL.'admin/add-category.php');
            }

        }
        
        
        ?>

    </div>
</div>



<?php  include('partials/footer.php')?>