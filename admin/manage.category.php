<?php include('partials/menu.php') ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br/><br/>

        <!--Displaying Session Message-->
        <?php  
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['remove'])){
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if(isset($_SESSION['delete'])){
          echo $_SESSION['delete'];
          unset($_SESSION['delete']);
        }

        if(isset($_SESSION['no-category-found'])){
          echo $_SESSION['no-category-found'];
          unset($_SESSION['no-category-found']);
        }

        if(isset($_SESSION['update'])){
          echo $_SESSION['update'];
          unset($_SESSION['update']);
        }

        if(isset( $_SESSION['upload'])){
          echo  $_SESSION['upload'];
          unset( $_SESSION['upload']);
        }

        if(isset($_SESSION['failed-remove'])){
          echo $_SESSION['failed-remove'];
          unset($_SESSION['failed-remove']);
        }
    
        ?>
        <br>

    <!-- Add Category Button-->
      <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary"> Add Category</a>
      <br/><br/><br/>

    <table class="tbl-full">
      <!-- First Row with headings-->
      <tr>
        <th>S.N.</th>
        <th>Title</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
      </tr>

      <?php 
      //create sql query to get all categories 
      //from database

      $sql = "SELECT * FROM tbl_category";

      //Execute the query

      $res = mysqli_query($conn, $sql);

      // count the rows

      $count = mysqli_num_rows($res);
      //create serial no

      $sn = 1;

      //check whether we have data in database

      if($count > 0){
        //we have data in database
        //get the data and display in your tr tags

        while($row=mysqli_fetch_assoc($res)){
          $id = $row['id'];
          $title = $row['title'];
          $image_name = $row['image_name'];
          $featured = $row['featured'];
          $active = $row['active'];
          //break the php to add the html tags
          ?>
        <tr>
        <td><?php echo $sn++;?></td>
        <td><?php echo $title; ?></td>

        <td><?php 
        // check whether image name is available or not
        //if image name is not empty
        if($image_name!=""){
            //display the image
            ?>
            <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" width="100px">
            <?php
        }
        else{
          //display a message

        echo "<div class='error'>Image Not Added</div>";
        }
        
        ?>
        </td>

        <td><?php echo $featured; ?></td>
        <td><?php echo $active; ?></td>
        <td>
          <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
          <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
         
        </td>
      </tr>
          <?php
        }
      }
      else{
        //we do not have data
        //display the msg in a table
        ?>
        <tr>
          <td colspan="6"><div class="error">No Category Added</div></td>
        </tr>
        <?php
      }
      
      
      ?>

      <!-- Second Row-->
      

    </table>
    </div>
</div>


<?php include('partials/footer.php') ?>