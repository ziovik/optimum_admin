<script>
	let currDistId = null, currDistName = null;
</script>

<table width="800" align="center">
	<h2 style="text-align: center;">Подробность заказа</h2>
	</td>
	<tr style="text-align: center;">
		<th>S/N</th>
		<th>Наимнование</th>
		<th>количество</th>
		<th>Дистрибьютор</th>
		<th>Цена</th>
		<th>Положение</th>
	</tr>
	<?php
	include("../inc/db.php");

	if (isset($_GET['my_orders'])) {

		if (isset($_SESSION['customer_id'])) {

			$my_orders = $_GET['my_orders'];

			// this is for customer details
			$customer_id = $_SESSION['customer_id'];

			$onscreen_status = 'Отправил';

			$i = 0;


			$get = "select 
      					pt.onscreen_status as status,                          
      					pt.product_id as product_id,
      					c.id as cart_id,
      					com.name as company_name,
      					pt.quantity as qty,
      					st.price as price,
      					so.id as order_id,
      					p.name as product_name,
      					cc.name as customer_name,
      					d.id as distributor_id
      
      					from 
      					cart c
      					join product_item pt on pt.cart_id = c.id
      					join simple_order so on so.cart_id = pt.cart_id
      					join product p on p.id = pt.product_id
      					join distributor d on d.id = p.distributor_id
      					join company com on com.id = d.company_id
      					join customer cc on cc.id = c.customer_id
                     join store_item st on st.product_id = p.id
      
      					where c.customer_id = '$customer_id' AND  so.id = '$my_orders'  AND pt.onscreen_status = '$onscreen_status' ";

			$run = mysqli_query($con, $get);
			$current_distributor_id = null;
			$current_company_name = null;
			if (!$run) {
				printf("Error: %s\n", mysqli_error($con));
				exit();
			}/// helps to check error

			while ($rows = mysqli_fetch_array($run)) {

				$product_name = $rows['product_name'];
				$qty = $rows['qty'];
				$company_name = $rows['company_name'];
				$product_price = $rows['price'];
				$onscreen_status = $rows['status'];
				$customer_name = $rows['customer_name'];
				$order_id = $rows['order_id'];
				$distributor_id = $rows['distributor_id'];

				$i++;

				?>
				<tr align="center">
					<td><?php echo $i; ?></td>
					<td><?php echo $product_name; ?></td>
					<td><?php echo $qty; ?></td>
					<td>
						<?php echo $company_name; ?>
						<!--chat -->
						<div class="btn-group">
							<button class="btn btn-primary dropdown-toggle btn-lg" data-toggle="dropdown"
									aria-haspopup="true" aria-expanded="false" style="width: 100px;"
									onclick="setCurrentValues('<?php echo $distributor_id; ?>', '<?php echo
									$company_name; ?>')">
								<span class="fa fa-comments pull-left">Chat</span>
							</button>
							<ul class="dropdown-menu pb-chat-dropdown">
								<li>
									<div class="panel panel-info pb-chat-panel">
										<div class="panel panel-heading pb-chat-panel-heading">
											<div class="row">
												<div class="col-xs-12">
													<a href="#">
														<label id="support_label"><?php echo $customer_name; ?></label>
													</a>
													<a href="#"><span
																class="fa fa-cog pull-right pb-chat-top-icons"></span></a>
													<a href="#"><span
																class="fa fa-share pull-right pb-chat-top-icons"></span></a>
												</div>
											</div>
										</div>
										<div class="scroll-container" id="chatRoom_<?php echo $distributor_id; ?>">
											<form action="" method="post">
												<hr>
												<div class="clearfix"></div>
											</form>
										</div>
										<div class="panel-footer">
											<div class="row">
												<div class="col-xs-10">
                              <textarea id="message_<?php echo $distributor_id; ?>"
										class="form-control pb-chat-textarea"
										onkeyup="textAreaOnEnterClick(event, <?php echo
										$distributor_id; ?>, '<?php echo $company_name; ?>')"
										placeholder="чат...И нажмите Кнопку Enter"
										style="width: 200px;"></textarea>
												</div>
											</div>
										</div>
									</div>
								</li>
							</ul>
						</div>
						<!--chat end-->
					</td>
					<td><?php echo $product_price; ?></td>
					<td><?php echo $onscreen_status; ?></td>
				</tr>
			<?php }
		}
	} ?>
</table>

<div style="float: right;">
	<form method="post" action="excel.php?action=<?php echo $order_id; ?>">
		<input type="submit" name="export_excel" class="btn btn-success" value="Печать Заказы">
	</form>
</div>
<div>
	<input class="btn next-btn" type="submit" value="Назад" onClick="back()">
	<script type="text/javascript">
		function back() {
			window.location = "index.php?view_orders";
		}
	</script>
	<br>
	<br>
</div>
<script>
	function setCurrentValues(distributorId, distributorName) {
		currDistId = distributorId;
		currDistName = distributorName;
		loadChat();
	}

	function textAreaOnEnterClick(event) {
		if (event.which === 13) {
			let textArea = document.getElementById('message_' + currDistId);

			if (textArea == null) {
				console.log('TextArea is not found');
				return;
			}

			let message = {
				'distributor_id': currDistId,
				'message': textArea.value,
				'customer_id': <?php echo $_SESSION["customer_id"]; ?>
			};

			let data = JSON.stringify(message);

			$.ajax({
				method: 'POST',
				url: 'handlers/requests_handler.php?action=send_message_to_distributor',
				data: data,
				success: function () {
					loadChat();
				},
				error: function (error) {
					console.log(error);
				}
			});

			textArea.value = '';
		}
	}

	$(document).ready(function () {
		loadChat();
	});

	//showing all chat in box

	function loadChat() {
		if (currDistId == null) return;
		let customerId = '<?php echo $_SESSION["customer_id"]; ?>';
		let customerName = '<?php echo $_SESSION["customer_name"]; ?>';

		if (customerId == undefined && customerName == undefined) return;

		$.ajax({
			method: 'GET',
			url: 'handlers/requests_handler.php?action=get_chat&customer_id=' + customerId
			+ '&customer_name=' + customerName
			+ '&distributor_id=' + currDistId
			+ '&distributor_name=' + currDistName,
			success: function (data) {
				let chatRoom = document.getElementById('chatRoom_' + currDistId);
				if (chatRoom != null) chatRoom.innerHTML = data;
			},
			error: function () {
				console.log('error');
			}
		});
	}

	setInterval(function () {
		loadChat();
	}, 2000);
</script>