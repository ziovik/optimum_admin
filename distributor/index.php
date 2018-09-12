<?php

session_start();
include("../inc/db.php");


if (!isset($_SESSION['distributor_id'])) {
	echo "<script>window.open('login.php?not_dist=sign in!','_self')</script>";
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

	<title>OPTIMUM BEAUTY | Distributor</title>

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
	<link type="text/css" rel="stylesheet" href="../css/envelope.css"/>
    <link type="text/css" rel="stylesheet" href="../css/intro.css" />



</head>

<body>

<header>
	<!-- top Header -->
	<div id="top-header">
		<div class="container">
			<div class="pull-left">
				<?php

				if (isset($_SESSION['distributor_id'])) {
					include("../inc/db.php");
					$dist_id = $_SESSION['distributor_id'];

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
						echo "<button style='width:100px; background:#800080; border-radius:5px;' class='btn next-btn'><a href='#' class='text-uppercase' style='color:#fff;'>Войти</a></button>";
					} else {

                        echo  '<input style="color: white; width:100px;" class="btn next-btn" type="submit" value="Выйти" onClick="logout()">';
                    }

                    ?>
                    <script type="text/javascript">
                        function logout() {
                            window.location = "../logout.php";
                        }
                    </script>
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
				<span class="category-header">панель управления<i class="fa fa-list"></i></span>
				<ul class="category-list">

					<li><a href="index1.php?view_orders">Просмотреть активные заказы</a></li>
					<li><a href="index1.php?view_orders_history">История все заказов</a></li>
					
					<li><a href="index1.php?view_products">Просмотреть все мои товары</a></li>
					<li><a href="index1.php?customers_list">Клиенты</a></li>
					<li><a href="logout.php">Выход из системы</a></li>
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
			<li><a href="#">Главная</a></li>
			<li class="active">Дистрибьютер</li>
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


				<!-- STORE -->
				<div id="store">



                    <?php

                    global $con;

                    if (isset($_SESSION['distributor_id'])) {



                        $dist_id= $_SESSION['distributor_id'];


                        $get = "select 

									com.name as company_name,
							        c.email as email,
							        c.telephone as telephone,
							        r.name as region_name,
							        a.index_code as index_code,
							        a.building as building,
							        a.house as house,
							        s.name as street


							from 
									distributor d

									join company com on com.id = d.company_id
									join contact c on c.id = d.contact_id
									join address a on a.id = d.address_id
									join region r on r.id = d.region_id
									join street s on s.id = a.street_id

							where d.id = '$dist_id' ";

                        $run = mysqli_query($con, $get);




                        while($rows = mysqli_fetch_array($run)) {

                            $distributor_name = $rows['company_name'];
                            $telephone = $rows['telephone'];
                            $email = $rows['email'];
                            $street = $rows['street'];
                            $region = $rows['region_name'];
                            $index_code = $rows['index_code'];
                            $building = $rows['building'];
                            $house = $rows['house'];

                        }     }

                    ?>

                    <br>
                    <br>

                    <div style="width: 800px; float: right;">
                        <input type="radio" name="nav" id="one" checked="checked"/>
                        <label for="one"><?php echo $distributor_name;  ?></label>

                        <input type="radio" name="nav" id="two"/>
                        <label for="two">Чем занимаемся</label>

                        <input type="radio" name="nav" id="three"/>
                        <label for="three">Контактное лицо</label>

                        <article class="content one">
                            <h3 style="text-align: center; color: white;"><?php echo $distributor_name;  ?></h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and .</p>
                        </article>

                        <article class="content two">
                            <h3 style="text-align: center; color: white;">Чем занимаемся</h3>
                            <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through 1.10.32.</p>

                        </article>

                        <article class="content three">
                            <h3 style="text-align: center; color: white;">Контактное лицо</h3>
                            <p>Телефон : <?php  echo $telephone; ?></p>
                            <p>Email : <?php  echo $email; ?></p>
                            <p>Адрес:  <?php  echo $region; ?>, <?php  echo $street; ?>,<?php  echo $house; ?>,<?php  echo $building; ?>, Россия.</p>
                        </article>
                    </div>

                    <br>
					<br>


					<!-- row -->
					<div class="row"><br><br>
						<h2 style="color: #800080; text-align: center;"><?php echo @$_GET['logged_in']; ?></h2>


						<?php


						if (isset($_GET['view_orders'])) {
							include("view_orders.php");
						}


						if (isset($_GET['view_orders_history'])) {
							include("view_orders_history.php");
						}

						if (isset($_GET['view_products'])) {
							include("view_products.php");
						}

						if (isset($_GET['check_order'])) {
							include("view_order_cust.php");
						}

						if (isset($_GET['check_order_history'])) {
							include("view_order_cust_history.php");
						}

						if (isset($_GET['customer_details'])) {
							include("customer_details.php");
						}

						if (isset($_GET['customers_list'])) {
							include("customers_list.php");
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

<?php include("inc_distributor/footer.php") ?>

<?php } ?>


<?php
include("../inc/db.php");

if (isset($_GET['seen_order'])) {

	$get_id = $_GET['seen_order'];

	$status = 'Смотрел';


	$update_product_item = "update product_item set onscreen_status= '$status' where id = '$get_id'";
	$run = mysqli_query($con, $update_product_item);


	if ($run) {
		echo "<script>confirm('Order was Updated')</script>";
		echo "<script>window.open('index.php?view_orders','_self')</script>";
	}


}
?>

<?php
include("../inc/db.php");

if (isset($_GET['confirm_order'])) {

	$get_id = $_GET['confirm_order'];

	$status = 'Принял';


	$update_product_item = "update product_item set onscreen_status= '$status' where id = '$get_id'";
	$run = mysqli_query($con, $update_product_item);


	if ($run) {
		echo "<script>confirm('Order was Updated')</script>";
		echo "<script>window.open('index.php?view_orders','_self')</script>";
	}


}
?>

<?php
include("../inc/db.php");

if (isset($_GET['reject_order'])) {

	$get_id = $_GET['reject_order'];

	$status = 'Отказ';


	$update_product_item = "update product_item set onscreen_status= '$status' where id = '$get_id'";
	$run = mysqli_query($con, $update_product_item);

	if ($run) {
		echo "<script>confirm('Order was Updated')</script>";
		echo "<script>window.open('index.php?view_orders','_self')</script>";
	}


}
?>


