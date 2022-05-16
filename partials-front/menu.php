<?Php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32">
    <title>Deliciouz-Healthy African Meals</title>
  </head>
  <body>
    <!--Navbar Starts Here-->
    <section class="navbar">
      <div class="container">
        <div class="logo">
          <a href="<?php echo SITEURL;?>">
          <img
            src="images/deliciouz logo.png"
            alt="Deliciouz logo"
            class="img-responsive"
          />
          </a>
        </div>

        <div class="menu text-right">
          <ul>
            <li><a href="<?php echo SITEURL; ?>">Home</a></li>
            <li><a href="<?php echo SITEURL; ?>categories.php">Categories</a></li>
            <li><a href="<?php echo SITEURL?>foods.php">Foods</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>
        <div class="clearfix"></div>
      </div>
    </section>
    <!--Navbar Ends Here-->