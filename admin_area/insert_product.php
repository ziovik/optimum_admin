<?php

session_start();

if (!isset($_SESSION['user_email'])) {
	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
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

	<title>OPTIMUM BEAUTY | ADMIN</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="css/slick.css" />
	<link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />
	<link type="text/css" rel="stylesheet" href="css/table.css" />
	<link type="text/css" rel="stylesheet" href="css/email.css" />

	<script type="text/javascript" src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
	<script >
		tinymce.init({selector:'textarea'});
	</script>

</head>

<body>
	<?php include("inc/header.php") ?>

	<!-- NAVIGATION -->
	<div id="navigation">
		<!-- container -->
		<div class="container">
			<div id="responsive-nav">
				<!-- category nav -->
				<div class="category-nav show-on-click">
					<span class="category-header">Manage Content<i class="fa fa-list"></i></span>
					<ul class="category-list">
						
						<li><a href="insert_product.php">Insert Product</a></li>
						<li><a href="index.php?view_products">View All Products</a></li>
						<li><a href="index.php?insert_cats">Insert New Category</a></li>
						<li><a href="index.php?view_cats">View All Categories</a></li>
						<li><a href="index.php?insert_sub_cat">Insert New Sub Categories</a></li>
						<li><a href="index.php?view_sub_cat">View All Sub Categories</a></li>
						<li><a href="index.php?insert_region">Insert New Region </a></li>
						<li><a href="index.php?view_region">View All Regions</a></li>
						<li><a href="index.php?view_customers">View All Customers</a></li>
						<li><a href="index.php?insert_customer">Insert New Customer</a></li>
						<li><a href="index.php?view_distributor">View All Distributors</a></li>
						<li><a href="index.php?insert_distributor">Insert New Distributors</a></li>
						<li><a href="index.php?view_orders">View Orders</a></li>
						<li><a href="index.php?email">Email</a></li>
						<li><a href="logout.php">Admin Logout</a></li>
						
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
				<li><a href="#">Home</a></li>
				<li class="active">Admin</li>
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
					
					<!-- /store top filter -->

					<!-- STORE -->
					<div id="store">
						<!-- row -->
						<div class="row"><br><br>
						  
<?php 
 
include ("../inc/db.php");
 ?>


	<form action="insert_product.php" method="post" enctype="multipart/form-data">
		<table align="center" width="100%" border="2" bgcolor="#F6F7F8">
			<h2 style="text-align: center;">Insert New Product here</h2>

			
			<tr>
				<td align="right"><b>Product Name:</b></td>
			    <td>
                    <textarea name="product_name" cols="20" rows="4" ></textarea>
				</td>
			</tr>
			
			<tr>
				<td align="right"><b>Product Sub Categories:</b></td>
				<td>
					<select name="product_sub_category">
						<option>Select  sub category</option>
						<?php
                            $get_sub_cats = "select * from sub_category";
	                        $run_sub_cats = mysqli_query($con, $get_sub_cats);

	                        while ($row_sub_cats = mysqli_fetch_array($run_sub_cats)){
		                       $sub_cat_id = $row_sub_cats['id'];
		                       $sub_cat_name = $row_sub_cats['name'];

		                       echo "<option value='$sub_cat_id'>$sub_cat_name</option>";
	                        }

						?>
					</select>
				</td>
			</tr>
			
			<tr>
				<td align="right"><b>Product Distributor :</b></td>
				<td>
					<select name="dist_id" required>
						<option>Select  Distributors</option>
						<?php
                            $get_dist = "select
                                           d.id as dist_id,
                                           com.name as dist_name
                                         from distributor d
                                              join company com on com.id = d.company_id";
	                        $run_dist = mysqli_query($con, $get_dist);

	                        while ($row_dist = mysqli_fetch_array($run_dist)){
		                       $dist_id = $row_dist['dist_id'];
		                       $dist_name = $row_dist['dist_name'];

		                       echo "<option value='$dist_id'>$dist_name</option>";
	                        }

						?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right"><b>Distributor Region :</b></td>
				<td>
					<select name="region_id" required>
						<option>Select  Distributors region</option>
						<?php

                            $sql = "select * from region ";
	                        $result = mysqli_query($con, $sql);
	                        while ($row = mysqli_fetch_array($result)){
		                       $region_id = $row['id'];
		                       $region_name = $row['name'];

		                       echo "<option value='$region_id'>$region_name</option>";
	                        }

						?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right"><b>Product Price:</b></td>
				<td><input type="text" name="product_price" required></td>
			</tr>

			<tr>
				<td align="right"><b>Product Description:</b></td>
				<td>
                    <textarea name="product_desc" cols="20" rows="10" ></textarea>
				</td>
			</tr>
			<tr>
				<td align="right"><b>Product Min Order:</b></td>
				<td><input type="text" name="min_order" size="20" required></td>
			</tr>
			<tr>
				<td align="right"><b>Product Max Order:</b></td>
				<td><input type="text" name="max_order" size="20" required></td>
			</tr>
			<tr>
				<td align="right"><b>Product Manufacturer:</b></td>
				<td><input type="text" name="product_manufacturer" size="80" required></td>
			</tr>
			
			<tr>
				<td align="right"><b>Product Discount:</b></td>
				<td><input type="text" name="discount" size="80" required></td>
			</tr>
			<tr>
				<td align="right"><b>Product Expiring Date:</b></td>
				<td><input type="text" name="expires" size="40" required></td>
			</tr>
				<tr>
				<td align="right"><b>Product Licence:</b></td>
				<td><input type="text" name="licence" size="40" required></td>
			</tr>
			<tr>
				<td align="right"><b>Product code:</b></td>
				<td><input type="text" name="code" size="40" required></td>
			</tr>
			<tr align="center">
				
				<td colspan="8"><input type="submit" name="insert_post" class="btn btn-success" value="Insert Now"></td>
			</tr>
		</table>
	</form>



<?php

  if (isset($_POST['insert_post'])) {
  	
  	//geting text data from form fields

  	$product_name = $_POST['product_name'];
    $region_id = $_POST['region_id'];
  	$product_sub_category = $_POST['product_sub_category'];
  	$product_price = $_POST['product_price'];
  	$product_desc = $_POST['product_desc'];
  	$product_min = $_POST['min_order'];
  	$product_max = $_POST['max_order'];
  	$product_manufacturer = $_POST['product_manufacturer'];
  	$product_discount = $_POST['discount'];
  	$expires= $_POST['expires'];
  	$dist_id = $_POST['dist_id'];
  	$licence= $_POST['licence'];
  	$code = $_POST['code'];
  	

 
  	

    $insert_product = "insert into product
  	(distributor_id, sub_category_id, name, manufacturer,expires,licence,code,discount, description ) values
  	('$dist_id', '$product_sub_category', '$product_name', '$product_manufacturer', '$expires',  '$licence', '$code', '$product_discount', '$product_desc')";
  	//execute query

  	$insert_pro = mysqli_query($con, $insert_product);


  	$get_product_id = "select * from product where name = '$product_name' and sub_category_id = '$product_sub_category'";
  	$result_product_id = mysqli_query($con, $get_product_id);
  	$row = mysqli_fetch_array($result_product_id);
  	$product_id = $row['id'];


  	//into store

    $sql_insert_store = "insert into store (region_id, distributor_id) values ('$region_id', '$dist_id' )";
    $result_store = mysqli_query($con, $sql_insert_store);

    $get_store_id = "select * from store where region_id = '$region_id' and distributor_id = '$dist_id'";
    $result_store_id = mysqli_query($con, $get_store_id);
    $row = mysqli_fetch_array($result_store_id);
    $store_id = $row['id'];

  //into store item

    $sql_insert_store_item = "insert into store_item (product_id, store_id, price, min_order, max_order) values ('$product_id','$store_id', '$product_price', '$product_min', '$product_max')";
    $result = mysqli_query($con, $sql_insert_store_item);

    

  	if ($insert_pro) {
  		echo "<script>alert('Product has been added succesfully')</script>";
  		echo "<script>window.open('index.php?view_products','_self')</script>";
  	}else{
  		echo "<script>alert('product not added')</script>";
  	}


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

	<?php include("inc/footer1.php")  ?>

	<?php } ?>

	