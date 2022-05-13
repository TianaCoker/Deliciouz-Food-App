<?php include('partials-front/menu.php'); ?>

    <!--Food Search Section Starts Here-->
    <section class="food-search text-center">
      <div class="container">
        <form action="food-search.html" method="POST">
          <input type="search" name="search" placeholder="search for food" />
          <input
            type="submit"
            value="search"
            name="submit"
            class="btn btn-primary"
          />
        </form>
      </div>
    </section>
    <!--Food Search Section Ends Here-->

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
              <a href="category-foods.php" class="flex-box float-container" >
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
                        
                      <h3 class="float-text text-white text-hover"><?php echo $title; ?></h3>
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
      <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <div class="food-menu-box food-menu-box-color-primary">
          <div class="food-menu-img">
            <img
              src="images/menu-pizza.jpg"
              alt="chicken pizza"
              class="img-responsive img-curve"
            />
          </div>
          <div class="food-menu-desc">
            <h4>Food Title</h4>
            <p class="food-price">$12.3</p>
            <p class="food-detail">
              Made with Italian Sauce,Chicken and organic vegetable
            </p>
            <br />
            <a href="order.html" class="btn btn-primary">Order Now</a>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="food-menu-box food-menu-box-color-primary">
          <div class="food-menu-img">
            <img
              src="images/menu-burger.jpg"
              alt="chicken burger"
              class="img-responsive img-curve"
            />
          </div>
          <div class="food-menu-desc">
            <h4>Chicken Burger</h4>
            <p class="food-price">$12.3</p>
            <p class="food-detail">
              Made with Italian Sauce,Chicken and organic vegetable
            </p>
            <br />
            <a href="#" class="btn btn-primary">Order Now</a>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="food-menu-box food-menu-box-color-primary">
          <div class="food-menu-img">
            <img
              src="images/menu-burger.jpg"
              alt="chicken burger"
              class="img-responsive img-curve"
            />
          </div>
          <div class="food-menu-desc">
            <h4>Nice Burger</h4>
            <p class="food-price">$12.3</p>
            <p class="food-detail">
              Made with Italian Sauce,Chicken and organic vegetable
            </p>
            <br />
            <a href="#" class="btn btn-primary">Order Now</a>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="food-menu-box food-menu-box-color-primary">
          <div class="food-menu-img">
            <img
              src="images/menu-momo.jpg"
              alt="chicken momo"
              class="img-responsive img-curve"
            />
          </div>
          <div class="food-menu-desc">
            <h4>Chicken Steam Momo</h4>
            <p class="food-price">$12.3</p>
            <p class="food-detail">
              Made with Italian Sauce,Chicken and organic vegetable
            </p>
            <br />
            <a href="#" class="btn btn-primary">Order Now</a>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="food-menu-box food-menu-box-color-primary">
          <div class="food-menu-img">
            <img
              src="images/menu-pizza.jpg"
              alt="chicken pizza"
              class="img-responsive img-curve"
            />
          </div>
          <div class="food-menu-desc">
            <h4>Food Title</h4>
            <p class="food-price">$12.3</p>
            <p class="food-detail">
              Made with Italian Sauce,Chicken and organic vegetable
            </p>
            <br />
            <a href="#" class="btn btn-primary">Order Now</a>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="food-menu-box food-menu-box-color-primary">
          <div class="food-menu-img">
            <img
              src="images/menu-burger.jpg"
              alt="chicken burger"
              class="img-responsive img-curve"
            />
          </div>
          <div class="food-menu-desc">
            <h4>Chicken Burger</h4>
            <p class="food-price">$12.3</p>
            <p class="food-detail">
              Made with Italian Sauce,Chicken and organic vegetable
            </p>
            <br />
            <a href="#" class="btn btn-primary">Order Now</a>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
      </div>
    </section>
    <!--Food Menu Ends Here-->

   <?php include('partials-front/footer.php');  ?>