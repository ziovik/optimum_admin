<?php
session_start();
include("inc/db.php");
include("inc/functions.php");
include("inc/db_functions.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title> OPTIMUM BEAUTY|DETAILS</title>

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
	<link type="text/css" rel="stylesheet" href="css/checkout_style.css"/>


</head>

<body>
<?php include("inc/headers.php"); ?>

<?php include("inc/navigation.php");  ?>

<!-- HOME -->
<div id="home">
	<!-- container -->
	<div class="container" style="min-height: 600px;">

		<!-- BREADCRUMB -->
		<div id="breadcrumb">
			<div class="container">
				<ul class="breadcrumb">
					<li><a href="optimum_beauty.php">Главная</a></li>

					<li class="active">Подробность продуктов</li>
				</ul>
			</div>
		</div>
		<!-- /BREADCRUMB -->
		<!-- home wrap -->
		<div class="home-wrap">
			<!-- home slick -->
			<div>
				<!--  Product Details -->
				<div class="product product-details clearfix">
					<?php

					echo cart();

					if (isset($_GET['pro_id'])) {
						$product_id = $_GET['pro_id'];

						$sql = "select 
						             p.id as id,
						             p.name as name,
						             st.price as price,
						             p.distributor_id as distributor_id,
						             p.manufacturer as manufacturer,
						             p.description as description,
						             st.min_order as min_order,
						             st.max_order as max_order 
						          from product p 
						               join store_item st on st.product_id = p.id
						          where p.id='$product_id'";

						$result = mysqli_query($con, $sql);
						 if (!$result) {
             printf("Error: %s\n", mysqli_error($con));
            exit();
           }/// helps to check error

						while ($rows = mysqli_fetch_array($result)) {
							$pro_id = $rows['id'];
							$pro_name = $rows['name'];
							$pro_price = $rows['price'];
							$pro_dist = $rows['distributor_id'];
							$pro_desc = $rows['description'];
							$min_order = $rows['min_order'];
							$max_order = $rows['max_order'];
							$pro_manu = $rows['manufacturer'];
						}

						$sql = "select c.name from company c where c.id = '$pro_dist' ";
						$result = mysqli_query($con, $sql);
						$rows = mysqli_fetch_array($result);
						$dist_name = $rows['name'];

					

						
					}
					?>

					<div class="col-md-6">
						<div class="product-body">
							<div class="product-label">
								<span>новый</span>
								<span class="sale">-20%</span>
							</div>
							<h2 class="product-name"
								style="width: 800px; font-size: 20px;"><?php echo $pro_name; ?></h2>
							<h3 class="product-price"><?php echo number_format($pro_price, 2); ?> руб.</h3>
							<div>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o empty"></i>
								</div>
								<span id="min_order"><?php echo $min_order; ?> </span> минимальное количество 
							</div>
							<p>На складе:<span id="max_order"><?php echo $max_order; ?> </span></p>
							<p><strong>Дистрибьютор:</strong> <?php echo $dist_name; ?></p>

							<!-- adding form -->
							<div class="product-btns">
								<div class="qty-input">
									<span class="text-uppercase">Количество: </span>
									<input id="product_id" type="hidden" name="product_id" value="<?php echo $pro_id;
									?>">
									<input id="product_quantity" class="input" type="number" name="product_quantity"
										   value="<?php  echo $min_order; ?>">
								</div>
								<button  id="add_to_cart_btn" class="primary-btn add-to-cart" style="float: right; border-radius: 5px; padding-left: 2px;">
									<i class="fa fa-shopping-cart"></i>
									<span>Добавить в корзину</span>
								</button>
							</div>
							<!-- end -->
						</div>
					</div>

					<div class="col-md-12">
						<div class="product-tab">
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Примечание</a></li>
								<li><a data-toggle="tab" href="#tab2">Производитель/Страна пройзводителя</a></li>
							</ul>
							<div class="tab-content">
								<div id="tab1" class="tab-pane fade in active">
									<p><?php echo $pro_desc; ?></p>
								</div>
								<div id="tab2" class="tab-pane fade in">
									<p><?php echo $pro_manu; ?></p>
								</div>
							</div>
						</div>
					</div>

				</div>
				<!-- /Product Details -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

</div>
<!-- FOOTER -->
 <?php include("inc/footer.php");  ?>


<script>
	function checkProductInCart(productId) {
		let newQuantity = parseInt($('#product_quantity').val());
		let customerId = <?php echo $_SESSION["customer_id"]; ?>;

		if (customerId == undefined) {
			console.log("Id покупателя не найдено в сессии");
			return;
		}

		let message = {
			'product_id': productId,
			'customer_id': customerId
		};

		$.ajax({
			method: 'POST',
			url: 'customer/handlers/requests_handler.php?action=check_product_in_cart',
			data: JSON.stringify(message),
			success(data) {
				data = JSON.parse(data);

				if (data.quantity > 0) {
					let result = confirm('Такой продукт уже есть в корзине. Вы хотите увеличить количество на '
						+ newQuantity + ' шт?');

					if (result) {
						updateProductQuantityInCart(data.id, parseInt(data.quantity) + newQuantity);
					}
				} else {
					addProductToCart(productId, newQuantity, customerId);
				}
			},
			error(data) {
			    console.log(data);
			}
		});
	}

	function addProductToCart(productId, quantity, customerId) {
		let message = {
			'product_id': productId,
			'customer_id': customerId,
			'product_quantity': quantity
		};

		$.ajax({
			method: 'POST',
			url: 'customer/handlers/requests_handler.php?action=add_to_cart',
			data: JSON.stringify(message),
			success() {
				alert('Продукт был добален в корзину');
				console.log('Продукт был добален в корзину');
				location.reload();
			}
		});
	}

	function updateProductQuantityInCart(id, quantity) {
		let message = {
			'id': id,
			'product_quantity': quantity
		};

		$.ajax({
			method: 'POST',
			url: 'customer/handlers/requests_handler.php?action=update_product_in_cart',
			data: JSON.stringify(message),
			success() {
				alert('Количество продука обновлено в корзине');
				console.log('Продукт обновлен в корзине');
				location.reload();
			}
		});
	}

	function validateProductMinQuantity() {
		let expectedQuantity = parseInt($('#min_order').text());
		let actualQuantity = parseInt($('#product_quantity').val());

		if (actualQuantity < expectedQuantity) {
			alert("Минимальное количество продукта должно быть больше или равно " + expectedQuantity);
			$('#product_quantity').val(expectedQuantity);
			return false;
		}

		return true;
	}

	function validateProductQuantity() {
		return validateProductMinQuantity();
	}

	$(document).ready(function () {
		$('#add_to_cart_btn').on('click', function () {
			let productId = $('#product_id').val();

			if (validateProductQuantity()) {
				checkProductInCart(productId);
			}
		});
	});
</script>
</body>
</html>