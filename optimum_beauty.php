<!DOCTYPE html>
<?php
    session_start();
    include 'inc/db.php';
    include 'inc/functions.php';
    
    //for not acceessing this page by another person who is not in admin
    
    if (!isset($_SESSION['customer_id'])) {
    echo "<script>window.open('customer/customer_login.php?not_admin=You are not signed in!','_self')</script>";
    }
    
    else{
    
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
        <!-- HEADER -->
        <?php include("inc/headers.php"); ?>
        <!-- /HEADER -->
        <!-- NAVIGATION -->
        <?php include("inc/navigation.php"); ?>
        <!-- /NAVIGATION -->
        <!-- HOME -->
        <div id="home">
            <!-- container -->
            <div class="container">
                <!-- home wrap -->
                <div class="home-wrap">
                    <!-- home slick -->
                    <div id="home-slick">
                        <!-- banner -->
                        <div class="banner banner-1">
                            <img src="img/banner01.jpg" alt="">
                            <div class="banner-caption text-center">
                                <h1 style="color: #800080;">Optimum Beauty</h1>
                                <h3 class="white-color font-weak">Up to 50% Discount</h3>
                                <button class="primary-btn">Shop Now</button>
                            </div>
                        </div>
                        <!-- /banner -->
                        <!-- banner -->
                        <div class="banner banner-1">
                            <img src="img/banner02.jpg" alt="">
                            <div class="banner-caption">
                                <h1 class="primary-color">HOT DEAL<br><span
                                    class="white-color font-weak">Up to 50% OFF</span></h1>
                                <button class="primary-btn">Shop Now</button>
                            </div>
                        </div>
                        <!-- /banner -->
                        <!-- banner -->
                        <div class="banner banner-1">
                            <img src="./img/banner03.jpg" alt="">
                            <div class="banner-caption">
                                <h1 class="white-color">New Product <span>Collection</span></h1>
                                <button class="primary-btn">Shop Now</button>
                            </div>
                        </div>
                        <!-- /banner -->
                    </div>
                    <!-- /home slick -->
                </div>
                <!-- /home wrap -->
            </div>
            <!-- /container -->
        </div>
        <!-- /HOME -->
        <!-- section -->
        <div class="section">
            <div id="products_box">
                <?php cart(); ?>
            </div>
            <br>
        </div>
        <!-- /section -->
        <!-- section -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- section title -->
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2 class="title">Наши дистрибьюторы</h2>
                            <div class="pull-right">
                                <div class="product-slick-dots-2 custom-dots"></div>
                            </div>
                        </div>
                    </div>
                    <!-- section title -->
                    <!-- Product Single -->
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="product product-single product-hot">
                            <div class="product-thumb">
                                <div class="product-label">
                                </div>
                                <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                                <img src="img/logo1.jpg" alt="">
                            </div>
                            <div class="product-body">
                                <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o empty"></i>
                                </div>
                                <div class="product-btns">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Product Single -->
                    <!-- Product Slick -->
                    <div class="col-md-9 col-sm-6 col-xs-6">
                        <div class="row">
                            <div id="product-slick-2" class="product-slick">
                                <!-- Product Single -->
                                <div class="product product-single">
                                    <div class="product-thumb">
                                        <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view
                                        </button>
                                        <img src="./img/d1.png" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-price" style="width: 300px;">Индустрия Красоты</h3>
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o empty"></i>
                                        </div>
                                        <h2 class="product-name"><a href="#">Дистрибьютор</a></h2>
                                        <div class="product-btns">
                                            <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                            <input type="submit" class="primary-btn add-to-cart" style="width: 120px; float: right; color: white;" value="Продукты" onclick="industrial_beauty()">
                                            <script type="text/javascript">
                                                function industrial_beauty() {
                                                window.location = "customer/industrial_beauty.php";
                                                }
                                            </script>                         
                                        </div>
                                    </div>
                                </div>
                                <!-- /Product Single -->
                                <!-- Product Single -->
                                <div class="product product-single">
                                    <div class="product-thumb">
                                        <div class="product-label">
                                            <span class="sale">-20%</span>
                                        </div>
                                        <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view
                                        </button>
                                        <img src="img/d2.jpg" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-price">Эстетик
                                            <del class="product-old-price"></del>
                                        </h3>
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o empty"></i>
                                        </div>
                                        <h2 class="product-name"><a href="#">Дистрибьютор</a></h2>
                                        <div class="product-btns">
                                            <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                            <input type="submit" class="primary-btn add-to-cart" style="width: 120px; float: right; color: white;" value="Продукты" onclick="estetik()">
                                            <script type="text/javascript">
                                                function estetik() {
                                                window.location = "customer/estetik.php";
                                                }
                                            </script>           
                                        </div>
                                    </div>
                                </div>
                                <!-- /Product Single -->
                                <!-- Product Single -->
                                <div class="product product-single">
                                    <div class="product-thumb">
                                        <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view
                                        </button>
                                        <img src="img/d3.jpg" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-price">COSCO</h3>
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o empty"></i>
                                        </div>
                                        <h2 class="product-name"><a href="#">Дистрибьютор</a></h2>
                                        <div class="product-btns">
                                            <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                            <input type="submit" class="primary-btn add-to-cart" style="width: 120px; float: right; color: white;" value="Продукты" onclick="cosco()">
                                            <script type="text/javascript">
                                                function cosco() {
                                                window.location = "customer/cosco.php";
                                                }
                                            </script>                                        
                                        </div>
                                    </div>
                                </div>
                                <!-- /Product Single -->
                                <!-- Product Single -->
                                <div class="product product-single">
                                    <div class="product-thumb">
                                        <div class="product-label">
                                            <span>New</span>
                                            <span class="sale">-20%</span>
                                        </div>
                                        <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view
                                        </button>
                                        <img src="img/d4.jpg" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-price">ПрофКосМатериалы
                                            <del class="product-old-price"></del>
                                        </h3>
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o empty"></i>
                                        </div>
                                        <h2 class="product-name"><a href="#">Дистрибьютор</a></h2>
                                        <div class="product-btns">
                                            <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                            <input type="submit" class="primary-btn add-to-cart" style="width: 120px; float: right; color: white;" value="Продукты" onclick="profcosmaterial()">
                                            <script type="text/javascript">
                                                function profcosmaterial() {
                                                window.location = "customer/profcosmaterial.php";
                                                }
                                            </script>           
                                        </div>
                                    </div>
                                </div>
                                <!-- /Product Single -->
                                <!-- Product Single -->
                                <div class="product product-single">
                                    <div class="product-thumb">
                                        <div class="product-label">
                                            <span>New</span>
                                            <span class="sale">-20%</span>
                                        </div>
                                        <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view
                                        </button>
                                        <img src="img/d5.jpg" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-price">MeSoProff
                                            <del class="product-old-price"></del>
                                        </h3>
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o empty"></i>
                                        </div>
                                        <h2 class="product-name"><a href="#">Дистрибьютор</a></h2>
                                        <div class="product-btns">
                                            <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                            <input type="submit" class="primary-btn add-to-cart" style="width: 120px; float: right; color: white;" value="Продукты" onclick="mesoproff()">
                                            <script type="text/javascript">
                                                function mesoproff() {
                                                window.location = "customer/mesoproff.php";
                                                }
                                            </script>           
                                        </div>
                                    </div>
                                </div>
                                <!-- /Product Single -->
                                <!-- Product Single -->
                                <div class="product product-single">
                                    <div class="product-thumb">
                                        <div class="product-label">
                                            <span>New</span>
                                            <span class="sale">-20%</span>
                                        </div>
                                        <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view
                                        </button>
                                        <img src="img/bm.jpg" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-price">Бьюти Маркет
                                            <del class="product-old-price"></del>
                                        </h3>
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o empty"></i>
                                        </div>
                                        <h2 class="product-name"><a href="#">Дистрибьютор</a></h2>
                                        <div class="product-btns">
                                            <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                            <input type="submit" class="primary-btn add-to-cart" style="width: 120px; float: right; color: white;" value="Продукты" onclick="profcosmaterial()">
                                            <script type="text/javascript">
                                                function profcosmaterial() {
                                                    window.location = "customer/profcosmaterial.php";
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Product Single -->
                                <!-- Product Single -->
                                <div class="product product-single">
                                    <div class="product-thumb">
                                        <div class="product-label">
                                            <span>New</span>
                                            <span class="sale">-20%</span>
                                        </div>
                                        <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view
                                        </button>
                                        <img src="img/bes.jpg" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-price">BES <small>RUSSIA</small>
                                            <del class="product-old-price"></del>
                                        </h3>
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o empty"></i>
                                        </div>
                                        <h2 class="product-name"><a href="#">Дистрибьютор</a></h2>
                                        <div class="product-btns">
                                            <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                            <input type="submit" class="primary-btn add-to-cart" style="width: 120px; float: right; color: white;" value="Продукты" onclick="profcosmaterial()">
                                            <script type="text/javascript">
                                                function profcosmaterial() {
                                                    window.location = "customer/profcosmaterial.php";
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Product Single -->
                            </div>
                        </div>
                    </div>
                    <!-- /Product Slick -->
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /section -->
        <!-- FOOTER -->
        <footer id="footer" class="section section-grey">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- footer widget -->
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="footer">
                            <!-- footer logo -->
                            <div class="footer-logo" style=" padding-left: 50px;">
                                <a class="logo" href="#">
                                <img src="img/logo.png" alt="">
                                </a>
                            </div>
                            <!-- /footer logo -->
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna
                            </p>
                            <!-- footer social -->
                            <ul class="footer-social">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            </ul>
                            <!-- /footer social -->
                        </div>
                    </div>
                    <!-- /footer widget -->
                    <!-- footer widget -->
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-header">My Account</h3>
                            <ul class="list-links">
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">My Wishlist</a></li>
                                <li><a href="#">Compare</a></li>
                                <li><a href="#">Checkout</a></li>
                                <li><a href="#">Login</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /footer widget -->
                    <div class="clearfix visible-sm visible-xs"></div>
                    <!-- footer widget -->
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-header">Customer Service</h3>
                            <ul class="list-links">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Shiping & Return</a></li>
                                <li><a href="#">Shiping Guide</a></li>
                                <li><a href="#">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /footer widget -->
                    <!-- footer subscribe -->
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-header">Stay Connected</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                            <form>
                                <div class="form-group">
                                    <input class="input" placeholder="Enter Email Address">
                                </div>
                                <button class="primary-btn">Join Newslatter</button>
                            </form>
                        </div>
                    </div>
                    <!-- /footer subscribe -->
                </div>
                <!-- /row -->
                <hr>
                <!-- row -->
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 text-center">
                        <!-- footer copyright -->
                        <div class="footer-copyright">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                            All rights reserved | Designed <i class="fa fa-heart-o" aria-hidden="true"></i> by 
                            <a href="#" target="_blank">Daniel</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </div>
                        <!-- /footer copyright -->
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </footer>
        <!-- /FOOTER -->
        <!-- jQuery Plugins -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/nouislider.min.js"></script>
        <script src="js/jquery.zoom.min.js"></script>
        <script src="js/main.js"></script>
        <script src="js/checkout.js"></script>
        <script src="js/intro.js"></script>
        <script src="js/jquery.confirm.js"></script>
        <script src="js/jquery.confirm.min.js"></script>
        <script src="js/rwd-table.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!--<script src="js/global.js"></script>-->
        <script>
            $(function () {
            $('#bs-deps').on('hide.bs.collapse show.bs.collapse', function () {
            $('#bs-deps-toggle').children('span').toggleClass('fa-chevron-down').toggleClass('fa-chevron-up');
            })
            });
        </script>
        
        <?php  } ?>