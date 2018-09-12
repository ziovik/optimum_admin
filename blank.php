
<!DOCTYPE html>
<?php  
       session_start();
       include("inc/functions.php");
?>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>OPTIMUM BEAUTY</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="css/slick.css" />
	<link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<!-- HEADER -->
	
		


       
       <header>
		<!-- top Header -->
		<div id="top-header">
			<div class="container">
				<div class="pull-left">
					<?php

					if (isset($_SESSION['customer_email'])) {
						echo "<span>Welcome to OPTIMUM BEAUTY   :    </span>". $_SESSION['customer_email'] ."<span></span>";
					
					}

					?>
					
				</div>
				<div class="pull-right">
					<ul class="header-top-links">
						<li><a href="#">Store</a></li>
						<li><a href="#">Newsletter</a></li>
						<li><a href="#">FAQ</a></li>
						<li class="dropdown default-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">ENG <i class="fa fa-caret-down"></i></a>
							<ul class="custom-menu">
								<li><a href="#">English (ENG)</a></li>
								<li><a href="#">Russian (Ru)</a></li>
								<li><a href="#">French (FR)</a></li>
								<li><a href="#">Spanish (Es)</a></li>
							</ul>
						</li>
						<li class="dropdown default-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">USD <i class="fa fa-caret-down"></i></a>
							<ul class="custom-menu">
								<li><a href="#">USD ($)</a></li>
								<li><a href="#">EUR (€)</a></li>
							</ul>
						</li>
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
						<a class="logo" href="index.php">
							<img src="../img/logo.png" alt="">
						</a>
					</div>
					<!-- /Logo -->

					<!-- Search -->
					<div class="header-search">
						<form method="get" action="results.php" enctype="multipart/form-data">
							<input class="input search-input" type="text" name="user_query" placeholder="Enter your keyword">
							
							<button class="search-btn" name="search" value="Search"><i class="fa fa-search"></i></button>
						</form>
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
                                            }
                                            else{
                                            	echo "<a href='logout.php' class='text-uppercase'>Logout</a> ";

                                            }
                                         
						     ?>
							
							<ul class="custom-menu">
								<li><a href="#"><i class="fa fa-user-o"></i> My Account</a></li>
								<li><a href="#"><i class="fa fa-heart-o"></i> My Wishlist</a></li>
								<li><a href="#"><i class="fa fa-exchange"></i> Compare</a></li>
								<li><a href="#"><i class="fa fa-check"></i> Checkout</a></li>
								<li><a href="#"><i class="fa fa-unlock-alt"></i> Login</a></li>
								<li><a href="#"><i class="fa fa-user-plus"></i> Create An Account</a></li>
							</ul>
						</li>
						<!-- /Account -->

						<!-- Cart -->
						<li class="header-cart dropdown default-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-shopping-cart"></i>
									<span class="qty"><?php total_items();  ?></span>
								</div>
								<strong class="text-uppercase">My Cart:</strong>
								<br>
								<span><?php total_price() ?></span>
							</a>
							<div class="custom-menu">
								<div id="shopping-cart">
									<div class="shopping-cart-list">
										
									</div>
									<div class="shopping-cart-btns">
										<a href="cart.php"><button class="main-btn">View Cart</button></a>
										<button class="primary-btn">Checkout <i class="fa fa-arrow-circle-right"></i></button>


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

	<!-- NAVIGATION -->
	<div id="navigation">
		<!-- container -->
		<div class="container">
			<div id="responsive-nav">
				<!-- category nav -->
				<div class="category-nav show-on-click">
					<span class="category-header">Категории <i class="fa fa-list"></i></span>
					<ul class="category-list">
						<li class="dropdown side-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="cosm">Косметология <i class="fa fa-angle-right"></i></a>
							<div class="custom-menu">
								<div class="row">
									<div class="col-md-4">
										<ul class="list-links">
											<li><h3 class="list-links-title">Косметология</h3></li>
												<?php
												if (!isset($_GET['cosm'])) {
													
												
                                                 $get_cosm = "select * from cosmotology";
	                                             $run_cosm = mysqli_query($con, $get_cosm );

	                                             while ($row_cosm  = mysqli_fetch_array($run_cosm)){
		                                         $cosm_id = $row_cosm['cosm_id'];
		                                         $cosm_name = $row_cosm['cosm_name'];

		                                         echo " <li style='width:300px;'><a href='cosm.php?cosm=$cosm_id'>$cosm_name</a></li>";

                                                 }
                                                }
                                               ?>
		                       
	                        

						
											<!--
											<li><a href="#">Инъекционная</a></li>
											<li><a href="#">Аппаратная</a></li>
											<li><a href="#">Уход за кожей</a></li>-->
											
										</ul>
										<hr class="hidden-md hidden-lg">
									</div>
									
								<div class="row hidden-sm hidden-xs">
									<div class="col-md-12">
										<hr>
										<a class="banner banner-1" href="#">
											<img src="./img/banner05.jpg" alt="">
											<div class="banner-caption text-center">
												<h2 class="white-color">NEW COLLECTION</h2>
												<h3 class="white-color font-weak">HOT DEAL</h3>
											</div>
										</a>
									</div>
								</div>
							</div>
						</li>
						<li><a href="#">Депиляция</a></li>
						<li><a href="#">Солярий</a></li>
						<li><a href="#">Массаж</a></li>
						<li class="dropdown side-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="par">Парикмахерская Продукция <i class="fa fa-angle-right"></i></a>
							<div class="custom-menu">
								<div class="row">
									<div class="col-md-4">
										<ul class="list-links">
											<li>
												<h3 class="list-links-title">Парикмахерская Продукция</h3></li>
                                                   <?php
												if (!isset($_GET['par'])) {
													
												
                                                 $get_par = "select * from paramak";
	                                             $run_par = mysqli_query($con, $get_par );

	                                             while ($row_par  = mysqli_fetch_array($run_par)){
		                                         $par_id = $row_par['par_id'];
		                                         $par_name = $row_par['par_name'];

		                                         echo " <li style='width:300px;'><a href='#'>$par_name</a></li>";
                                                 }
                                                }
                                               ?>

											<!--<li><a href="#">Окрашивание волос</a></li>
											<li><a href="#">Уход за волосами</a></li>
											<li><a href="#">Стайлинг</a></li>
											<li><a href="#">Нарашивание волос</a></li>
											<li><a href="#">Инструменты, аксесуары и расходные материалы</a></li>-->
										</ul>
										<hr>
										
										<hr class="hidden-md hidden-lg">
									</div>
									
									<div class="col-md-4 hidden-sm hidden-xs">
										<a class="banner banner-2" href="#">
											<img src="./img/banner04.jpg" alt="">
											<div class="banner-caption">
												<h3 class="white-color">NEW<br>COLLECTION</h3>
											</div>
										</a>
									</div>
								</div>
							</div>
						</li>
						
						<li class="dropdown side-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="nail">Ногтевой сервис <i class="fa fa-angle-right"></i></a>
							<div class="custom-menu">
								<div class="row">
									<div class="col-md-4">
										<ul class="list-links">
											<li>
												<h3 class="list-links-title">Ногтевой сервис</h3></li>

												<?php
												if (!isset($_GET['nail'])) {
													
												
                                                 $get_nail = "select * from nails";
	                                             $run_nail = mysqli_query($con, $get_nail );

	                                             while ($row_nail  = mysqli_fetch_array($run_nail)){
		                                         $nail_id = $row_nail['nail_id'];
		                                         $nail_name = $row_nail['nail_name'];

		                                         echo " <li style='width:300px;'><a href='nail.php?nail=$nail_id'>$nail_name</a></li>";
                                                 }
                                                }
                                               ?>
											<!--<li><a href="#">Моделтрование</a></li>
											<li><a href="#">Уход за ногтями и кожей рук</a></li>
											<li><a href="#">Декор ногтей</a></li>
											<li><a href="#">Инструменты и техника</a></li>
											<li><a href="#">Расходные материалы</a></li>-->
										</ul>
										<hr>
										
										<hr class="hidden-md hidden-lg">
									</div>
									
									
								</div>
							</div>
						</li>
						
						<li><a href="all_products.php?all_products">View All</a></li>
					</ul>
				</div>
				<!-- /category nav -->

				<!-- menu nav -->
				<div class="menu-nav">
					<span class="menu-header">Menu <i class="fa fa-bars"></i></span>
					<ul class="menu-list">
						
						
						
						
						<li class="dropdown default-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="region">Regions <i class="fa fa-caret-down"></i></a>
							<ul class="custom-menu">
							

							<?php echo getRegion();  ?>


							</ul>
						</li>
					</ul>
				</div>
				<!-- menu nav -->
			</div>
		</div>
		<!-- /container -->
	</div>
	<!-- /NAVIGATION -->

	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="index.php">Home</a></li>
				<li class="active">My Account</li>
			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section -->
	<div class="section">
		
		
		
		
		
	</div>
	<!-- /section -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<?php  include("inc/footer1.php"); ?>



	