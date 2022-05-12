<?php
//include constant.php for url

include('../config/constants.php');

// 1.Destroy all sessions 

session_destroy();


// 2. and redirect to login page.

header('location:'.SITEURL.'admin/login.php');



?>