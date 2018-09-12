<form action="" method="post" style="padding-top: 50px; ">
  <h2 style="text-align: center;">Insert New Region</h2>
  <table align="center" width="50%" border="2" bgcolor="#F6F7F8">
    <tr>
      <td>Region Name</td>
      <td>Code</td>
      <td>Country</td>
    </tr>
    <tr>
      <td>  <input type="text" name="new_region" style="width: 300px;" required></td>
      <td>  <input type="text" name="new_code" style="width: 100px;" required></td>
      <td>  <input type="text" name="new_country" style="width: 150px;" required></td>
    </tr>
  
  </table>
  <br>
  <div style="padding-left: 450px;">
    <button class="primary-btn" type="submit" name="add_region" value="Add Region" style="border-radius: 5px;">Add Region</button> 
  </div>
  
</form>
<?php
  
  include("../inc/db.php");

   //for not acceessing this page by another person who is not in admin

   if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}

else{

   //


  if (isset($_POST['add_region'])) {
  	

  $new_region = $_POST['new_region'];
  $new_code = $_POST['new_code'];
  $new_country = $_POST['new_country'];


  $insert_region ="insert into region (name,code,country_id) values ('$new_region','$new_code', '$new_country')";

  $run_region = mysqli_query($con, $insert_region);

  if ($run_region) {
  	echo "<script>alert('New region Has been Inserted')</script>";
  	echo "<script>window.open('index.php?view_region','_self');</script>";

  }
  }
 
?>

<!--close the not accessing -->
<?php  } ?>