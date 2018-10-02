<?php
session_start();

include("inc/db.php");
include("inc/functions.php");
include("inc/db_functions.php");
include_once "db_objects/ProductItem.php";


if (!isset($_SESSION['customer_id'])) {
	echo "<script>window.open('customer/customer_login.php?not_admin=You are not signed in!','_self')</script>";
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>OPTIMUM BEAUTY | PRODUCT</title>
	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">
	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="css/slick.css"/>
	<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>
	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>
	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css"/>
	<link type="text/css" rel="stylesheet" href="css/table.css"/>
	<link type="text/css" rel="stylesheet" href="css/checkout_style.css"/>
	<!--table resp-->
	<link rel="stylesheet" href="css/rwd-table.min.css">

	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-19870163-1']);
		_gaq.push(['_trackPageview']);

		(function () {
			var ga = document.createElement('script');
			ga.type = 'text/javascript';
			ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(ga, s);
		})();
	</script>
</head>
<body>
<?php include("inc/headers.php"); ?>
<!-- NAVIGATION -->
<?php include("inc/navigation_dropdown.php"); ?>
<!-- /NAVIGATION -->
<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="optimum_beauty.php">Главная</a></li>
			<li class="active">Корзина</li>
		</ul>
	</div>
</div>
<!-- /BREADCRUMB -->
<!-- section -->
<div id="home">
	<!-- container -->
	<div class="container">
		<!-- home wrap -->
		<div class="home-wrap">
			<!-- home slick -->
			<div>
				<div style="clear:both"></div>
				<br/>
				<h3>Детали заказа</h3>
				<div class="table-responsive">
					<table class="table table-bordered">
						<tr>
							<th width="40%" style="text-align: center;">Наименование продукта</th>
							<th width="10%" style="text-align: center;">Количество</th>
							<th width="20%" style="text-align: center;">Цена (руб.)</th>
							<th width="15%" style="text-align: center;">Всего (руб.)</th>
							<th width="5%" style="text-align: center;">Действие</th>
						</tr>
						<?php
						$total = 0;

						$items = db_get_items_from_active_cart($_SESSION['customer_id']);
						foreach ($items as $item) {
							$total += $item->quantity * $item->product_price;
							?>
							<tr>
								<td><?php echo $item->product_name; ?></td>
								<td style="text-align: center;"><?php echo $item->quantity; ?></td>
								<td style="text-align: center;"><?php echo $item->product_price; ?></td>
								<td style="text-align: center;"><?php echo $item->quantity * $item->product_price; ?></td>
								<td>
									<button class="btn btn-danger"
											onclick="deleteProductFromCart(<?php echo $item->id ?>)">Удалить
									</button>
								</td>
							</tr>
							<?php
						} ?>
						<tr>
							<td colspan="3" align="right">Итого:</td>
							<td align="right"><?php echo number_format($total, 2); ?> руб.</td>
							<td>

                                <form action="" method="post" enctype="multipart/form-data" style="padding-left: 300px;">
                                    <tr>
                                        <td><input type="hidden" name="item_name" value="<?php echo $product_name; ?>"></td>
                                        <td><input type="hidden" name="amt" value="<?php echo $total; ?>"></td>
                                        <td><input type="hidden" name="currency" value="Руб"></td>
                                        <td><input type="hidden" name="return" value="payment_success.php"></td>
                                        <td><input type="hidden" name="cancel_return" value="payment_cancel.php"></td>
                                    </tr>
                                    <tr >

                                        <td><button  class="btn next-btn" name="send_distributor">отправить заказ</button></td>
                                    </tr>
                                </form>

                            </td>
						</tr>

					</table>
				</div>
				<br><br>
				<hr>
				<!-- <input type="submit" value="Go" onClick="window.location = 'http://google.com';"> -->
				<!-- row -->
				<div class="row">
					<!-- section -->
					<div class="section">

						<br>
					</div>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->
	<?php include("inc/footer.php") ?>
	<?php } ?>
	<script>
		function deleteProductFromCart(id) {
			if (!confirm('Вы действительно хотите удалить продукт из корзины?')) {
				return;
			}

			let message = {'id': id};

			$.ajax({
				method: 'POST',
				url: 'customer/handlers/requests_handler.php?action=delete_product_from_cart',
				data: JSON.stringify(message),
				success() {
					window.open("cart.php", "_self");
					alert('Продукт был удален из корзины');
				}
			});
		}
	</script>

    <?php
    if (isset($_POST['send_distributor'])) {
        if (isset($_SESSION['customer_id'])) {
            $customer_id = $_SESSION['customer_id'];


            $order_status = 'inactive';


            //getting cart_id

            $sel_cart ="select * from cart where customer_id = '$customer_id' AND status = 'active'";


            $run_cart = mysqli_query($con, $sel_cart);

            $row = mysqli_fetch_array($run_cart);

            $cart_id = $row['id'];


            $check_product_item = "select * from product_item where cart_id = '$cart_id'";

            $run_check_item = mysqli_query($con, $check_product_item);

            $count = mysqli_num_rows($run_check_item);

            if($count == 0){

                echo "<script>alert('НЕТ продукта в корзине')</script>";

            }else{

                //inserting the orders  table

                $insert_orders ="insert into simple_order (registration_date, cart_id) values (NOW(), '$cart_id')";

                $run_orders = mysqli_query($con, $insert_orders);




                $update_onscreen_status = "update product_item set onscreen_status = 'Отправил' where cart_id = '$cart_id'";
                $run = mysqli_query($con, $update_onscreen_status);




                $update_cart_status = "update cart set status = 'inactive' where id = '$cart_id'";
                $run_cart = mysqli_query($con, $update_cart_status);



                $insert_customer_cart = "insert into cart (customer_id,status) values ('$customer_id','active')";
                $run_customer_cart = mysqli_query($con, $insert_customer_cart);




                //removing product_item to empty
                // $cart_status = 'inactive';
                // $empty_cart = "delete from product_item  where cart_id  in
                //(select id from cart where status like '%$cart_status%')";


                //$run_cart = mysqli_query($con,$empty_cart);
                $get_customer_name = "select * from customer where id = '$customer_id'";
                $run_name = mysqli_query($con, $get_customer_name);
                $row = mysqli_fetch_array($run_name);
                $customer_name = $row['name'];


                if ($run_orders) {
                    echo "<script>alert('".$row['name'].""."   Ваш заказ прошел успешно. Пожалуйста, дождитесь подтверждения от Дистрибьютора.')</script>";
                    echo "<script>window.open('optimum_beauty.php','_self')</script>";


                }else{
                    echo "<h2>Ваш заказ был прерван</h2><br>";
                    echo "<a href='optimum_beauty.php'>Вернуться к системy</a>";
                }
            }
        }}

    ?>

    <br>
    <?php
    if (isset($_GET['order_success'])) {
        include("order_success.php");
    }
    ?>

