<?php
session_start();
include("../inc/db.php");
include("../inc/functions.php");

//for not acceessing this page by another person who is not in admin

if (!isset($_SESSION['customer_id'])) {
	echo "<script>window.open('customer/customer_login.php?not_admin=You are not signed in!','_self')</script>";
} else {
//end


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
	<?php include("inc_customer/header_search_distributors.php"); ?>
	<!-- /HEADER -->


	<!-- NAVIGATION -->
<?php include("inc_customer/navigation_dropdown.php"); ?>
	<!-- /NAVIGATION -->


	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="../optimum_beauty.php">Главная</a></li>
				<li class="active">Профкосмматериалы</li>
			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->

	<!-- HOME -->
	<div id="home">
		<!-- container -->
		<div class="container" style="min-height: 700px;">
			<br>
			<h2 style="text-align: center;">ПРОФКОСММАТЕРИАЛЫ</h2>
		
			<!-- home wrap -->
			<div class="home-wrap" id="result1">
				<!-- home slick -->
				<div>

				</div>
				<!-- /home slick -->

			</div>
			<!-- /home wrap -->

		</div>

		<!-- /container -->
	</div>
	<!-- /HOME -->


	<?php include("inc_customer/footer.php"); ?>
	<?php } ?>

	<script>
		$(document).ready(function () {

			load_data();

			function load_data(query) {
				$.ajax({
					url: "fetch_profcosmaterial.php",
					method: "POST",
					data: {query: query},
					success: function (data) {
						$('#result1').html(data);
					}
				});
			}

			$('#search_text').keyup(function () {
				var search = $(this).val();
				if (search != '') {
					load_data(search);
				}
				else {
					load_data();
				}
			});
		});
	</script>