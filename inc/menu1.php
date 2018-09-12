<span class="category-header">Категории <i class="fa fa-list"></i></span>
<ul class="category-list">
	<li class="dropdown side-dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="cosm">Косметология <i class="fa fa-angle-right"></i></a>
		<div class="custom-menu">
			<div class="row">
				<div class="col-md-4">
					<ul class="list-links">
						<li><h3 class="list-links-title"><a href="products/allcosm.php?allcosm=1" name="allcosm">Косметология</a>  </h3></li>

						<?php
						if (!isset($_GET['cosm'])) {


							$get_cosm = "select * from sub_category where category_id='1'";

							$run_cosm = mysqli_query($con, $get_cosm);


							while ($row_cosm  = mysqli_fetch_array($run_cosm)){

								$cosm_id= $row_cosm['id'];
								$cosm_name = $row_cosm['name'];

								echo " <li style='width:300px;'><a href='products/cosm.php?cosm=$cosm_id'>$cosm_name</a></li>";

							}



						}
						?>
					</ul>
					<hr class="hidden-md hidden-lg">
				</div>


			</div>
		</li>

		<li class="dropdown side-dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="depil">Депиляция <i class="fa fa-angle-right"></i></a>
			<div class="custom-menu">
				<div class="row">
					<div class="col-md-4">
						<ul class="list-links">

							<?php
							if (!isset($_GET['depil'])) {



								$get_depils = "select * from sub_category where category_id='2' ";
								$run_depils = mysqli_query($con, $get_depils );

								while ($row_depils  = mysqli_fetch_array($run_depils)){
									$depil_id = $row_depils['id'];
									$depil_name = $row_depils['name'];

									echo " <li style='width:300px;'><a href='products/depil.php?depil=$depil_id'>$depil_name</a></li>";
								}
							}
							?>


						</ul>
						<hr class="hidden-md hidden-lg">
					</div>


				</div>
			</li>

			<li class="dropdown side-dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="solar">Солярий <i class="fa fa-angle-right"></i></a>
				<div class="custom-menu">
					<div class="row">
						<div class="col-md-4">
							<ul class="list-links">

								<?php
								if (!isset($_GET['solar'])) {



									$get_solars = "select * from sub_category where category_id='3' ";
									$run_solars = mysqli_query($con, $get_solars );

									while ($row_solars  = mysqli_fetch_array($run_solars)){
										$solar_id = $row_solars['id'];
										$solar_name = $row_solars['name'];

										echo " <li style='width:300px;'><a href='products/solar.php?solar=$solar_id'>$solar_name</a></li>";
									}
								}
								?>


							</ul>
							<hr class="hidden-md hidden-lg">
						</div>


					</div>
				</li>

				<li class="dropdown side-dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="massag">Массаж <i class="fa fa-angle-right"></i></a>
					<div class="custom-menu">
						<div class="row">
							<div class="col-md-4">
								<ul class="list-links">

									<?php
									if (!isset($_GET['massag'])) {



										$get_massags = "select * from sub_category where category_id='4' ";
										$run_massags = mysqli_query($con, $get_massags );

										while ($row_massags  = mysqli_fetch_array($run_massags)){
											$massag_id = $row_massags['id'];
											$massag_name = $row_massags['name'];

											echo " <li style='width:300px;'><a href='products/massag.php?massag=$massag_id'>$massag_name</a></li>";
										}
									}
									?>


								</ul>
								<hr class="hidden-md hidden-lg">
							</div>


						</div>
					</li>


					<li class="dropdown side-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="par">Парикмахерская Продукция <i class="fa fa-angle-right"></i></a>
						<div class="custom-menu">
							<div class="row">
								<div class="col-md-4">
									<ul class="list-links">
										<li>
											<h3 class="list-links-title" style="width: 300px;"><a href="products/allparak.php?allpar=5" name="allnail">Парикмахерская Продукция</a>  </h3></li>
											<?php
											if (!isset($_GET['par'])) {

												$get_pars = "select * from sub_category where category_id='5' ";
												$run_pars = mysqli_query($con, $get_pars );

												while ($row_pars  = mysqli_fetch_array($run_pars)){
													$par_id = $row_pars['id'];
													$par_name = $row_pars['name'];



													echo " <li style='width:300px;'><a href='products/parak.php?par=$par_id'>$par_name</a></li>";
												}
											}
											?>

										</ul>
										<hr>

										<hr class="hidden-md hidden-lg">
									</div>


								</div>
							</li>

							<li class="dropdown side-dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="nail">Ногтевой сервис <i class="fa fa-angle-right"></i></a>
								<div class="custom-menu">
									<div class="row">
										<div class="col-md-4">
											<ul class="list-links">
												<li>
													<h3 class="list-links-title"><a href="products/allnail.php?allnail=6" name="allnail">Ногтевой сервис</a>  </h3></li>

													<?php
													if (!isset($_GET['nail'])) {


														$get_nails = "select * from sub_category where category_id='6' ";
														$run_nails = mysqli_query($con, $get_nails );

														while ($row_nails  = mysqli_fetch_array($run_nails)){
															$nail_id = $row_nails['id'];
															$nail_name = $row_nails['name'];

															echo " <li style='width:300px;'><a href='products/nail.php?nail=$nail_id'>$nail_name</a></li>";
														}
													}
													?>

												</ul>
												<hr>

												<hr class="hidden-md hidden-lg">
											</div>


										</div>
									</div>
								</li>

								<li class="dropdown side-dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="eye">Ресницы и брови<i class="fa fa-angle-right"></i></a>
									<div class="custom-menu">
										<div class="row">
											<div class="col-md-4">
												<ul class="list-links">
													<li>
														<h3 class="list-links-title"><a href="products/alleye.php?alleye=7" name="allnail">Ресницы и брови</a>  </h3></li>

														<?php
														if (!isset($_GET['eye'])) {


															$get_eye = "select * from sub_category where category_id='7' ";
															$run_eye = mysqli_query($con, $get_eye );

															while ($row_eye  = mysqli_fetch_array($run_eye)){
																$eye_id = $row_eye['id'];
																$eye_name = $row_eye['name'];

																echo " <li style='width:300px;'><a href='products/eye.php?eye=$eye_id'>$eye_name</a></li>";
															}
														}
														?>

													</ul>
													<hr class="hidden-md hidden-lg">
												</div>

											</div>

										</div>
									</li>
									<li class="dropdown side-dropdown">
										<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="viz">Визаж<i class="fa fa-angle-right"></i></a>
										<div class="custom-menu">
											<div class="row">
												<div class="col-md-4">
													<ul class="list-links">
														<li>
															<h3 class="list-links-title"><a href="products/allviz.php?allviz=8" name="allviz">Визаж</a>  </h3></li>
															<?php
															if (!isset($_GET['viz'])) {


																$get_viz = "select * from sub_category where category_id='8' ";
																$run_viz = mysqli_query($con, $get_viz );

																while ($row_viz  = mysqli_fetch_array($run_viz)){
																	$viz_id = $row_viz['id'];
																	$viz_name = $row_viz['name'];

																	echo " <li style='width:500px;'><a href='products/viz.php?viz=$viz_id'>$viz_name</a></li>";
																}
															}
															?>
														</ul>
														<hr class="hidden-md hidden-lg">
													</div>

												</div>

											</div>
										</li>
										<li class="dropdown side-dropdown">
											<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="tatu">Татуаж и пирсинг<i class="fa fa-angle-right"></i></a>
											<div class="custom-menu">
												<div class="row">
													<div class="col-md-4">
														<ul class="list-links">

															<li>
																<h3 class="list-links-title"><a href="products/alltatu.php?alltatu=9" name="alltatu">Татуаж и пирсинг</a>  </h3></li>
																<?php
																if (!isset($_GET['tatu'])) {


																	$get_tatu = "select * from sub_category where category_id='9' ";
																	$run_tatu = mysqli_query($con, $get_tatu );

																	while ($row_tatu  = mysqli_fetch_array($run_tatu)){
																		$tatu_id = $row_tatu['id'];
																		$tatu_name = $row_tatu['name'];

																		echo " <li style='width:500px;'><a href='products/tatu.php?tatu=$tatu_id'>$tatu_name</a></li>";
																	}
																}
																?>
															</ul>
															<hr class="hidden-md hidden-lg">
														</div>

													</div>

												</div>
											</li>
											<li class="dropdown side-dropdown">
												<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="mat">Расходники<i class="fa fa-angle-right"></i></a>
												<div class="custom-menu">
													<div class="row">
														<div class="col-md-4">
															<ul class="list-links">

																<li>
																	<h3 class="list-links-title"><a href="products/allmat.php?allmat=10" name="allmat">Расходники</a>  </h3></li>
																	<?php
																	if (!isset($_GET['mat'])) {


																		$get_mat = "select * from sub_category where category_id='10' ";
																		$run_mat = mysqli_query($con, $get_mat );

																		while ($row_mat  = mysqli_fetch_array($run_mat)){
																			$mat_id = $row_mat['id'];
																			$mat_name = $row_mat['name'];

																			echo " <li style='width:500px;'><a href='products/mat.php?mat=$mat_id'>$mat_name</a></li>";
																		}
																	}
																	?>
																</ul>
																<hr class="hidden-md hidden-lg">
															</div>

														</div>

													</div>
												</li>
												<li class="dropdown side-dropdown">
													<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" name="ster">Стерилизация и дезинфекция<i class="fa fa-angle-right"></i></a>
													<div class="custom-menu">
														<div class="row">
															<div class="col-md-4">
																<ul class="list-links">

																	<li style="width: 300px;">
																		<h3 class="list-links-title"><a href="products/allster.php?allster=11" name="allster">Стерилизация и дезинфекция</a>  </h3></li>
																		<?php
																		if (!isset($_GET['ster'])) {


																			$get_ster = "select * from sub_category where category_id='11' ";
																			$run_ster = mysqli_query($con, $get_ster );

																			while ($row_ster  = mysqli_fetch_array($run_ster)){
																				$ster_id = $row_ster['id'];
																				$ster_name = $row_ster['name'];

																				echo " <li style='width:500px;'><a href='products/ster.php?ster=$ster_id'>$ster_name</a></li>";
																			}
																		}
																		?>
																	</ul>
																	<hr class="hidden-md hidden-lg">
																</div>

															</div>

														</div>
													</li>

													<li><a href="all_products.php?all_products">Все продукты</a></li>
												</ul>
											</div>
											<!-- menu nav -->
											<div class="menu-nav">
												<span class="menu-header">Menu <i class="fa fa-bars"></i></span>
												<ul class="menu-list">

													<li id="center1" ><a href="all_products.php?all_products" title="живой пойск"></a></li>
												</ul>
											</div>
<!-- menu nav -->