<form action="" method="post">
	<tr>
		<td><input type="text" name="dist"></td>
	</tr>
</form>

<?php


if (isset($_POST['dist'])) {


	// this for product details
	$total = 0;

	global $con;

	$ip = getIP();

	$sel_price = "select * from cart where ip_add = '$ip'";

	$run_price = mysqli_query($con, $sel_price);

	while ($p_price = mysqli_fetch_array($run_price)) {
		$pro_id = $p_price['p_id'];

		$pro_price = "select * from products where product_id ='$pro_id'";

		$run_pro_price = mysqli_query($con, $pro_price);

		while ($pp_price = mysqli_fetch_array($run_pro_price)) {
			$product_price = array($pp_price['product_price']); // getting all price
			$product_id = $pp_price['product_id'];
			$product_name = $pp_price['product_title'];
			$values = array_sum($product_price);  // sum the price

			$total += $values;

		}
	}

	// getting quantity of product

	$get_qty = "select * from  cart where p_id = '$pro_id'";
	$run_qty = mysqli_query($con, $get_qty);

	$row_qty = mysqli_fetch_array($run_qty);

	$qty = $row_qty['qty'];

	if ($qty == 0) {
		$qty = 1;

	} else {
		$qty = $qty;
		$total = $total * $qty;
	}

	// this is for customer details
	$user = $_SESSION['customer_email'];

	$get_c = "select *from customers where customer_email = '$user' ";

	$run_c = mysqli_query($con, $get_c);

	$row_c = mysqli_fetch_array($run_c);

	$c_id = $row_c['customer_id'];
	$c_email = $row_c['customer_email'];
	$c_name = $row_c['customer_name'];


	//inserting the payment to table

	$insert_orders = "insert into orders (p_id,c_id,customer_email,qty,amount,order_date,status) values ('$pro_id','$c_id','$user','$qty','$total',NOW(),'in Progress')";

	$run_orders = mysqli_query($con, $insert_orders);


	//removing cart to empty


	$empty_cart = "delete from cart";
	$run_cart = mysqli_query($con, $empty_cart);


	if (mysqli_num_rows($run_cart) == 0) {
		echo "<h2>Welcome :" . $_SESSION['customer_email'] . "<br>" . "Your Order was successfull. Please wait for confirmation from the Distributor.</h2>";
		echo "<script>window.open('customer/my_account.php','_self')</script> ";
	} else {
		echo "<h2>Payment Failed</h2><br>";
		echo "<a href='index.php'>Go To Back To Optimum Beauty</a>";
	}


	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers = 'From: <veloxkursk@yandex.ru>' . "\r\n";

	$subject = "Order Details";

	$message = "<html>
    <p>
      hello <b>$c_name</b> you product was confirmed 

    </p>

    <table  width='600px' align='center' border='2'>
          <tr>
             <td><h2>your order details from optimum beauty</h2></td>
          </tr>
          <tr>
            <th><b>S.N</b></th>
            <th><b>Product Name</b></th>
            <th><b>Quantity</b></th>
            <th><b>Order Date</b></th>

          </tr>

          <tr>
            <td>1</td>
            <td>$product_name</td>
            <td>$qty</td>
            <td>$order_date</td>

          </tr>
    </table>
    <h2><a href='customer/my_account.php'>Click Here</a> to log in to your account</h2>
   <h3>Thank you </h3>

  </html>

   ";

	mail($c_email, $subject, $message, $headers);
}

