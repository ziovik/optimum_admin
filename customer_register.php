
<!DOCTYPE >
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

	<title>OPTIMUM BEAUTY | CART</title>

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
    <link type="text/css" rel="stylesheet" href="css/table.css" />
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<!-- HEADER -->
	
		

		<?php include("inc/header.php"); ?>

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
													
												

                                                 $get_cosms = "select * from sub_cat where cat_id='1' ";
	                                             $run_cosms = mysqli_query($con, $get_cosms );

	                                             while ($row_cosms  = mysqli_fetch_array($run_cosms)){
		                                         $cosm_id = $row_cosms['sub_cat_id'];
		                                         $cosm_name = $row_cosms['sub_cat_name'];

		                                         echo " <li style='width:300px;'><a href='cosm.php?cosm=$cosm_id'>$cosm_name</a></li>";
                                                 }
                                                }
                                               ?>
		                       
											
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
						
						<li class="dropdown side-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="depil">Депиляция <i class="fa fa-angle-right"></i></a>
							<div class="custom-menu">
								<div class="row">
									<div class="col-md-4">
										<ul class="list-links">
											
												<?php
												if (!isset($_GET['depil'])) {
													
												

                                                 $get_depils = "select * from sub_cat where cat_id='2' ";
	                                             $run_depils = mysqli_query($con, $get_depils );

	                                             while ($row_depils  = mysqli_fetch_array($run_depils)){
		                                         $depil_id = $row_depils['sub_cat_id'];
		                                         $depil_name = $row_depils['sub_cat_name'];

		                                         echo " <li style='width:300px;'><a href='depil.php?depil=$depil_id'>$depil_name</a></li>";
                                                 }
                                                }
                                               ?>
		                       
											
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
	
						<li class="dropdown side-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="solar">Солярий <i class="fa fa-angle-right"></i></a>
							<div class="custom-menu">
								<div class="row">
									<div class="col-md-4">
										<ul class="list-links">
											
												<?php
												if (!isset($_GET['solar'])) {
													
												

                                                 $get_solars = "select * from sub_cat where cat_id='3' ";
	                                             $run_solars = mysqli_query($con, $get_solars );

	                                             while ($row_solars  = mysqli_fetch_array($run_solars)){
		                                         $solar_id = $row_solars['sub_cat_id'];
		                                         $solar_name = $row_solars['sub_cat_name'];

		                                         echo " <li style='width:300px;'><a href='solar.php?solar=$solar_id'>$solar_name</a></li>";
                                                 }
                                                }
                                               ?>
		                       
											
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
		
						<li class="dropdown side-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="massag">Массаж <i class="fa fa-angle-right"></i></a>
							<div class="custom-menu">
								<div class="row">
									<div class="col-md-4">
										<ul class="list-links">
											
												<?php
												if (!isset($_GET['massag'])) {
													
												

                                                 $get_massags = "select * from sub_cat where cat_id='4' ";
	                                             $run_massags = mysqli_query($con, $get_massags );

	                                             while ($row_massags  = mysqli_fetch_array($run_massags)){
		                                         $massag_id = $row_massags['sub_cat_id'];
		                                         $massag_name = $row_massags['sub_cat_name'];

		                                         echo " <li style='width:300px;'><a href='massag.php?massag=$massag_id'>$massag_name</a></li>";
                                                 }
                                                }
                                               ?>
		                       
											
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
					
				
						<li class="dropdown side-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="par">Парикмахерская Продукция <i class="fa fa-angle-right"></i></a>
							<div class="custom-menu">
								<div class="row">
									<div class="col-md-4">
										<ul class="list-links">
											<li>
												<h3 class="list-links-title">Парикмахерская Продукция</h3></li>
                                                   <?php
												if (!isset($_GET['par'])) {
													
												 $get_pars = "select * from sub_cat where cat_id='5' ";
	                                             $run_pars = mysqli_query($con, $get_pars );

	                                             while ($row_pars  = mysqli_fetch_array($run_pars)){
		                                         $par_id = $row_pars['sub_cat_id'];
		                                         $par_name = $row_pars['sub_cat_name'];

                                                 

		                                         echo " <li style='width:300px;'><a href='parak.php?par=$par_id'>$par_name</a></li>";
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
													
												
                                                 $get_nails = "select * from sub_cat where cat_id='6' ";
	                                              $run_nails = mysqli_query($con, $get_nails );

	                                              while ($row_nails  = mysqli_fetch_array($run_nails)){
		                                          $nail_id = $row_nails['sub_cat_id'];
		                                          $nail_name = $row_nails['sub_cat_name'];	

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
				<li class="active">Register</li>
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
		
		<form action="customer_register.php" method="post" enctype="multipart/form-data">
			<table  align="center" width="750">
				<tr align="center">
					<td colspan="6"><h2>Create an account</h2></td>
				</tr>
				<tr>
					<td align="right">Customer Name:</td>
					<td><input type="text" name="c_name" required></td>
				</tr>
				<tr>
					<td align="right">Customer Email</td>
					<td><input type="text" name="c_email" required></td>
				</tr>
				<tr>
					<td align="right">Customer Password</td>
					<td><input type="password" name="c_pass" required></td>
				</tr>
				<tr>
					<td align="right">Customer Image</td>
					<td><input type="file" name="c_image"></td>
				</tr>
				<tr>
					<td align="right">Customer Country:</td>
					<td>
						<select name="c_country">
							<option>Select a Country</option>
							<option>Russia</option>
							<option>Ukrain</option>
							

						</select>
					</td>
				</tr>
				<tr>
					<td align="right">Customer City:</td>
					<td><input type="text" name="c_city" required></td>
				</tr>
				<tr>
					<td align="right">Customer Contact</td>
					<td><input type="text" name="c_contact" required></td>
				</tr>
				<tr>
					<td align="right">Customer Address</td>
					<td><textarea  cols="80" rows="5" name="c_address" required></textarea></td>
				</tr>
				<tr align="center">
					
					<td colspan="6"><input type="submit" name="register" value="Create Account"></td>
				</tr>
			</table>
			
		</form>
		
		
		
	</div>
	<!-- /section -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<?php  include("inc/footer1.php"); ?>



	<?php
      if (isset($_POST['register'])) {
      	
      	$ip = getIP();

      	$c_name = $_POST['c_name'];
      	$c_email = $_POST['c_email'];
      	$c_pass = $_POST['c_pass'];

      	$c_image = $_FILES['c_image']['name'];
      	$c_image_tmp = $_FILES['c_image']['tmp_name'];

      	move_uploaded_file($c_image_tmp, "customer/customer_images/$c_image");

      	$c_country = $_POST['c_country'];
      	$c_city = $_POST['c_city'];
      	$c_contact = $_POST['c_contact'];
      	$c_address = $_POST['c_address'];


      	$insert_c = "insert into customers 
      	(customer_ip,customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image) 
      	values 
      	('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')";

         $run_c = mysqli_query($con, $insert_c);

        // if ($run_c) {
         	//echo "<script>alert('Customer Registered Succesfully')</script>";
         	//echo "<script>window.open('customer_login.php','_self')<script>";
         //}
         
         $sel_cart ="select * from cart where ip_add='$ip'";

         $run_cart = mysqli_query($con, $sel_cart);

         $check_cart = mysqli_num_rows($run_cart);

         if($check_cart == 0){

         	$_SESSION['customer_email']= $c_email;

         	echo "<script>alert('Registration Succesfully.Account created Succesfully')</script>";
         	echo "<script>window.open('customer/my_account.php','_self')<script>";
         }

         else {
         	$_SESSION['customer_email']= $c_email;

         	echo "<script>alert('Account created Succesfully')</script>";
         	echo "<script>window.open('checkout.php','_self')<script>";
         }

      }



	?>