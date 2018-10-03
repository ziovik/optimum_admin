<!-- HEADER -->
        <header>
            <!-- top Header -->
            <div id="top-header">
                <div class="container">
                    <div class="pull-left">
                        <?php
                            if (isset($_SESSION['customer_id'])) {
                            	include("inc/db.php");
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

                <!-- header -->
            </div>
            <!-- container -->
        </header>
        <!-- /HEADER -->