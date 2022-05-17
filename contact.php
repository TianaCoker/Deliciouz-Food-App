<?php include('partials-front/menu.php'); ?>

<section class="food-search">
<div class="container">
<h2 class="text-center text-navy">Always happy to serve you.<br> Send us a message.</h2>
<form action="" class="order" method="POST">
<fieldset class="field-display">
                    <legend>Contact Us</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="your name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="your mobile number" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="your email" class="input-responsive" required>

                    <div class="order-label">Message</div>
                    <textarea name="address" rows="10" placeholder="type message..." class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Send Message" class="btn btn-primary btn-align btn-order">
                </fieldset>


</form>
</div>
</section>




<?php include('partials-front/footer.php'); ?>