<form action="" method="post" style="padding-top: 50px; padding-left: 400px;">
	<h2>Insert New Category</h2>
	<input type="text" name="new_cat" style="width: 300px;" required>
	<button class="primary-btn" type="submit" name="add_cat" value="Add Category" >Add Category</button>
</form>

<?php
  
  include("../inc/db.php");

   //for not acceessing this page by another person who is not in admin

   if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}

else{

   //


  if (isset($_POST['add_cat'])) {
  	

  $new_cat = $_POST['new_cat'];

  $insert_cat ="insert into category (name) values ('$new_cat')";

  $run_cat = mysqli_query($con, $insert_cat);

  if ($run_cat) {
  	echo "<script>alert('New Category Has been Inserted')</script>";
  	echo "<script>window.open('index.php?view_cats','_self');</script>";

  }
  }
 
?>

<!--close the not accessing -->
<?php  } ?>