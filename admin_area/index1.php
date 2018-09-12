<?php

session_start();

if (!isset($_SESSION['user_email'])) {
	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}

else{
	


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>OPTIMUM BEAUTY | ADMIN</title>

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
	<link type="text/css" rel="stylesheet" href="css/email.css" />
	<link type="text/css" rel="stylesheet" href="css/animate_intro.css" />
	<link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>

	<script type="text/javascript" src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
	<script >
		tinymce.init({selector:'textarea'});
	</script>

</head>

<body>
	<?php include("inc/header.php") ?>

	<!-- NAVIGATION -->
	<div id="navigation">
		<!-- container -->
		<div class="container">
			<div id="responsive-nav">
				<!-- category nav -->
				<div class="category-nav show-on-click">
					<span class="category-header">Manage Content<i class="fa fa-list"></i></span>
					<ul class="category-list">
						
						<li><a href="insert_product.php">Insert Product</a></li>
						<li><a href="index.php?view_products">View All Products</a></li>
						<li><a href="index.php?insert_cats">Insert New Category</a></li>
						<li><a href="index.php?view_cats">View All Categories</a></li>
						<li><a href="index.php?insert_sub_cat">Insert New Sub Categories</a></li>
						<li><a href="index.php?view_sub_cat">View All Sub Categories</a></li>
						<li><a href="index.php?insert_region">Insert New Region </a></li>
						<li><a href="index.php?view_region">View All Regions</a></li>
						<li><a href="index.php?view_customers">View All Customers</a></li>
						<li><a href="index.php?insert_customer">Insert New Customer</a></li>
						<li><a href="index.php?view_distributor">View All Distributors</a></li>
						<li><a href="index.php?insert_distributor">Insert New Distributors</a></li>
						<li><a href="index.php?view_orders">View Orders</a></li>
						<li><a href="index.php?email">Email</a></li>
						<li><a href="logout.php">Admin Logout</a></li>
						
					</ul>
				</div>
				<!-- /category nav -->

				
			</div>
		</div>
		<!-- /container -->
	</div>
	<!-- /NAVIGATION -->

	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Admin</li>
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
				

				<!-- MAIN -->
				<div id="main" class="col-md-12">
					
					<!-- /store top filter -->

					<!-- STORE -->
					<div id="store">
						<!-- row -->
						<div class="row"><br><br>
							 <h1 class="title"> Controller Space by Admin </h1>
							  <div id="container">
							    <div class="pricetab">
							      <h1> Эстетик </h1>
							      <div class="price"> 
							        <h2> 1 </h2> 
							      </div>
							      <div class="infos">
							         <h3> Имеет интуитивно понятый  </h3>
							        <h3> Интерфейс и леког в испоьзовании  </h3>
							       
							        
							      </div>
							      <div class="pricefooter">
							        <div class="button">
							          <a href="estetik_products.php"> Get Products </a>
							        </div>
							      </div>
							    </div>
							    <div class="pricetab">
							      <h1> COSCO </h1>
							      <div class="price"> 
							        <h2> 2 </h2> 
							      </div>
							      <div class="infos">
							         <h3> Имеет интуитивно понятый  </h3>
							        <h3> Интерфейс и леког в испоьзовании  </h3>
							       
							        
							      </div>
							      <div class="pricefooter">
							        <div class="button">
							          <a href="cosco_products.php"> Get Products </a>
							        </div>
							      </div>
							    </div>
							    <div class="pricetabmid">
							      <h1>OPTIMUM BEAUTY </h1>
							      <div class="pricemid"> 
							        <h2> Head </h2> 
							      </div>
							      <div class="infos">
							        <h3> Имеет интуитивно понятый  </h3>
							        <h3> Интерфейс и леког в испоьзовании  </h3>
							       
							        
							      </div>
							      <div class="pricefootermid">
							        <div class="buttonmid">
							          <a href="index.php?view_products"> All </a>
							        </div>
							      </div>
							    </div>
							    <div class="pricetab">
							      <h1> Индустрия </h1>
							      <div class="price"> 
							        <h2> 3</h2> 
							      </div>
							      <div class="infos">
							         <h3> Имеет интуитивно понятый  </h3>
							        <h3> Интерфейс и леког в испоьзовании  </h3>
							       
							        
							      </div>
							      <div class="pricefooter">
							        <div class="button">
							          <a href="industrial_products.php"> Get Products </a>
							        </div>
							      </div>
							    </div>
							    <div class="pricetab">
							      <h1> Прокосм </h1>
							      <div class="price"> 
							        <h2> 4 </h2> 
							      </div>
							      <div class="infos">
							         <h3> Имеет интуитивно понятый  </h3>
							        <h3> Интерфейс и леког в испоьзовании  </h3>
							       
							       
							      </div>
							      <div class="pricefooter">
							        <div class="button">
							          <a href="profcos_products.php"> Get Products </a>
							        </div>
							      </div>
							    </div>
							  </div>


							   <div id="container">
							   	<div class="pricetab">
							      <h1> Dist</h1>
							      <div class="price"> 
							        <h2> 5</h2> 
							      </div>
							      <div class="infos">
							         <h3> Имеет интуитивно понятый  </h3>
							        <h3> Интерфейс и леког в испоьзовании  </h3>
							       
							      
							      </div>
							      <div class="pricefooter">
							        <div class="button">
							          <a href="dist_products.php"> Get Products </a>
							        </div>
							      </div>
							    </div>

							    <div class="pricetab">
							      <h1> MeSoProff </h1>
							      <div class="price"> 
							        <h2> 6 </h2> 
							      </div>
							      <div class="infos">
							         <h3> Имеет интуитивно понятый  </h3>
							        <h3> Интерфейс и леког в испоьзовании  </h3>
							       
							        
							      </div>
							      <div class="pricefooter">
							        <div class="button">
							          <a href="mesoff_products.php"> Get Products </a>
							        </div>
							      </div>
							    </div>
							   </div>

							<?php

							  if (isset($_GET['insert_product'])) {
							  	include("insert_product.php");
							  }



							  if (isset($_GET['view_products'])) {
							  	include("view_products.php");
							  }

							  if (isset($_GET['edit_product'])) {
							  	include("edit_product.php");
							  }
							  if (isset($_GET['insert_cats'])) {
							  	include("insert_cat.php");
							  }
							  if (isset($_GET['view_cats'])) {
							  	include("view_cats.php");
							  }
							  if (isset($_GET['edit_cat'])) {
							  	include("edit_cat.php");
							  }
							  if (isset($_GET['insert_sub_cat'])) {
							  	include("insert_sub_cat.php");
							  }
							  if (isset($_GET['view_sub_cat'])) {
							  	include("view_sub_cat.php");
							  }
							  if (isset($_GET['edit_sub_cat'])) {
							  	include("edit_sub_cat.php");
							  }
							  if (isset($_GET['view_customers'])) {
							  	include("view_customers.php");
							  }
							   if (isset($_GET['insert_customer'])) {
							  	include("insert_customer.php");
							  }
							   if (isset($_GET['edit_customer'])) {
							  	include("edit_customer.php");
							  }
							  if (isset($_GET['view_distributor'])) {
							  	include("view_distributor.php");
							  }
							  if (isset($_GET['insert_distributor'])) {
							  	include("insert_distributor.php");
							  }


							   if (isset($_GET['view_orders'])) {
							  	include("view_orders.php");
							  }

							   if (isset($_GET['insert_region'])) {
							  	include("insert_region.php");
							  }
							   if (isset($_GET['edit_region'])) {
							  	include("edit_region.php");
							  }
							  if (isset($_GET['view_region'])) {
							  	include("view_region.php");
							  }
							  if (isset($_GET['customer_details'])) {
							  	include("customer_detail.php");
							  }
							  if (isset($_GET['order_details'])) {
							  	include("view_order_details.php");
							  }

							   
							   if (isset($_GET['email'])) {
							  	include("email.php");
							  }

							  
							  




							?>
							


						</div>
						<!-- /row -->
					</div>
					<!-- /STORE -->

					
				</div>
				<!-- /MAIN -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<?php include("inc/footer1.php")  ?>

	<?php } ?>

	