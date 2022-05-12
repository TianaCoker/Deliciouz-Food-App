<?php include 'partials/menu.php'; ?>

 <div class="main-content">
     <div class="wrapper">
         <h1>Update Category</h1>
         <br><br>
       <!--Php code to get all the values-->
       <?php 
         // check whether id is set,  if id is set
         // get the id 
         //create sql queries to get other details
         //execute the query
         //count the rows to check whether id is valid or not
         //else,  redirect to manage category

         if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_category WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            $count=mysqli_num_rows($res);
            if($count==1){
                //get all data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            }
            else{
                //redirect to manage category with msg
                $_SESSION['no-category-found'] = "<div class='error'>Category Not Found</div>";
                header('location:'.SITEURL.'admin/manage.category.php');
            }

         }
         else{
             header('location:'.SITEURL.'admin/manage.category.php');
         }
       
       
       ?>

      <!--Create Your Form-->
      <form action=""  method="POST" enctype="multipart/form-data">
         <table class="tbl-30">

             <tr>
                 <td>Title: </td>
                 <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
             </tr>

             <tr>
                 <td>Current Image: </td>
                 <td>
                     <?php
                     if($current_image != ""){
                         //display the image
                         ?>
                        <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image; ?>" width="150px" >
                         <?php
                     }
                     else{
                         //display message
                         echo"<div class='error'>Image Not Added.</div>";
                     }
                     
                     ?>
                 </td>
             </tr>

             <tr>
                 <td>New Image: </td>
                 <td><input type="file" name="image"></td>
             </tr>

             <tr>
                 <td>Featured: </td>
                 <td>
                     <input <?php if($featured=="Yes"){ echo "checked = 'checked'";} ?>type="radio" name="featured" value="Yes"> Yes

                     <input <?php if($featured=="No"){ echo "checked = 'checked'";} ?>type="radio" name="featured" value="No"> No
                </td>
             </tr>

             <tr>
                 <td>Active: </td>
                 <td><input  <?php if($active=="Yes"){ echo "checked = 'checked'";} ?> type="radio" name="active" value="Yes"> Yes
                     <input <?php if($active=="No"){ echo "checked = 'checked'";} ?> type="radio" name="active" value="No"> No
                </td>
             </tr>

             <tr>
                 <td>
                     <input type="hidden" name="current_image" value="<?php $current_image; ?>">
                     <input type="hidden" name="id" value="<?php echo $id; ?>">
                     <input type="submit" value="Upload Category" name="submit" class="btn-secondary">
                    </td>
             </tr>
         </table>
         </form>
         <?php 
         //Updating the category
         // if submit button is clicked
         // 1.get all the values from our form
         // 2. update the DB
         // 3. redirect with message to manage category
         if(isset($_POST['submit'])){
             $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // work on updating new image if selected
            if(isset($_FILES['image']['name'])){
                //get image details
                   $image_name = $_FILES['image']['name'];
                
                   //is image available?
                  if($image_name!=""){
                
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
                    header('location:'.SITEURL.'admin/manage.category.php');
                    //stop the process
                    die();
                }

                //Remove old image if its available
                if($current_image!=""){

                
                        $remove_path = " ../images/category/".$current_image;
                        $remove = unlink($remove_path);

                        //if image removed failed?
                        if($remove==false){

                            $_SESSION['failed-remove'] = "<div class='error'>Failed to Remove Current Image</div>";
                            header('location:'.SITEURL.'admin/manage.category.php');
                            die();
                        }
            }

                  }
                  else{
                    $image_name = $current_image;
                  }


            }
            else{
                $image_name = $current_image;
            }

            $sql2 = "UPDATE tbl_category SET
                      title='$title',
                      image_name='$image_name',
                      featured='$featured',
                      active='$active'
                      WHERE id=$id";
            
            $res2 = mysqli_query($conn, $sql2);

            if($res2==true){
                //category updated
                $_SESSION['update'] = "<div class='success'>Category Updated Successfully. </div>";
                header('location:'.SITEURL.'admin/manage.category.php');
            }
            else{
                //failed to update

                $_SESSION['update'] = "<div class='error'>Failed to Update Category. </div>";
                header('location:'.SITEURL.'admin/manage.category.php');
            }
            
         }
         
         ?>
     </div>
 </div>



<?php include 'partials/footer.php'; ?>

