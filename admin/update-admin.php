
<?php include('partials/menu.php');?>

<div class="main-content">
  <div class="wrapper">
  <h1>Update Admin</h1>
  <br/><br/>

  <!--get details of the current admin and display it-->
  <?php
  // 1. get id of selected Admin
  $id= $_GET['id'];

  // 2. create sql query to get the details
  $sql="SELECT * FROM tbl_admin WHERE id=$id";

  // 3. execute the query

  $res = mysqli_query($conn, $sql);

  // 4. check whether query is executed or not

  if($res==true){
      // check whether the data is available or not
      $count = mysqli_num_rows($res); 
      //check whether we have admin data or not
      if($count===1){
              // get the details;
           
           $row = mysqli_fetch_assoc($res);

           $full_name = $row['full_name'];
           $username = $row['username'];
      }
      else{

          header('location:'.SITEURL.'admin/manage.admin.php');              //redirect to manage admin page
      }
  }
  
  ?>

  <form action=""  method="POST">
    <table class="tbl-30">
         <tr>
              <td>Full Name:</td>
              <td><input type="text" name="full_name" value="<?php echo $full_name;?>"></td>
         </tr>

         <tr>
              <td>Username:</td>
              <td><input type="text" name="username" value="<?php echo $username;?>"></td>
         </tr>

         <tr>
            <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id ;?>">
            <input type="submit" name="submit" value="Update Admin" class="btn-secondary"></td>
         </tr>
    </table>


  </form>

  </div>

</div>

<?php 
// To update Admin when submit button is clicked
//1. Check whether the submit button is clicked or not, which is 
// the if statement
//2. create an sql query to update the details in admin
//3. execute the query
//4. check whether the query executed successfully or not.

if (isset($_POST['submit'])){
       //echo "button clicked";->to check if logic works
       // 1. get all the values from the form to update
    
       $id = $_POST['id'];
       $full_name = $_POST['full_name'];
       $username = $_POST['username'];

       //2. 

       $sql = "UPDATE tbl_admin SET 
       full_name = '$full_name',
       username = '$username' 
       WHERE id = '$id'
       ";

       //3.

       $res = mysqli_query($conn, $sql);

       //4.

       if($res==true){
                 
        //If Query executed successfully and admin updated
        //drop a message and redirect

        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully. </div>";
        
        // redirect to Manage Admin Page after dropping a message
        header('location:'.SITEURL.'admin/manage.admin.php');
       }

       else{
          
           //if Failed to update  Admin
           //drop a message and redirect

           $_SESSION['update'] = "<div class='error'>Failed to delete Admin. </div>";
        
           // redirect to Manage Admin Page after dropping a message
           header('location:'.SITEURL.'admin/manage-admin.php');

       }

    }

?>


<?php include('partials/footer.php');?>