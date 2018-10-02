<table width="700px" align="center" >
	<tr align="center">
		<h2 style="color: #800080; text-align: center;">Клиенты</h2>

		<th style="width: 100px;">S/N</th>
		<th style="text-align: center;">Имя клиента</th>
		<th style="width: 100px; text-align: center;">Смотреть</th>
	</tr>

	<?php
	include("../inc/db.php");

	if (isset($_SESSION['distributor_id'])) {
		if (isset($_GET['customers_list'])) {
			$dist_id = $_SESSION['distributor_id'];

			$customers_list = $_GET['customers_list'];

			$i = 0;

			$sql = "select 
                       distinct c.name as customer_name,
                       c.id as customer_id
    	           from distributor d
	    	           join product p on p.distributor_id = d.id
	    	           join product_item pt on pt.product_id = p.id

	    	           join cart crt on crt.id = pt.cart_id
	    	           join simple_order so on so.cart_id = crt.id
	    	           join customer c on c.id = crt.customer_id
	    	           join store_item st on st.product_id = p.id
                    where d.id = '$dist_id' 
    	            ";

			$run = mysqli_query($con, $sql);

			while ($rows = mysqli_fetch_array($run)) {

				$customer_name = $rows['customer_name'];
				$customer_id = $rows['customer_id'];

				$i++;



				?>

				<tr style="text-align: center">
					<td><?php echo $i; ?></td>
					<td style="text-align: center"><?php echo $customer_name; ?></td>
					<td style="text-align: center">
						<!-- Cart -->
						<li style="text-align: center" class="header-cart dropdown default-dropdown">

							<div class="header-btns-icon">
                                <input id="customer_id" type="hidden" value="<?php echo $customer_id; ?>">
								<a  href="index1.php?customer_id=<?php echo $customer_id; ?>
								&customer_name=<?php echo $customer_name; ?>">
									<i class='fa fa-envelope faa-shake animated fa-4x' style="font-size:50px;
									color:red; float: right;  "></i>
								</a>
<!--								<span class="qty" style="width: 20px; height: 20px;">1</span>-->
							</div>



						</li>
					</td>
				</tr>

				<?php

			}

		}
	}

	?>

</table>




