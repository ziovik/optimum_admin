<?php

include("../inc/db.php");


  if (isset($_GET['delete_distributor'])) {
  	
  	$delete_id = $_GET['delete_distributor'];

    $sql_get_distributor_info = "select * from distributor where id = '$delete_id'";
    $result_distributor_info = mysqli_query($con, $sql_get_distributor_info);
    $row_distributor_info = mysqli_fetch_array($result_distributor_info);

    $distributor_id = $row_distributor_info['id'];
    $contact_id = $row_distributor_info['contact_id'];
    $region_id = $row_distributor_info['region_id'];
    $address_id = $row_distributor_info['address_id'];
    $credentials_id = $row_distributor_info['credentials_id'];
    $company_id = $row_distributor_info['company_id'];



    $sql_get_street_id = "select * from address where id ='$address_id' ";
    $result = mysqli_query($con, $sql_get_street_id);
    $row = mysqli_fetch_array($result);
    $street_id = $row['street_id'];

    $sql_delete_company_id = "delete from company where id = '$company_id'";
    mysqli_query($con, $sql_delete_company_id);

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



// distributor from table
  	$delete_distributor = "delete from distributor where id = '$delete_id'";

  	$run_delete_distributor = mysqli_query($con, $delete_distributor);

  	if ($run_delete_distributor) {
  		echo "<script>alert('A distributor  has been deleted')</script>";
  		echo "<script>window.open('index.php?view_distributor','_self')</script>";
  	}
  }

?>
