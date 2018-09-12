<?php


    //for not acceessing this page by another person who is not in admin

   if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}

else{

   //


  if (isset($_GET['delete_c'])) {
  	
  	$delete_id = $_GET['delete_c'];

  	$delete_c = "delete from customers where customer_id = '$delete_id'";

  	$run_delete_c = mysqli_query($con, $delete_c);

  	if ($run_delete_c) {
  		echo "<script>alert('A Customer  has been deleted')</script>";
  		echo "<script>window.open('index.php?view_customers','_self')</script>";
  	}
  }

?>

<!--close the not accessing -->
<?php  } ?>