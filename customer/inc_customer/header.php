<!-- HEADER -->
        <header>
            <!-- top Header -->
            <div id="top-header">
                <div class="container">
                    <div class="pull-left">
                        <?php
                            if (isset($_SESSION['customer_id'])) {
                            	include("../inc/db.php");
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
                        <a class="logo" href="../optimum_beauty.php">
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
                                <strong>Личный кабинет <i class="fa fa-caret-down"></i></strong>
                            </div>
                            <ul class="custom-menu">
                                <li><a href="index.php"><i class="fa fa-user-o"></i> Личный кабинет </a></li>
                                <li><a href="../payment.php"><i class="fa fa-check"></i> Выписываться</a></li>
                                <li><a href="logout.php"><i class="fa fa-unlock-alt"></i>Выити</a></li>
                            </ul>
                        </li>
                        <!-- /Account -->
                        <!-- Cart -->
                        <li class="header-cart dropdown default-dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <div class="header-btns-icon">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="qty"><?php total_items(); ?></span>
                                </div>
                                <strong class="text-uppercase">Мои Заказы:</strong>
                                <br>
                                <span><?php total_price() ?></span>
                            </a>
                            <div class="custom-menu">
                                <div id="shopping-cart">
                                    <div class="shopping-cart-list">
                                    </div>
                                    <div class="shopping-cart-btns">
                                        <div class="shopping-cart-btns">
                                            <a href="../cart.php">
                                            <button class="main-btn">заказы</button>
                                            </a>
                                            <a href="../payment.php">
                                            <button class="primary-btn">Выписываться <i class="fa fa-arrow-circle-right"></i>
                                            </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
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
                <!-- header -->
            </div>
            <!-- container -->
        </header>
        <!-- /HEADER -->