<?php include('partials-front/menu.php'); ?>

    <?php
    //check whether food id is set
    if(isset($_GET['food_id'])){
        //get the details and id of selected food
        $food_id = $_GET['food_id'];

        //get details of selected food
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if($count==1){
            //data is available, get data from database
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];

        }
        else{

            header('location:'.SITEURL);
        }

    }
    else{
        header('location:'.SITEURL);
    }
    
    
    ?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-navy">Fill this form to confirm your order.</h2>

            <form action="" class="order" method="POST">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 
                        if($image_name==""){
                            echo "<div class='error'></div>";
                        }
                        else{

                            ?>
                            <img src="images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            <?php
                        }
                        
                        ?>
                        
                    </div>
    
                    <div class="order-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset class="field-display">
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Tiana Coker" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 080xxxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. tianacoker.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary btn-align btn-order">
                </fieldset>

            </form>

            <?php 
            //check whether order submit button is clicked
            //if clicked, get all the details from the form

            if(isset($_POST['submit'])){
                //get all the details from the form

                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;
                $order_date = date("y-m-d h:i:sa");
                $status = "ordered";
                $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
                $customer_contact = mysqli_real_escape_string($conn, $_POST['contact']);
                $customer_email = $_POST['email'];
                $customer_address =mysqli_real_escape_string($conn, $_POST['address']);

                //save the order in database

                $sql2 = "INSERT INTO tbl_order SET 
                         food='$food',
                         price=$price,
                         qty=$qty,
                         total=$total,
                         order_date ='$order_date',
                         status='$status',
                         customer_name='$customer_name',
                         customer_contact='$customer_contact',
                         customer_email='$customer_email',
                         customer_address='$customer_address' ";

                $res2 = mysqli_query($conn, $sql2);
                if($res2==true){
                    $_SESSION['order']="<div class='success text-center'>Food Ordered Successfully. </div>";
                    header('location:'.SITEURL);

                }
                else{
                    $_SESSION['order']="<div class='error text-center'> Food Order Failed. </div>";
                    header('location:'.SITEURL);

                }


            }
            
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>