<?php


include("../inc/db.php");
 //for not acceessing this page by another person who is not in admin

   if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}

else{

   //


if (isset($_GET['edit_region'])) {
  $region_id = $_GET['edit_region'];

  $get_region = "select * from region where id='$region_id'";

  $run_region = mysqli_query($con, $get_region);

  $row_region = mysqli_fetch_array($run_region);

  $region_id= $row_region['id'];
  $region_name = $row_region['name'];
  $region_code= $row_region['code'];
  $region_country = $row_region['country_id'];


}

?>


<form action="" method="post" style="padding-top: 50px; ">
  <h2 style="text-align: center;">Edit and Update Region</h2>
  <table align="center" width="50%" border="2" bgcolor="#F6F7F8">
    <tr>
      <td>Region Name</td>
      <td>Code</td>
      <td>Country</td>
    </tr>
    <tr>
     
        <td><input type="text" name="new_region" style="width: 300px;" value="<?php echo $region_name; ?>" required></td>
        <td><input type="text" name="new_code" style="width: 100px;" value="<?php echo $region_code; ?>" required></td>
        <td><input type="text" name="new_country" style="width: 150px;" value="<?php echo $region_country; ?>" required></td>
    </tr>
  
  </table>
  <br>
  <div style="padding-left: 450px;">
    <button class="primary-btn" type="submit" name="update_region" value="Update Region" style="border-radius: 5px;">Update Region</button> 
  </div>
  
</form>

<?php
  
  

  if (isset($_POST['update_region'])) {
  	
  $update_id = $region_id;// region-id from up php
  $new_region = $_POST['new_region'];
  $new_code = $_POST['new_code'];
  $new_country = $_POST['new_country'];
  $update_region ="update region set name = '$new_region' , code = '$new_code', country_id = '$new_country' where id='$update_id'";

  $run_edit_region = mysqli_query($con, $update_region);

  if ($run_edit_region) {
  	echo "<script>alert('Region Has been Updated')</script>";
  	echo "<script>window.open('index.php?view_region','_self');</script>";

  }
  }
 
?>

<!--close the not accessing -->
<?php  } ?>