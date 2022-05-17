<?php include('partials-front/menu.php'); ?>
     <?php 
     //check whether id is passed.
     if(isset($_GET['category_id'])){
        //category id is set so get the id
        $category_id = $_GET['category_id'];

        //GET THE CATEGORY Title based on the Category Id
        $sql = " SELECT title FROM tbl_category WHERE id=$category_id";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);

        $category_title = $row['title'];

     }
     else{
        //category id not set, so we redirect to homepage
       header('location:'.SITEURL);
       
     }
     
     
     ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on "<?php echo $category_title; ?>"</h2>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->



    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
    <h2 class="text-center">Food Menu</h2>
        <div class="flex-container-food">
            
            <?php 
            //create sql query to get food based on selected category
            $sql2 = " SELECT * FROM tbl_food WHERE category_id=$category_id";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);

            if($count2 > 0){
                while($row2=mysqli_fetch_assoc($res2)){
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
                    ?>
                    <div class="food-menu-box food-menu-box-color-secondary">
                        <div class="food-menu-img">
                            <?php   
                            if($image_name==''){
                                echo "<div class='error'> Image Not Available</div>";
                            }
                            else{
                                ?>
                                <img src="images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
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
                            <br>

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

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>