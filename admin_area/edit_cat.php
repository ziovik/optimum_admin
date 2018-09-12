<?php


include("../inc/db.php");
 //for not acceessing this page by another person who is not in admin

   if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}

else{

   //


if (isset($_GET['edit_cat'])) {
  $cat_id = $_GET['edit_cat'];

  $get_cat = "select * from category where id='$cat_id'";

  $run_cat = mysqli_query($con, $get_cat);

  $row_cat = mysqli_fetch_array($run_cat);

  $cat_id= $row_cat['id'];
  $cat_name = $row_cat['name'];


}

?>


<form action="" method="post" style="padding-top: 50px; padding-left: 400px;">
	<h2>Update Category</h2>
	<input type="text" name="new_cat" style="width: 300px;" value="<?php echo $cat_name ?>">
	<button class="primary-btn" type="submit" name="update_cat" value="Update Category" >Update Category</button>
</form>

<?php
  
  

  if (isset($_POST['update_cat'])) {
  	
  $update_id = $cat_id;// cat-id from up php
  $new_cat = $_POST['new_cat'];

  $update_cat ="update category set name = '$new_cat' where id='$update_id'";

  $run_edit_cat = mysqli_query($con, $update_cat);

  if ($run_edit_cat) {
  	echo "<script>alert('Category Has been Updated')</script>";
  	echo "<script>window.open('index.php?view_cats','_self');</script>";

  }
  }
 
?>

<!--close the not accessing -->
<?php  } ?>