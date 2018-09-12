<!DOCTYPE html>

<?php
session_start();
include_once '../db_object/Customer.php';
include_once '../db_object/SubCategory.php';
include_once '../db_object/Category.php';
include_once '../db_object/Cart.php';
include_once '../db_object/Product.php';
include_once '../db_object/ProductItem.php';
include_once '../inc/db_functions.php';
include_once '../inc/functions.php';
include_once '../inc/tests.php';
include_once '../inc/actions.php';
?>

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
	<link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css"/>

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="../css/slick.css"/>
	<link type="text/css" rel="stylesheet" href="../css/slick-theme.css"/>

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="../css/nouislider.min.css"/>

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="../css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="../css/style.css"/>
	<script
			src="https://code.jquery.com/jquery-3.3.1.min.js"
			integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			crossorigin="anonymous"></script>
</head>
<body>
<!-- HEADER -->
<header>
	<!-- top Header -->
	<div id="top-header">
		<div class="container">
			<div class="pull-left">
				<?php

				if (isset($_SESSION['login'])) {
					$login = $_SESSION['login'];
					$customer_name = get_customer_by_login($login)->name;

					echo "<span>Добро пожаловать  в OPTIMUM BEAUTY   :    </span>" . $customer_name . "<span></span>";
					echo "<span>   :    </span>" . $_SESSION['login'] . "<span></span>";
				} else {
					echo "<b>Добро пожаловать Гость</b>";
				}
				?>

			</div>
			<div class="pull-right">
				<ul class="header-top-links">
					<?php

					if (!isset($_SESSION['login'])) {
						echo "<button style='width:100px;' background:#800080; border-radius:5px;' class='btn next-btn'><a href='#' class='text-uppercase' style='color:#fff;'>Войти</a></buuton>";
					} else {
						echo "<button style='width:100px;' background:#800080; border-radius:5px;' class='btn next-btn'><a href='logout.php' class='text-uppercase' style='color:#fff;'>Выити</a></buuton>";
					}
					?>
				</ul>
			</div>
		</div>
	</div>
	<!-- /top Header -->

	<!-- header -->
	<div id="header">
		<div class="container">
			<div class="pull-left">
				<!-- Logo -->
				<div class="header-logo">
					<a class="logo" href="../optimum_beauty.php">
						<img src="../img/logo.png" alt="">
					</a>
				</div>
				<!-- /Logo -->

				<!-- Search -->
				<div class="header-search">
					<div class="input-group">
						<span class="input-group-addon">Search</span>
						<input type="text" name="search_text" id="search_text"
							   placeholder="Search by Product Details" class="form-control"
							   style="width: 600px; float: left;"/>
					</div>
				</div>
				<!-- /Search -->

			</div>
			<div class="pull-right">
				<ul class="header-btns">
					<!-- Account -->
					<li class="header-account dropdown default-dropdown">
						<div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
							<div class="header-btns-icon">
								<i class="fa fa-user-o"></i>
							</div>
							<strong class="text-uppercase">My Account <i class="fa fa-caret-down"></i></strong>
						</div>
						<?php

						if (!isset($_SESSION['customer_email'])) {
							echo "<a href='checkout.php'>Login</a>";
						} else {
							echo "<a href='../logout.php' class='text-uppercase'>Logout</a> ";

						}

						?>

						<ul class="custom-menu">
							<li><a href="customer/my_account.php"><i class="fa fa-user-o"></i> My Account</a></li>

							<li><a href="checkout.php"><i class="fa fa-check"></i> Checkout</a></li>
							<li><a href="customer_login.php"><i class="fa fa-unlock-alt"></i> Login</a></li>

						</ul>
					</li>
					<!-- /Account -->

					<!-- Cart -->
					<li class="header-cart dropdown default-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
							<div class="header-btns-icon">
								<i class="fa fa-shopping-cart"></i>
								<?php
								if (isset($_SESSION['product_item_number'])) {
									$prod_items_num = $_SESSION['product_item_number'];
									if ($prod_items_num > 0) {
										?>
										<span class="qty"><?php echo $prod_items_num; ?></span>
										<?php
									}
								}
								?>
								</span>
							</div>
							<strong class="text-uppercase">My Cart:</strong>
							<br>
							<span></span>
						</a>
						<div class="custom-menu">
							<div id="shopping-cart">
								<div class="shopping-cart-list">

								</div>
								<div class="shopping-cart-btns">
									<a href="cart.php">
										<button class="main-btn">View Cart</button>
									</a>
									<button class="primary-btn">Checkout <i class="fa fa-arrow-circle-right"></i>
									</button>


								</div>
							</div>
						</div>
					</li>
					<!-- /Cart -->

					<!-- Mobile nav toggle-->
					<li class="nav-toggle">
						<button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
					</li>
					<!-- / Mobile nav toggle -->
				</ul>
			</div>
		</div>
		<!-- header -->

	</div>
	<!-- container -->
