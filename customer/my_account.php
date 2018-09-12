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
      <title>OPTIMUM BEAUTY</title>
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
      <link type="text/css" rel="stylesheet" href="../css/checkout_style.css" />
      <link type="text/css" rel="stylesheet" href="../css/chat.css" />
      <link type="text/css" rel="stylesheet" href="../css/table_chat.css" />
      <script
         src="https://code.jquery.com/jquery-3.3.1.js"
         integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
         crossorigin="anonymous"></script>
   </head>
   <body>
      <!-- HEADER -->
      <?php include("inc_customer/header.php");?>
      <!-- NAVIGATION -->
      <div id="navigation">
         <!-- container -->
         <div class="container">
            <div id="responsive-nav">
               <!-- category nav -->
               <div class="category-nav show-on-click">
                  <span class="category-header">Панель Управления<i class="fa fa-list"></i></span>
                  <ul class="category-list">
                     <?php
                        $customer_id = $_SESSION['customer_id'];
                        
                        $get_customer = "select 
                                             c.name as customer_name,
                                             r.name as region_name,
                                             a.index_code as index_code,
                                             a.building as building,
                                             a.house as house,
                                             con.email as email,
                                             con.telephone as telephone,
                                             s.name as street_name
                                         from customer c
                                          join region r on r.id = c.region_id
                                          join address a on a.id = c.address_id 
                                          join street s on s.id =a.street_id
                                          join contact con on con.id = c.contact_id
                                         where  c.id = '$customer_id' ";
                        
                        
                        
                        $run_name = mysqli_query($con, $get_customer);
                        
                        $row = mysqli_fetch_array($run_name);
                        
                        $customer_name = $row['customer_name'];
                        $region_name = $row['region_name'];
                        $building = $row['building'];
                        $index_code = $row['index_code'];
                        $house= $row['house'];
                        $email = $row['email'];
                        $telephone = $row['telephone'];
                        $street_name = $row['street_name'];
                        
                        
                        ?>
                     <li><a href="my_account.php?active_orders">Активный заказа  <i class="fa fa-spinner fa-spin" style="font-size:24px"></i></a></li>
                     <li><a href="my_account.php?my_history">История заказов  <i class="fa fa-history" style="font-size:26px"></i></a></li>
                     <li><a href="logout.php">Выити  <i class="fa fa-sign-out" style="font-size:24px"></i></a></li>
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
               <li><a href="../optimum_beauty.php">Главная</a></li>
               <li class="active">Личный Кабинет</li>
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
                  <?php
                     if (isset($_GET['my_orders'])) {
                     	include("my_orders.php");
                     }
                      if (isset($_GET['my_history'])) {
                     	include("my_history.php");
                     }
                      if (isset($_GET['active_orders'])) {
                     	include("active_orders.php");
                     }
                     if (isset($_GET['chat'])) {
                     	include("chat.php");
                     }
                     
                      
                     
                     ?>
               </div>
               <!-- /section -->
            </div>
            <!-- /row -->
         </div>
         <!-- /container -->
      </div>
      <!-- /section -->
      <?php  include("inc_customer/footer.php"); ?>
      <?php  }?>