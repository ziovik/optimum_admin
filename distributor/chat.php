<?php

include("../inc/db.php");

$dist_id = $_SESSION['distributor_id'];

$sql = "select 
c.name as company_name
from distributor d
join company c on c.id = d.company_id
where d.id = '$dist_id'";
$run = mysqli_query($con, $sql);

$row = mysqli_fetch_array($run);

$distributor_name = $row['company_name'];

?>
<div style="padding-left: 200px;">
	<div class="panel panel-info pb-chat-panel" style="width: 500px;">
		<div class="panel panel-heading pb-chat-panel-heading">
			<div class="row">
				<div class="col-xs-12">
					<a href="#">
						<h2 style="text-align: center;"><?php echo $distributor_name; ?></h2>
					</a>
					<a href="#"><span class="fa fa-cog pull-right pb-chat-top-icons"></span></a>
					<a href="#"><span class="fa fa-share pull-right pb-chat-top-icons"></span></a>
				</div>
			</div>
		</div>
		<div class="scroll-container" id="chatRoom">
			<form action="" method="post">
				<hr>
				<div class="clearfix"></div>
			</form>
		</div>
		<div class="panel-footer">
			<div class="row">
				<div class="col-xs-10">
					<input id="customer_id" type="hidden" value="<?php echo $_GET['customer_id']; ?>">
					<input id="customer_name" type="hidden" value="<?php echo $_GET['customer_name']; ?>">
					<textarea class="form-control pb-chat-textarea" placeholder="чат...И нажмите Кнопку Enter"
							  id="message" style="width: 300px;">
</textarea>
				</div>
				<!--<div class="col-xs-2 pb-btn-circle-div">
				<button type="submit" class="btn btn-primary btn-circle pb-chat-btn-circle" style="width: 50px;"><span class="fa fa-chevron-right"></span></button>
				</div>-->
			</div>
		</div>
	</div>
</div>


<!--chat end-->


<script>

	// calling the loadChat here

	$(document).ready(function () {
		loadChat();

		$('#message').on('keyup', function (event) {
			event.preventDefault();

			var message = $(this).val();
			var customerId = $('#customer_id').val();

			if (event.which == 13) {
				var message = {
					'customer_id': customerId,
					'message': message
				};
				var data = JSON.stringify(message);

				$.ajax({
					method: 'POST',
					url: 'handlers/ajax.php',
					data: data,
					success: function (data) {
						console.log(data)
						loadChat();
					},
					error: function (error) {
						console.log(error);
					}
				});

				$('#message').val('');
			}
		});
	});

	function loadChat() {
		let customerId = $('#customer_id').val();
		let customerName = $('#customer_name').val();

		$.ajax({
			method: 'GET',
			url: 'handlers/ajax.php?action=get_chat&customer_id=' + customerId + '&customer_name=' + customerName,
			success: function (data) {
				$('#chatRoom').html(data);
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