</header>
<!-- /HEADER -->

<!-- NAVIGATION -->
<div id="navigation">
	<!-- container -->
	<div class="container">
		<div id="responsive-nav">
			<!-- category nav -->
			<div class="category-nav">
				<?php include '../inc/menu.php'; ?>
			</div>
		</div>
		<!-- /container -->
	</div>
</div>
<!-- /NAVIGATION -->


<!-- HOME -->
<div id="home">
	<!-- container -->
	<div class="container" style="min-height: 600px;">

		<!-- BREADCRUMB -->
		<div id="breadcrumb">
			<div class="container">
				<ul class="breadcrumb">
					<li><a href="../index.php">Главная</a></li>

					<li class="active">Описание продукта</li>
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
					if (isset($_GET['product_id'])) {
						$product_id = $_GET['product_id'];

						$sql = "
select 
p.*,
c.name as company_name
from 
product p
join distributor d on p.distributor_id = d.id
join company c on d.company_id = c.id 
where p.id ='$product_id'
";
						$con = get_db_connection();
						$result = $con->query($sql);
						$row = $result->fetch_assoc();

						$prod_id = $row['id'];
						$prod_name = $row['name'];
						$prod_desc = $row['description'];
						$prod_manu = $row['manufacturer'];
						$prod_price = $row['price'];
						$prod_min_order = $row['min_order'];
						$prod_max_order = $row['max_order'];
						$company_name = $row['company_name'];

						if (isset($_SESSION['customer_id'])) {
							$customer_id = $_SESSION['customer_id'];
						}
						$quantity = 0;
						?>
						<div class="col-md-6">
							<div class="product-body">
								<div class="product-label">
									<span>New</span>
									<span class="sale">-20%</span>
								</div>
								<h2 class="product-name"><?php echo $prod_name; ?></h2>
								<h3 class="product-price"><?php echo $prod_price; ?></h3>
								<div>
									<div class="product-rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o empty"></i>
									</div>
									<a href="#"><?php echo $prod_min_order; ?> заказ / минимум</a>
								</div>
								<p><strong>Доступно: </strong><?php echo $prod_max_order; ?> в наличии</p>
								<p><strong>Поставщик:</strong> <?php echo $company_name; ?></p>

								<div class="product-btns">
									<div class="qty-input">
										<span class="text-uppercase">QTY: </span>
										<input class="input" type="number" name="qty" value="<?php $quantity ?>">
										<input type="hidden" name="hidden_name" value="<?php echo $prod_name; ?>">
										<input type="hidden" name="hidden_price" value="<?php echo $prod_price; ?>">
									</div>

									<form>
										<input id="product_id" value="<?php echo $product_id; ?>"
											   type="hidden">
										<input id="customer_id" value="<?php echo $customer_id; ?>" type="hidden">
										<input id="quantity" value="<?php echo $quantity; ?>" type="hidden">

										<script>
											function send_request() {
												var productId = $('#product_id').val();
												var customerId = $('#customer_id').val();
												var quantity = $('#quantity').val();
												$.ajax({
													url: '../inc/rest_controller.php',
													type: 'POST',
													data: {
														product_id: productId,
														customer_id: customerId,
														quantity: quantity
													},
													success: function(msg) {
														console.log('SUCCESS');
													}
												});
											}
										</script>

										<button class="primary-btn add-to-cart" type="button" name="add_cart"
										onclick="send_request()">
											<i class="fa fa-shopping-cart"></i>Добавить в корзину
										</button>
									</form>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="product-tab">
								<ul class="tab-nav">
									<li class="active"><a data-toggle="tab" href="#tab1">Описание</a></li>

									<li>
										<a data-toggle="tab" href="#tab2">Производитель</a>
									</li>
								</ul>
								<div class="tab-content">
									<div id="tab1" class="tab-pane fade in active">
										<p><?php echo $prod_desc; ?></p>
									</div>
									<div id="tab2" class="tab-pane fade in">
										<p><?php echo $prod_manu; ?></p>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					?>
				</div>
				<!-- /Product Details -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

</div>
</body>
<?php include '../inc/footer1.php'; ?>
</html>
