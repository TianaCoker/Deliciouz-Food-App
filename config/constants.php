<?php 
//Start session

session_start();
//create constants to store non repeating values

define('SITEURL', 'http://localhost:8080/food-ordering-website/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food-order');


//4. Creating a database connection

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));   //i. create a database connection
$db_select = mysqli_select_db($conn, DB_NAME)   or die(mysqli_error($conn));               //select the database



?>