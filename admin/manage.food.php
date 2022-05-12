<?php include('partials/menu.php') ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br/><br/>

        
    <!-- Add Food Button-->
      <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary"> Add Food</a>
      <br/><br/>
      <!--Displaying Session Message-->
      <?php
        if (isset($_SESSION['add'])){
          echo $_SESSION['add'];
          unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])){
          echo $_SESSION['delete'];
          unset($_SESSION['delete']);
        }

        if (isset($_SESSION['upload'] )){
          echo $_SESSION['upload'];
          unset($_SESSION['upload'] ); 
        }

        if (isset($_SESSION['authorized'] )){
          echo $_SESSION['authorized'];
          unset($_SESSION['authorized'] ); 
        }

        if(isset($_SESSION['update'] )){
          echo $_SESSION['update'];
          unset($_SESSION['update'] ); 
        }

        
        ?>

        <br/><br/>

    <table class="tbl-full">
      <!- First Row with headings->
      <tr>
        <th>S.N.</th>
        <th>Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
      </tr>
        <?php
          //create sql query to get all food from DB
          $sql = "SELECT * FROM tbl_food";
          $res = mysqli_query($conn, $sql);
          $count = mysqli_num_rows($res);
          $sn = 0;
          
          
          if($count > 0){
              while($row = mysqli_fetch_assoc($res)){
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
                $sn++;

                echo "<tr>
                    <td> $sn </td>
                    <td>$title</td>
                    <td>$$price</td>";
                    ?>
                    
                    <td><?php 
                    if ($image_name==""){
                      echo "<div class='error'>Image Not Added</div>";
                    }
                    else{
                      ?>
                      <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" width="100px" >
                      <?php
                    }
                    
                    ?>

                    </td>
                    <td><?php echo $featured ?></td>
                    <td><?php echo $active ?></td>
                    <td>
                      <a href='<?php echo SITEURL?>admin/update-food.php?id=<?php echo $id; ?>' class='btn-secondary'>Update Food</a>
                      <a href='<?php echo SITEURL?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>' class='btn-danger'>Delete Food</a>
                    
                    </td>
                  </tr>
                  <?php
              }
          }
          else{
            echo "<tr> <td colspan='7' class='error'> Food Not Added Yet </td> </tr>";
          }



        ?>
      <!- Second Row->
      

    </table>
    </div>
</div>


<?php include('partials/footer.php') ?>