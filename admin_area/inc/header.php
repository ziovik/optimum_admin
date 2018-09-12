<!-- HEADER -->
	<header>
		<!-- top Header -->
		<div id="top-header">
			<div class="container">
				<div class="pull-left">
					<span>Welcome to Admin</span>
				</div>
				
			</div>
		</div>
		<!-- /top Header -->

		<!-- header -->
		<div id="header">
			<div class="container">
				<div class="pull-left">
					<!-- Logo -->
					<div class="header-logo">
						<a class="logo" href="index1.php">
							<img src="../img/logo.png" alt="">
						</a>
					</div>
					<!-- /Logo -->

					
				</div>
				<div class="pull-right">
					<ul class="header-btns">
						
                       <?php
                                if (!isset($_SESSION['user_email'])) {
                                	echo "<button style='width:100px;' background:#800080; border-radius:5px;' class='btn next-btn'><a href='#' class='text-uppercase' style='color:#fff;'>Войти</a></buuton>";
                                } else {
                                	echo  '<input style="color: white; background:#800080; width:100px;" class="btn btn-success" type="submit" value="Выйти" onClick="logout()">';
                                
                                }
                                
                         ?>
                            <script type="text/javascript">
                                function logout() {
                                window.location = "logout.php";
                                }
                            </script>
						
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