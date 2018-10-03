<script>
    let currProId = null, currProName = null;
    function loadProductData(product) {
        $('#product_name').text(product.name); /*name - is the field in Product class*/
        $('#product_price').text(product.price); /*price is the same*/
        $('#product_manufacturer').text(product.manufacturer);
        $('#product_description').text(product.description);
        $('#min_order').text(product.min_quantity);
        $('#product_distributor').text(product.distributor);
    }
    function onProductClick(productId) {
        $.ajax({
            type: 'GET',
            url: 'modal_product.php?pro_id=' + productId,
            success: function (data) {
                loadProductData(JSON.parse(data))
            },
            error: function () {
                console.log('ERROR')
            }
        });
    }
</script>
<?php
    session_start();
    include("inc/db.php");
    include("inc/functions.php");
    include("inc/db_functions.php");
    include_once "db_objects/ProductItem.php";
    //for not acceessing this page by another person who is not in admin



    if (!isset($_SESSION['customer_id'])) {
    	echo "<script>window.open('customer/customer_login.php?not_admin=You are not signed in!','_self')</script>";
    }

    else{
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
        <link type="text/css" rel="stylesheet" href="css/modal.css"/>
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
        <header>
            <!-- top Header -->
            <div id="top-header">
                <div class="container">
                    <div class="pull-left">
                        <?php
                            if (isset($_SESSION['customer_id'])) {
                                $customer_id = $_SESSION['customer_id'];

                                $get_info = "select
                                                                 name from customer 
                                                            where  id = '$customer_id' ";

                                $run_name = mysqli_query($con, $get_info);

                                $row = mysqli_fetch_array($run_name);

                                $customer_name = $row['name'];

                                echo "<span>Добро пожаловать  в OPTIMUM BEAUTY   :    </span>" . $customer_name . "<span></span>";


                            } else {
                                echo "<b>Добро пожаловать Гость</b>";
                            }

                            ?>
                        <div style="padding-left: 200px;" class="pull-right">
                            <ul class="header-btns">
                                <!-- Account -->
                                <li class="header-account dropdown default-dropdown">
                                    <div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
                                        <div class="header-btns-icon">
                                            <i class="fa fa-user-o"></i>
                                        </div>
                                        <strong>Личный кабинет <i class="fa fa-caret-down"></i></strong>
                                    </div>
                                    <ul class="custom-menu">
                                        <li><a href="customer/index.php"><i class="fa fa-user-o"></i> личный кабинет</a></li>

                                        <li><a href="logout.php"><i class="fa fa-unlock-alt"></i> Выйти</a></li>
                                    </ul>
                                </li>
                                <!-- /Account -->
                                <!-- Cart -->
                                <li class="header-cart dropdown default-dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                        <div class="header-btns-icon">
                                            <i onClick="goCart()" class="fa fa-shopping-cart"></i>
                                            <span class="qty"><?php total_items(); ?></span>
                                        </div>
                                        <strong onClick="goCart()" class="text-uppercase">Мои Заказы:</strong>
                                        <script type="text/javascript">
                                            function goCart() {
                                                window.location = "customer_orders.php";
                                            }
                                        </script>
                                        <br>
                                        <span><?php total_price() ?></span>
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
                                if (!isset($_SESSION['customer_id'])) {
                                    echo "<button style='width:100px;' background:#800080; border-radius:5px;' class='btn next-btn'><a href='#' class='text-uppercase' style='color:#fff;'>Войти</a></buuton>";
                                } else {


                                    echo  '<input style="color: white; width:100px;" class="btn next-btn" type="submit" value="Выйти" onClick="logout()">';

                                }

                                ?>
                            <script type="text/javascript">
                                function logout() {
                                window.location = "logout.php";
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
                            <a class="logo" href="optimum_beauty.php">
                            <img src="img/logo.png" alt="">
                            </a>
                        </div>
                        <!-- /Logo -->

                    </div>
                    <!-- Search -->
                    <div class="header-search" style="padding-left: 100px;">
                        <div class="input-group">
                            <span class="input-group-addon">Пойск</span>
                            <input type="text" name="search_text" id="search_text" placeholder="искать продукт..."
                                   class="form-control" style="width: 500px; float: left;"/>
                        </div>
                    </div>
                    <!-- /Search -->

                </div>
                <!-- header -->
            </div>
            <!-- container -->
        </header>
        <!-- /HEADER -->
       <?php include("inc/navigation.php");  ?>
        <!-- HOME -->
        <div id="home">
            <!-- container -->
            <div class="container" style="min-height: 700px;">
                <!-- home wrap -->
                <div class="home-wrap" id="result">
                    <!-- home slick -->
                    <div>
                    </div>
                    <!-- /home slick -->
                </div>
                <!-- /home wrap -->
            </div>
            <!-- /container -->
        </div>
        <?php include("modal_product.php"); ?>
        <!-- /HOME -->
      <?php include("inc/footer.php") ; ?>
      <?php } ?>


        <script>
            $(document).ready(function () {

            	load_data();

            	function load_data(query) {
            		$.ajax({
            			url: "fetch.php",
            			method: "POST",
            			data: {query: query},
            			success: function (data) {
            				$('#result').html(data);
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


        <script>

            function checkProductInCart(productId) {
                let newQuantity = parseInt($('#product_quantity').val());
                let customerId = <?php echo $_SESSION["customer_id"]; ?>;

                if (customerId == undefined) {
                    console.log("Id покупателя не найдено в сессии");
                    return;
                }

                let message = {
                    'product_id': productId,
                    'customer_id': customerId
                };


                $.ajax({
                    method: 'POST',
                    url: 'customer/handlers/requests_handler.php?action=check_product_in_cart',
                    data: JSON.stringify(message),
                    success(data) {
                        data = JSON.parse(data);

                        if (data.quantity > 0) {
                            let result = confirm('Такой продукт уже есть в корзине. Вы хотите увеличить количество на '
                                + newQuantity + ' шт?');

                            if (result) {
                                updateProductQuantityInCart(data.id, parseInt(data.quantity) + newQuantity);
                            }
                        } else {
                            addProductToCart(productId, newQuantity, customerId);
                        }
                    },
                    error(data) {
                        console.log(data);
                    }
                });
            }

            function addProductToCart(productId, quantity, customerId) {
                let message = {
                    'product_id': productId,
                    'customer_id': customerId,
                    'product_quantity': quantity
                };

                $.ajax({
                    method: 'POST',
                    url: 'customer/handlers/requests_handler.php?action=add_to_cart',
                    data: JSON.stringify(message),
                    success() {
                        alert('Продукт был добален в корзину');
                        console.log('Продукт был добален в корзину');
                        location.reload();

                    }
                });
            }

            function updateProductQuantityInCart(id, quantity) {
                let message = {
                    'id': id,
                    'product_quantity': quantity
                };

                $.ajax({
                    method: 'POST',
                    url: 'customer/handlers/requests_handler.php?action=update_product_in_cart',
                    data: JSON.stringify(message),
                    success() {
                        alert('Количество продука обновлено в корзине');
                        console.log('Продукт обновлен в корзине');
                        location.reload();
                    }
                });
            }

            function validateProductMinQuantity() {
                let expectedQuantity = parseInt($('#min_order').text());
                let actualQuantity = parseInt($('#product_quantity').val());

                if (actualQuantity < expectedQuantity) {
                    alert("Минимальное количество продукта должно быть больше или равно " + expectedQuantity);
                    $('#product_quantity').val(expectedQuantity);
                    return false;
                }

                return true;
            }

            function validateProductQuantity() {
                return validateProductMinQuantity();
            }

            $(document).ready(function () {
                $('#add_to_cart_btn').on('click', function () {
                    let productId = $('#product_id').val();

                    if (validateProductQuantity()) {
                        checkProductInCart(productId);
                    }
                });
            });
        </script>

