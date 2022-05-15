<?php include('partials-front/menu.php'); ?>

    <!-- Categories Section Starts Here -->
    <section class="categories">
     <h1 class="text-center explore-food">Explore Foods</h1>
        <div class="flex-container ">
    <?php 
    // Display Food Categories from Database
    //create sql query
    //execute the query
    //count the rows
    //check whether categories are available
    // if available display categories from database

    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if($count>0){
         while($row = mysqli_fetch_assoc($res)){
              $id = $row['id'];
              $title = $row['title'];
              $image_name = $row['image_name'];
              ?>
               <a href="category-foods.php" class="flex-box float-container">
                 <div >
                      <?php
                      if($image_name==""){
                         echo "<div class='error'> Image Not Found.</div>";
                      }
                      else{
                         ?>
                         <img src="images/category/<?php echo $image_name;  ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve image">
                         <?php

                      }
                      
                      ?>
                   

                     <h3 class="text-white float-text text-hover text-visible"><?php echo $title; ?></h3>
                 </div>
               </a>


              <?php

         }

    }
    else{
         echo "<div class='error'>Category Not Found. </div>";
    }

    
    ?>
    </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php');  ?>