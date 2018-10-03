<script>
    let currProId = null, currProName = null;
    function loadProductData(product) {
        $('#product_name').text(product.name); /*name - is the field in Product class*/
        $('#product_price').text(product.price); /*price is the same*/
        $('#product_manufacturer').text(product.manufacturer);
        $('#product_description').text(product.description);
        $('#min_quantity').text(product.min_quantity);
        $('#product_distributor').text(product.distributor);
    }
    function onProductClick(productId) {
        $.ajax({
            type: 'GET',
            url: '../modal_product.php?pro_id=' + productId,
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
include("../inc/db.php");
include("../inc/functions.php");
include("../inc/db_functions.php");
include_once "../db_objects/ProductItem.php";
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
        <title>OPTIMUM BEAUTY | PRODUCT</title>
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
        <link type="text/css" rel="stylesheet" href="../css/modal.css"/>
        <!--table resp-->
        <link rel="stylesheet" href="../css/rwd-table.min.css">

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
    <?php include("inc_products/header.php"); ?>
    <!-- HEADER -->
    <!-- NAVIGATION -->
    <?php include("inc_products/navigation.php"); ?>
    <!-- NAVIGATION -->
    <!-- BREADCRUMB -->
    <div id="breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="../optimum_beauty.php">Главная</a></li>
                <li class="active">Косметология</li>
            </ul>
        </div>
    </div>
    <!-- /BREADCRUMB -->
    <!-- HOME -->
    <div id="home">
        <!-- container -->
        <div class="container" style="min-height: 600px;">
            <!-- home wrap -->
            <div class="home-wrap">
                <!-- home slick -->
                <div>
                    <?php cart(); ?>
                    <!-- banner -->
                    <!-- <div class="banner banner-1"> -->
                    <!-- <div class="table-responsive" data-pattern="priority-columns"> -->
                    <br>
                    <h4>Выберите количество строк</h4>
                    <div class="form-group">
                        <select name="state" id="maxRows" class="form-control" style="width: 170px; height: 50px;">
                            <option value="5000">Показать все...</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                    <div style="overflow-x:auto;">
                        <table cellspacing="0" id='mytable'
                               class="table table-small-font table-bordered table-striped" style="width: 100%;">
                            <thead>
                            <tr>
                                <th colspan="1" data-priority="2">Дистрибьютор</th>
                                <th colspan="1" data-priority="3" style=" width: 500px;">Найменование</th>
                                <th colspan="1" data-priority="4">Производитель/<br>Страна производства</th>
                                <th colspan="1" data-priority="5">Цена</th>
                                <th colspan="1" data-priority="6">Годен до</th>
                                <th colspan="1" data-priority="7">Остаток</th>
                                <th colspan="1" data-priority="8">Примечание</th>
                            </tr>
                            </thead>
                            <?php
                            $i = 0;
                            if (isset($_GET['allcosm'])) {
                                $allcosm_id = $_GET['allcosm'];
                                $get_allcosm_pro =
                                    "select 
                                             p.id as product_id, 
                                             p.name as product_name, 
                                             p.manufacturer as product_manufacturer,
                                             st.price as product_price, 
                                             st.min_order as product_min_order,
                                             p.expires as expires,
                                             p.description as discription,
                                             p.discount as discount,
                                             cm.name as company_name
                                             
                                        from
                                           store s
                                           join distributor d on d.id = s.distributor_id
                                           join product p on p.distributor_id = d.id
                                           join customer c on c.region_id = s.region_id
                                           join company cm on cm.id = d.company_id
                                           join sub_category sb on sb.id = p.sub_category_id
                                           join category ct on ct.id = sb.category_id
                                           join store_item st on st.product_id = p.id
                                           
                                           where c.id ='$customer_id' and ct.id= '$allcosm_id'";
                                $run_allcosm_pro = mysqli_query($con, $get_allcosm_pro);
                                $count_allcosm = mysqli_num_rows($run_allcosm_pro);
                                if ($count_allcosm == 0) {
                                    echo "<h2 style='text-align:center;'>Нет продукта</h2>";
                                } else {
                                    while ($row_allcosm_pro = mysqli_fetch_array($run_allcosm_pro)) {
                                        $pro_id = $row_allcosm_pro['product_id'];
                                        $pro_name = $row_allcosm_pro['product_name'];
                                        $pro_manu = $row_allcosm_pro['product_manufacturer'];
                                        $pro_price = $row_allcosm_pro['product_price'];
                                        $pro_dist = $row_allcosm_pro['company_name'];
                                        $pro_min_order = $row_allcosm_pro['product_min_order'];
                                        $pro_expires = $row_allcosm_pro['expires'];
                                        $pro_desc = $row_allcosm_pro['discription'];
                                        $i++;
                                        ?>
                                        <tbody>
                                        <tr>
                                            <th data-priority="1"
                                                style="background: white; color: #400040;"><?php echo $pro_dist ?></th>
                                            <th data-priority="2" style="background: white; color: #400040; width: 500px;">
                                                <a href="#" style="max-width: 500px;" data-toggle="modal"
                                                   data-target="#myModal"
                                                   onclick="onProductClick(<?php echo $pro_id ?>)">
                                                    <?php echo $pro_name ?>
                                                </a>

                                            </th>
                                            <th data-priority="3"
                                                style="background: white; color: #400040;"><?php echo $pro_manu ?></th>
                                            <th data-priority="4"
                                                style="background: white; color: #400040;"><?php echo $pro_price ?></th>
                                            <th data-priority="5"
                                                style="background: white; color: #400040;"><?php echo $pro_expires ?></th>
                                            <th data-priority="5"
                                                style="background: white; color: #400040;"><?php echo $pro_min_order ?></th>
                                            <th data-priority="5"
                                                style="background: white; color: #400040;"><?php echo $pro_desc ?></th>
                                        </tr>
                                        </tbody>
                                        <?php
                                    }
                                }
                            } ?>
                        </table>
                        <div class="pagination-container" style="padding-left:300px; ">
                            <nav>
                                <ul class="pagination"></ul>
                            </nav>
                        </div>
                    </div>
                    <br>
                    <!-- </div> -->
                    <!-- </div> -->
                </div>
                <!-- /section -->
            </div>
        </div>
        <!-- /container -->
    </div>

    <div class="modal fade" id="myModal" role="dialog">
        <!-- modal dialog -->
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- modal header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="mohe">
                        <h4 class="modal-title" style="color:white;"> Подробность</h4>
                    </div>
                </div>
                <!-- end modal header-->
                <!-- modal body -->
                <div class="modal-body">
                    <form role="form" action="#" method="post">
                        <fieldset>
                            <legend><h2 class="product-name"
                                        style="text-align: justify; width:100%;font-size: 16px;">
                                    <span id="product_name"></span></h2>
                            </legend>
                            <div class="form-group col-xs-6">
                                <label for="name">Цена: </label>
                                <span id="product_price"></span>
                                <label>руб.</label>
                            </div>

                            <div class="form-group col-xs-6">
                                <label for="email"> минимальное количество: </label>
                                <span id="min_quantity"></span>
                                <div>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o empty"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-xs-6">
                                <label for="tel"> Количество:</label>
                                <div class="qty-input">

                                    <input id="product_id" type="hidden" name="product_id" value="<?php echo $pro_id;
                                    ?>">
                                    <input style="width: 100px;" id="min_quantity" class="input" type="number" name="product_quantity"
                                           value="1">
                                </div>
                            </div>

                            <div class="form-group col-xs-12">
                                <label for="text"> Дистрибьютор: </label>
                                <span id="product_distributor"></span>
                            </div><br>
                            <div class="form-group col-xs-12" >
                                <label for="text"> Производитель/Страна пройзводителя: </label>
                                <span  id="product_manufacturer"></span>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend> Примечание:</legend>

                            <div class="form-group col-xs-12">
                                <div class="product-btns"></div>

                                <div class="form-group col-xs-12">
                                    <label for="comment">  </label>
                                    <textarea class="form-control" rows="5" id="product_description">

                                    </textarea>
                                </div>
                        </fieldset>
                    </form>
                </div>
                <!-- end modal body -->
                <!-- modal footer-->
                <div class="modal-footer">
                    <div class="mohe">

                        <button id="add_to_cart_btn" class="btn btn-default btn-md btn-sm" data-dismiss="modal"
                                style="width: 200px;">Добавить в корзину
                        </button>
                        <button type="submit" class="btn btn-default btn-md btn-sm" data-dismiss="modal"> отмена
                        </button>
                    </div>
                </div>
                <!-- end modal footer -->
            </div>
            <!-- end modal content-->
        </div>
        <!-- end modal dialog-->
    </div>

    <?php include("../modal_product.php"); ?>


    <!-- /section -->
    <?php include("inc_products/footer.php"); ?>
<?php } ?>

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
                url: '../customer/handlers/requests_handler.php?action=check_product_in_cart',
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
                url: '../customer/handlers/requests_handler.php?action=add_to_cart',
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
                url: '../customer/handlers/requests_handler.php?action=update_product_in_cart',
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