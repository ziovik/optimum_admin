<?php
include("../inc/db.php");
  

  if (isset($_GET['delete_product'])) {
  	
  	$delete_id = $_GET['delete_product'];

    $sql_delete_storr_item = "delete from store_item where product_id = '$delete_id'";
    $result = mysqli_query($con, $sql_delete_storr_item);

  	$sql_delete_product = "delete from product where id = '$delete_id'";

  	$run_delete = mysqli_query($con, $delete_product);

  	if ($run_delete) {
  		echo "<script>alert('Product has been deleted')</script>";
  		echo "<script>window.open('index.php?view_products','_self')</script>";
  	}
  }

?>
