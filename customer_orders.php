<?php
session_start();

include("inc/db.php");
include("inc/functions.php");
include("inc/db_functions.php");
include_once "db_objects/ProductItem.php";


if (!isset($_SESSION['customer_id'])) {
    echo "<script>window.open('customer/customer_login.php?not_admin=You are not signed in!','_self')</script>";
} else {
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
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="css/slick.css"/>
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>
    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="css/style.css"/>
    <link type="text/css" rel="stylesheet" href="css/table.css"/>
    <link type="text/css" rel="stylesheet" href="css/checkout_style.css"/>
    <!--table resp-->
    <link rel="stylesheet" href="css/rwd-table.min.css">

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
<?php include("inc/headers.php"); ?>
<!-- NAVIGATION -->
<?php include("inc/navigation_dropdown.php"); ?>
<!-- /NAVIGATION -->
<!-- BREADCRUMB -->
<div id="breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="optimum_beauty.php">Главная</a></li>
            <li class="active">Корзина</li>
        </ul>
    </div>
</div>
<!-- /BREADCRUMB -->
<!-- section -->
<div id="home">
    <!-- container -->
    <div class="container">
        <!-- home wrap -->
        <div class="home-wrap">
            <!-- home slick -->
            <!-- row -->
            <div class="col-md-12">
            <div class="row">
                <!-- section -->
                <div class="section">
                    <input class="btn next-btn" type="submit" value="Моя Корзина"
                           onClick="window.location = 'cart.php';">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input class="btn next-btn" type="submit" value="История Заказов"
                           onClick="window.location = 'customer/my_account.php?view_orders_history';">


                </div>
            </div>
        </div>
        <!-- /row -->
            <div>
                <div style="clear:both"></div>
                <br/>

                <hr>
            </div>

        </div>
        <!-- /container -->
    </div>
    <!-- /section -->
    <?php include("inc/footer.php") ?>
    <?php } ?>
    <script>
        function deleteProductFromCart(id) {
            if (!confirm('Вы действительно хотите удалить продукт из корзины?')) {
                return;
            }

            let message = {'id': id};

            $.ajax({
                method: 'POST',
                url: 'customer/handlers/requests_handler.php?action=delete_product_from_cart',
                data: JSON.stringify(message),
                success() {
                    window.open("cart.php", "_self");
                    alert('Продукт был удален из корзины');
                }
            });
        }
    </script>