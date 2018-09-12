<?php
/**
 * Created by PhpStorm.
 * User: nd
 * Date: 04.08.18
 * Time: 16:05
 */
session_start();
include_once '../db_object/SubCategory.php';
include_once '../db_object/Category.php';
include_once '../db_object/Customer.php';
include_once '../inc/db_functions.php';
include_once '../inc/tests.php';
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
	<link type="text/css" rel="stylesheet" href="../css/table.css"/>
	<link type="text/css" rel="stylesheet" href="../css/checkout_style.css"/>


	<!--table resp-->
	<link rel="stylesheet" href="../css/rwd-table.min.css?v=5.3.1">
	<link rel="stylesheet" href="../css/docs.min.css?v=5.3.1">

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

<!-- HEADER -->
<?php include_once '../inc/header.php'; ?>
<!-- /HEADER -->


<!-- NAVIGATION -->
<div id="navigation">
	<!-- container -->
	<div class="container">
		<div id="responsive-nav">
			<!-- category nav -->
			<div class="category-nav show-on-click">
				<?php include '../inc/menu.php'; ?>
			</div>
		</div>
		<!-- /container -->
	</div>
	<!-- /NAVIGATION -->

	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="../optimum_beauty.php">Главная</a></li>
				<li class="active">
					<?php
					if (isset($_GET['category_id'])) {
						$category_id = $_GET['category_id'];
						$category = get_category_by_id($category_id);
						echo $category->name;
					}
					?>
				</li>
			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->

	<!-- HOME -->
	<div id="home">
		<!-- container -->
		<div class="container" style="min-height: 600px;">
			<!-- home wrap -->
			<div class="home-wrap">
				<!-- home slick -->
				<div>

					<!-- banner -->
					<div class="banner banner-1">
						<div class="table-responsive" data-pattern="priority-columns">
							<table cellspacing="0" id="group-test"
								   class="table table-small-font table-bordered table-striped">
								<thead>
								<tr>
									<th colspan="1" data-priority="1">Дистрибьютор</th>
									<th colspan="1" data-priority="2" style="width:400px;">Найменование</th>
									<th colspan="1" data-priority="3">Производитель/<br>Страна производства</th>
									<th colspan="1" data-priority="4">Цена</th>
									<th colspan="1" data-priority="5">Годен до</th>
									<th colspan="1" data-priority="6">Остаток</th>
									<th colspan="1" data-priority="7">Примечание</th>
								</tr>
								<?php

								if (isset($_SESSION['customer_id'])) {
									$customer_id = $_SESSION['customer_id'];

									$sql =
										"
select
  p.id as product_id,
  p.name as product_name,
  p.manufacturer as product_manufacturer,
  p.price as product_price,
  p.min_order as product_min_order,
  p.discount as product_discount,
  p.expired as product_expired,
  p.description as product_description,
  cm.name as company_name
from
  store s
  join distributor d on d.id = s.distributor_id
  join product p on p.distributor_id = d.id
  join customer c on c.region_id = s.region_id
  join company cm on cm.id = d.company_id
  join sub_category sc on p.sub_category_id = sc.id
  join category c2 on sc.category_id = c2.id

where c.id ='$customer_id' and c2.id= '$category_id'
";
									$con = get_db_connection();
									if ($result = $con->query($sql)) {

										while ($row = $result->fetch_assoc()) {
											$pro_id = $row['product_id'];
											$pro_name = $row['product_name'];
											$pro_manu = $row['product_manufacturer'];
											$pro_price = $row['product_price'];
											$pro_dist = $row['company_name'];
											$pro_min_order = $row['product_min_order'];
											$pro_expires = $row['product_expired'];
											$pro_desc = $row['product_description'];
											?>
											<tr>
												<th data-priority="1"
													style="background: white; color: #400040;"><?php echo $pro_dist; ?></th>
												<td data-priority="2" style="background: white; color: #400040;
												width: 400px;">
													<a href="product_details.php?product_id=<?php echo $pro_id;?>">
														<?php echo $pro_name; ?>
													</a>
												</td>
												<td data-priority="3" style="background: white; color: #400040;
">
													<?php echo $pro_manu; ?>
												</td>
												<td data-priority="4" style="background: white; color: #400040;
">
													<?php echo $pro_price; ?>
												</td>
												<td data-priority="5" style="background: white; color: #400040;
">
													<?php echo $pro_expires; ?>
												</td>
												<td data-priority="5" style="background: white; color: #400040;
">
													<?php echo $pro_min_order; ?>
												</td>
												<td data-priority="5" style="background: white; color: #400040;
">
													<?php echo $pro_desc; ?>
												</td>
											</tr>
											<?php
										}
									} else {
										echo "<h2 style='text-align:center;'>Нет продукта</h2>";
									}
								}
								?>
								</thead>
							</table>
						</div>
					</div>

					<br>
				</div>
				<!-- /section -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

</div>
</body>
<?php include("../inc/footer1.php"); ?>
</html>