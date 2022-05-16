<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php 
            //get the search keyword and display.
            $search = mysqli_real_escape_string($conn, $_POST['search']);
            ?>
            
            <h2 class="text-danger">Foods on Your Search "<?php echo $search; ?>"</h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php 
                //Getting food based on search keyword
                //create sql query to get food based on title and description

                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description  
                        LIKE '%$search%' ";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row ['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                        <div class="food-menu-box food-menu-box-color-secondary">
                            <div class="food-menu-img">
                                <?php 
                                if($image_name ==""){
                                    echo "<div class='error'>Image Not Available. </div>";
                                }
                                else{
                                    ?>
                                    <img src="images/food/<?php echo $image_name;  ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
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

                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php

                    }
                }
                else{

                    echo "<div class='error'>Food Not Found. </div>";
                }
            
                       
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>