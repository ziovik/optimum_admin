<?php
include("../inc/db.php");
   

  if (isset($_GET['delete_region'])) {
  	
  	$delete_id = $_GET['delete_region'];

  	$delete_region = "delete from region where id = '$delete_id'";

  	$run_delete_region = mysqli_query($con, $delete_region);

  	if ($run_delete_region) {
  		echo "<script>alert('A Region has been deleted')</script>";
  		echo "<script>window.open('index.php?view_region','_self')</script>";
  	}
  }

?>
