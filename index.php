<?php include('partials-front/menu.php'); ?>

    <!--Food Search Section Starts Here-->
    <section class="food-search text-center">
      <div class="container">
        <form action="food-search.php" method="POST">
          <input type="search" name="search" placeholder="search for food" />
          <input
            type="submit"
            value="search"
            name="submit"
            class="btn-search btn-primary"
          />
        </form>
      </div>
    </section>
    <!--Food Search Section Ends Here-->
    <!--Displaying Session Message-->
    <?php 
      if(isset( $_SESSION['order'])){
        echo  $_SESSION['order'];
        unset( $_SESSION['order']);
      }
    
    
    ?>

    <!--Category Section Starts Here-->
    <section class="categories">
    <h2 class="text-center">Explore Foods</h2>
      <div class="flex-container">
      

        <!--Getting the Categories from the Database-->
        <?php 
          //Create sql query to display 
          //Execute the query
          //count the no of rows in the category table
          $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
          $res = mysqli_query($conn, $sql);
          $count = mysqli_num_rows($res);
          if($count>0){
            while($row=mysqli_fetch_assoc($res))
            {
              $id = $row['id'];
              $title = $row['title'];
              $image_name = $row['image_name'];
              ?>
              <a href="category-foods.php?category_id=<?php echo $id; ?>" class="flex-box float-container" >
                  <div >
                        <?php
                            if ($image_name=="") 
                            {
                              echo "<div class='error'>Image Not Available</div>";
                            }
                            else
                            {
                              ?>
                              <img
                              src="images/category/<?php echo $image_name; ?>"
                              alt="deli-food category-images"
                              class="img-responsive img-curve image"
                            />
                             
                              <?php
                            }
                        ?>
                        
                      <h3 class="float-text text-white text-hover text-visible"><?php echo $title; ?></h3>
                  </div>
              </a>
              <?php
            }
          }
          else{
            echo "<div class='error'>Category Not Added</div>";
          }
        
        
        ?>

        <div class="clearfix"></div>
      </div>
    </section>
    <!--Category section Ends Here-->

    <!--Food Menu Section Starts Here-->
    <section class="food-menu food-menu-color-primary">
    <h2 class="text-center">Food Menu</h2>
      <div class="flex-container">
        
        <?php 
        //get Food from database
        //create sql query
        //execute the query
        //count the rows
        //check whether food is aavailable
        $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 4";
        $res2 = mysqli_query($conn, $sql2);
        $count2 =mysqli_num_rows($res2);
        if($count2 > 0){
          while($row = mysqli_fetch_assoc($res2)){
            $id = $row['id'];
            $title = $row['title'];
            $price = $row['price'];
            $description = $row['description'];
            $image_name = $row['image_name'];
            ?>
              <div class="food-menu-box food-menu-box-color-primary">
                  <div class="food-menu-img">
                    <?php 
                    if($image_name==""){
                      echo "<div class='error'>Image Not Available. </div>";
                    }
                    else{
                      ?>
                      <img src="images/food/<?php echo $image_name; ?>" alt="<?php echo $image_name; ?>"
                        class="img-responsive img-curve"
                      />
                      <?php

                    }
                    
                    ?>
                      
                  </div>
                  <div class="food-menu-desc">
                     <h4><?php echo $title; ?></h4>
                      <p class="food-price">$<?php echo $price; ?></p>
                      <p class="food-detail">
                        <?php echo $description; ?>
                      </p>
                      <br />
                      <a href="order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                  </div>
                 </div>
            <?php

          }

        }
        else{
          echo "<div class='error'>Food Not Available. </div>";
        }

        
        
        ?>

        
          <div class="clearfix"></div>
        </div>
        
        
        
        
        <p class="text-center">
          <a href="foods.php" class="link-color food-border">See All Foods</a>
        </p>
    </section>
    <!--Food Menu Ends Here-->

   <?php include('partials-front/footer.php');  ?>