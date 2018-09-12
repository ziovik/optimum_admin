<?php
include("../inc/db.php");
   

  if (isset($_GET['delete_cat'])) {
  	
  	$delete_id = $_GET['delete_cat'];

  	$delete_cat = "delete from category where id = '$delete_id'";

  	$run_delete_cat = mysqli_query($con, $delete_cat);

  	if ($run_delete_cat) {
  		echo "<script>alert('A category has been deleted')</script>";
  		echo "<script>window.open('index.php?view_cats','_self')</script>";
  	}
  }

?>
