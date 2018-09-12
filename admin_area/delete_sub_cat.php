<?php
 include("../inc/db.php");
  
 

  if (isset($_GET['delete_sub_cat'])) {
  	
  	$delete_id = $_GET['delete_sub_cat'];

  	$delete_sub_cat = "delete from sub_category where id = '$delete_id'";

  	$run_delete_sub_cat = mysqli_query($con, $delete_sub_cat);

  	if ($run_delete_sub_cat) {
  		echo "<script>alert('A Sub category has been deleted')</script>";
  		echo "<script>window.open('index.php?view_sub_cat','_self')</script>";
  	}
  }

?>

