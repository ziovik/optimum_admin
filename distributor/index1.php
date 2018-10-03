<?php

session_start();
include("../inc/db.php");
include("inc_distributor/functions.php");


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
	<link type="text/css" rel="stylesheet" href="../css/table.css" />
	 <link type="text/css" rel="stylesheet" href="../css/checkout_style.css"/>
	 <link type="text/css" rel="stylesheet" href="../css/chat.css" />
	 <link type="text/css" rel="stylesheet" href="../css/envelope_animate.css" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
   

	<script
			  src="https://code.jquery.com/jquery-3.3.1.js"
			  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
			  crossorigin="anonymous">
  	
  </script>

	

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
                <div style="padding-left: 100px;" class="pull-right">
                    <ul class="header-btns">
                        <!-- Account -->

                        <!-- /Account -->
                        <!-- Cart -->
                        <li class="header-cart dropdown default-dropdown">

                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <div class="header-btns-icon">
                                    <i class="fa fa-archive"></i>
                                    <span class="qty">0</span>
                                </div>
                                <strong onClick="goOrders()" class="text-uppercase">Заказы:</strong>
                                <script type="text/javascript">
                                    function goOrders() {
                                        window.location = "order_distributor.php";
                                    }
                                </script>
                                <br>
                                <span></span>
                            </a>

                        </li>
                        <li class="header-cart dropdown default-dropdown">

                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <div class="header-btns-icon">
                                    <i class="fa fa-envelope-o" ></i>
                                    <span class="qty"><?php echo message_count(); ?></span>
                                </div>

                                <strong onClick="customerMessage()" class="text-uppercase">Сообщение</strong>
                                <script type="text/javascript">
                                    function customerMessage() {
                                        window.location = "customers_messages.php";
                                    }
                                </script>
                                <br>
                                <span></span>
                            </a>

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






						<!-- row -->
						<div class="row"><br><br>
							<h2 style="color: #800080; text-align: center;"><?php  echo @$_GET['logged_in']; ?></h2>


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

							   if (isset($_GET['customer_id'])) {
							  	include("chat.php");
							  }
							  if (isset($_GET['accept_all'])) {
							  	include("accept_all.php");
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

	<?php include("inc_distributor/footer.php")  ?>

	<?php } ?>

	
<?php
	include("../inc/db.php");

if (isset($_GET['seen_order'])) {
  
  $get_id = $_GET['seen_order'];

  $status = 'Смотрел';

   
   $update_product_item = "update product_item set onscreen_status= '$status' where id = '$get_id'";
   $run = mysqli_query($con,$update_product_item);


  if($run){
    echo "<script>alert('Вы заказ посмотрели')</script>";
    echo "<script>window.open('index1.php?view_orders','_self')</script>";
  }
  


}
?>

<?php
	include("../inc/db.php");

if (isset($_GET['confirm_order'])) {
  
  $get_id = $_GET['confirm_order'];

  $status = 'Принял';

 
   $update_product_item = "update product_item set onscreen_status= '$status' where id = '$get_id'";
   $run = mysqli_query($con,$update_product_item);

   

  if($run){
    echo "<script>alert('Вы заказ приняли')</script>";
    echo "<script>window.open('index1.php?view_orders','_self')</script>";
  }


}
?>

<?php
	include("../inc/db.php");

if (isset($_GET['reject_order'])) {
  
  $get_id = $_GET['reject_order'];

  $status = 'Отказ';



   $update_product_item = "update product_item set onscreen_status= '$status' where id = '$get_id'";
   $run = mysqli_query($con,$update_product_item);

  if($run){
    echo "<script>alert('Заказ отказана')</script>";
    echo "<script>window.open('index1.php?view_orders','_self')</script>";
  }


}
?>




