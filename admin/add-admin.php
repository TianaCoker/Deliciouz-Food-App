<?php include('partials/menu.php');?>

<div class="main-content"> 
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/> <br/>
 
        <!-Displaying error message for admin failure->
        <?php 
   if(isset($_SESSION['add'])){
     echo $_SESSION['add'];    // to display session message
     unset($_SESSION['add']);  //to remove session message
   }
   ?>

        <!-Create a Form to Add Admin->

        <form action=""  method="POST">

        <table class="tbl-30">
            <!-First Row->
            <tr>
                <td>Full Name: </td>
                <td> <input type="text" name="full_name" placeholder="Enter your name"></td>

            </tr>

            <!-Second Row->
            <tr>
                <td>Username: </td>
                <td> <input type="text" name="username" placeholder="Enter your username"></td>

            </tr>
            <!-Third Row->
            <tr>
                <td>Password: </td>
                <td> <input type="password" name="password" placeholder="Enter your password"></td>

            </tr>
            <!-Fourth Row(Button)->
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>


    </div>

</div>

<?php include('partials/footer.php');?>

<!-Form to Database->
<?php 
//1. First step is to check whether the form is submitted
//2.Get the data from the form 
//How?
//create a variable and assign the post value to it.
//3. create SQL Queries to save data into database

if (isset($_POST['submit'])){

//2.Getting Data

  $full_name = $_POST['full_name'];
  $username = $_POST['username'];
  $password = md5($_POST['password']); //password encrypted with md5

  //3.Create SQL Queries to save the above data into the database

   $sql = " INSERT INTO tbl_admin SET
         full_name = '$full_name',
         username = '$username',
         password = '$password'
   ";
//4.Create a database connection.This is done in constants.php file


//5. Execute the SQL Query and save the Data in Database.
    
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

//6. Check whether the (query is executed)data is inserted into the db

if($res==TRUE){
//create a session variable to display message
$_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";

//redirect page to Manage Admin
header("location:".SITEURL.'admin/manage.admin.php');


    
}
else {
    //create a session variable to display message
$_SESSION['add'] = "<div class='error'>Failed to Add Admin </div>";

//redirect page to Add Admin
header("location:".SITEURL.'admin/add-admin.php');
}


}



?>