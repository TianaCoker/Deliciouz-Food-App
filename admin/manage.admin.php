<?php include 'partials/menu.php';?>

<!--Menu Content Section Starts-->
<div class="main-content">
  <div class="wrapper">
    <h1>Manage Admin</h1>
    <br/>

   <!-To Display message for successfully adding and deleting  admin->
   <?php
if (isset($_SESSION['add'])) {
    echo $_SESSION['add']; // to display session message
    unset($_SESSION['add']); //to remove session message
}

if (isset($_SESSION['delete'])) {

    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}

if (isset($_SESSION['update'])) {

    echo $_SESSION['update'];
    unset($_SESSION['update']);

}

if (isset($_SESSION['user-not-found'])) {

    echo $_SESSION['user-not-found'];
    unset($_SESSION['user-not-found']);
}

if (isset($_SESSION['pwd-not-match'])) {

    echo $_SESSION['pwd-not-match'];
    unset($_SESSION['pwd-not-match']);
}

if (isset($_SESSION['change-pwd'])) {

    echo $_SESSION['change-pwd'];
    unset($_SESSION['change-pwd']);
}

if (isset ($_SESSION['user-not-found'])){

    echo $_SESSION['user-not-found'];
    unset($_SESSION['user-not-found']);

}

if(isset($_SESSION['pwd-not-match'])){
  echo $_SESSION['pwd-not-match'];
  unset($_SESSION['pwd-not-match']);
}

if(isset($_SESSION['change-pwd'])){
  echo $_SESSION['change-pwd'];
  unset($_SESSION['change-pwd']);
}
?>

 <br/><br/><br/>
    <!- Add Admin Button->
      <a href="add-admin.php" class="btn-primary"> Add Admin</a>
      <br/><br/><br/>

    <table class="tbl-full">
      <!- First Row with headings->
      <tr>
        <th>S.N.</th>
        <th>Full Name</th>
        <th>Username</th>
        <th>Actions</th>
      </tr>

      <!-Displaying the added Admin->
      <?php
$sql = "SELECT * FROM tbl_admin"; //Query to get all admin

$res = mysqli_query($conn, $sql); //Execute the query

// Check query execution

if ($res == true) {
    // Count rows to check the no of data in database

    $count = mysqli_num_rows($res); //function to get all rows in database
    $sn = 1; // a variable to assign a value

    //code below is Checking the no of rows
    if ($count > 0) {

        //below -> if we have data in database,use while loop to get all the data
        while ($rows = mysqli_fetch_assoc($res)) {

            //code below is to get individual data
            $id = $rows['id'];
            $full_name = $rows['full_name'];
            $username = $rows['username'];

            //below-> to display the values in our table
            //break the php and start a new one.
            //write the html code between.
            ?>
            <!- Row->
              <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $full_name; ?></td>
                <td><?php echo $username; ?></td>
                <td>
                  <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                  <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                  <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>

                </td>
              </tr>
            <?php
}
    } else {

    }

}
?>

    </table>
  </div>
</div>
<!--Menu Content Section Ends-->

<?php include 'partials/footer.php';?>