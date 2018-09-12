<?php
include("../inc/db.php");

if (isset($_SESSION['distributor_id'])) {
	$dist_id = $_SESSION['distributor_id'];

	if(isset($_GET['accept_all'])){
		$accept_all = $_GET['accept_all'];

		$sql = "select
                    pt.onscreen_status,
                    pt.id
		         from simple_order so
			         join product_item pt on pt.cart_id = so.cart_id
			         join cart crt on crt.id = so.cart_id
			         join product p on p.id = pt.product_id
			         join distributor d on d.id = p.distributor_id
               join store_item st on st.product_id = p.id
		         where d.id = '$dist_id' AND so.id = '$accept_all'";
        
        $run = mysqli_query($con, $sql);

        while ( $rows = mysqli_fetch_array($run)) {
        	$product_item_id = $rows['id'];


        	$status = 'Принял';
       

        	
        	
        	if ($run) {
        		$update_onscreen_status = "update product_item set onscreen_status = '$status' where id = '$product_item_id'";

        		$run_change = mysqli_query($con, $update_onscreen_status);
               
        	
           }
            
        }
        echo "<script>alert('Все товары в этом заказы приняли')</script>";
        echo "<script>windows.open('accept_all_success.php','_self')</script>";
        
	}
}
?>


  <?php
      if (isset($_GET['accept_all_success'])) {
		include("accept_all_success.php");
	}
  ?>  
