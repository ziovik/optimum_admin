<form action="" method="post" style="padding-top: 50px; padding-left: 400px;">
	<h2>Insert New Brand</h2>
	<input type="text" name="new_brand" style="width: 300px;" required>
	<button class="primary-btn" type="submit" name="add_brand" value="Add Brand" >Add Category</button>
</form>

<?php
  
  

  //for not acceessing this page by another person who is not in admin

   if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}

else{

   //

  if (isset($_POST['add_brand'])) {
  	

  $new_brand = $_POST['new_brand'];

  $insert_brand ="insert into categories (brand_name) values ('$new_brand')";

  $run_brand = mysqli_query($con, $brand_cat);

  if ($run_brand) {
  	echo "<script>alert('New Brand Has been Inserted')</script>";
  	echo "<script>window.open('index.php?view_brands','_self');</script>";

  }
  }
 
?>

<!--close the not accessing -->
<?php  } ?>