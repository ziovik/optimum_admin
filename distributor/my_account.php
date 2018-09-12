
<!DOCTYPE html>
<?php  
       session_start();
       include("../inc/db.php");
       include("../inc/functions.php");
       if (!isset($_SESSION['distributor_id'] )) {
	echo "<script>window.open('login.php?not_dist=sign in!','_self')</script>";
}

else{
	
?>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>OPTIMUM BEAUTY | Distributor</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="../css/slick.css" />
	<link type="text/css" rel="stylesheet" href="../css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="../css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="../css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="../css/style.css" />
	 <link type="text/css" rel="stylesheet" href="../css/checkout_style.css"/>

	

</head>

<body>
	<!-- HEADER -->
	
		

		<?php include("db.php");?>

       
       <header>
		<!-- top Header -->
		<div id="top-header">
			<div class="container">
				<div class="pull-left">
					 <?php

                if (isset($_SESSION['distributor_id'] )) {
                    include("../inc/db.php");
                   $dist_id = $_SESSION['distributor_id'] ;

                    $get_info = "select
                                       c.name as company_name
                                  from distributor d
                                       join company c on c.id = d.company_id

                                  where  d.id = ' $dist_id' ";

                    $run_name = mysqli_query($con, $get_info);



                    $row = mysqli_fetch_array($run_name);

                    $company_name = $row['company_name'];

                    echo "<span>Добро пожаловать  в OPTIMUM BEAUTY   :    </span>" . $company_name . "<span></span>";



                } else {
                    echo "<b>Добро пожаловать Гость</b>";
                }

                ?>
					
				</div>
				<div class="pull-right">
					<ul class="header-top-links">
                    <?php

                    if (!isset($_SESSION['distributor_id'])) {
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
					<div class="header-logo" style=" padding-left: 50px;">
						<a class="logo" href="index.php">
							<img src="../img/logo.png" alt="">
						</a>
					</div>
					<!-- /Logo -->

					
					
				</div>
				<div class="pull-right">
					<ul class="header-btns">
						<!-- Account -->
						<li class="header-account dropdown default-dropdown">
							<div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-user-o"></i>
								</div>
								<strong class="text-uppercase"> Личный кабинет <i class="fa fa-caret-down"></i></strong>
							</div>
							
							
							<ul class="custom-menu">
								<li><a href="my_account.php"><i class="fa fa-user-o"></i> Личный кабинет</a></li>
								
								<li><a href="logout.php"><i class="fa fa-unlock-alt"></i> Выити</a></li>
								
							</ul>
						</li>
						<!-- /Account -->

						

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
					<span class="category-header">Личный кабинет <i class="fa fa-list"></i></span>
					<ul class="category-list">
						<?php
                           $dist_id = $_SESSION['distributor_id'];



						      	$get_company_name = "select * from company where id = '$dist_id'";

						      	$run_company = mysqli_query($con, $get_company_name);

						      	while ($rows = mysqli_fetch_array($run_company) ){
						      		$company_name = $rows['name'];

                           }
                       

						?>


						<div class="category-nav show-on-click">
							<span class="category-header">панель управления<i class="fa fa-list"></i></span>
							<ul class="category-list">
								
								<li><a href="index.php?view_orders">Просмотреть все заказы</a></li>
								
								
								<li><a href="index.php?view_products">Просмотреть все мои товары</a></li>
								<li><a href="logout.php">Выход из системы</a></li>
							</ul>
						</div>
						
					</ul>
				</div>
				<!-- /category nav -->

				<!-- menu nav -->
				<div class="menu-nav">
					<span class="menu-header">Menu <i class="fa fa-bars"></i></span>
					<ul class="menu-list">
					
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
				<li><a href="index.php">Главная</a></li>
				<li class="active">Личный кабинет</li>
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
		
		
		<h2 style="text-align: center;">Добро пожаловать : <?php echo $company_name ;  ?></h2>
		<p style="text-align: center;">Вы можете видеть ход выполнения заказов, нажав   <a href="index.php?view_orders"><b>ЗДЕСЬ</b></a></p>
		
		
	</div>
	<!-- /section -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<?php  include("inc_distributor/footer.php"); ?>


	<?php } ?>

	

