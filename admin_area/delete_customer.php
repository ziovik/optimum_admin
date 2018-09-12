<?php

include("../inc/db.php");


  if (isset($_GET['delete_customer'])) {
  	
  	$delete_id = $_GET['delete_customer'];

    $sql_get_customer_info = "select * from customer where id = '$delete_id'";
    $result_customer_info = mysqli_query($con, $sql_get_customer_info);
    $row_customer_info = mysqli_fetch_array($result_customer_info);

    $customer_id = $row_customer_info['id'];
    $customer_name = $row_customer_info['name'];
    $contact_id = $row_customer_info['contact_id'];
    $region_id = $row_customer_info['region_id'];
    $address_id = $row_customer_info['address_id'];
    $credentials_id = $row_customer_info['credentials_id'];

    $sql_get_street_id = "select * from address where id ='$address_id' ";
    $result = mysqli_query($con, $sql_get_street_id);
    $row = mysqli_fetch_array($result);
    $street_id = $row['street_id'];

// delete from address table
  
  $sql_delete_address_id = "delete from address where id = '$address_id'";
  mysqli_query($con, $sql_delete_address_id);

    //delete from credentials table
  $sql_delete_credentials_id = "delete from credentials where id = '$credentials_id'";
  mysqli_query($con, $sql_delete_credentials_id);

    //delete from contact table
$sql_delete_contact_id = "delete from contact where id = '$contact_id'";
  mysqli_query($con, $sql_delete_contact_id);

    // delete from street table
  $sql_delete_street_id = "delete from street where id = '$street_id'";
  mysqli_query($con, $sql_delete_street_id);



// customer from table
  	$delete_customer = "delete from customer where id = '$delete_id'";

  	$run_delete_customer = mysqli_query($con, $delete_customer);

  	if ($run_delete_customer) {
  		echo "<script>alert('A Customer  has been deleted')</script>";
  		echo "<script>window.open('index.php?view_customers','_self')</script>";
  	}
  }

?>
