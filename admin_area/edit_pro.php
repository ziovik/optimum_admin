<!DOCTYPE html>
<?php 
 

 //for not acceessing this page by another person who is not in admin

   if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}

else{

   //
if ($_GET['edit_pro']) {
	$get_id = $_GET['edit_pro'];

	 $get_pro = "select * from products where product_id = '$get_id'";

       $run_pro = mysqli_query($con, $get_pro);

       $i = 0;

       $row_pro = mysqli_fetch_array($run_pro);

       	//for deleting
          $pro_id = $row_pro['product_id'];
       	//deleting

       	$pro_name = $row_pro['product_title'];
       	$pro_dist = $row_pro['dist_id'];
       	$pro_price = $row_pro['product_price'];
       	$pro_manu = $row_pro['product_manu'];
       	$pro_desc = $row_pro['product_desc'];
       	$pro_keyword = $row_pro['product_keyword'];
       	$pro_cat = $row_pro['product_cat'];
       	$pro_sub_cat = $row_pro['product_sub_cat'];
       	$pro_brand = $row_pro['product_brand'];
       	$pro_reg = $row_pro['region_id'];
       
        

       	//another table  category
       	$get_cat = "select * from categories where cat_id='$pro_cat'";

       	$run_cat = mysqli_query($con, $get_cat);

       	$row_cat=mysqli_fetch_array($run_cat);

       	$category_title= $row_cat['cat_name'];

       		//another table brand
       	$get_brand = "select * from brands where brand_id='$pro_brand'";

       	$run_brand = mysqli_query($con, $get_brand);

       	$row_brand=mysqli_fetch_array($run_brand);

       	$brand_title = $row_brand['brand_name'];


       	//another table sub_cat
       	$get_sub_cat = "select * from sub_cat where sub_cat_id='$pro_sub_cat'";

       	$run_sub_cat = mysqli_query($con, $get_sub_cat);

       	$row_sub_cat=mysqli_fetch_array($run_sub_cat);

       	$sub_cat_title = $row_sub_cat['sub_cat_name'];


       	//another table
       	$get_reg = "select * from regions where region_id='$pro_reg'";

       	$run_region = mysqli_query($con, $get_reg);

       	$row_region=mysqli_fetch_array($run_region);

       	$region_title = $row_region['region_name'];

       	


}
?>
<html>
<head>
	<title>Updating Products</title>
	<script type="text/javascript" src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
	<script >
		tinymce.init({selector:'textarea'});
	</script>
</head>
<body>

	<form action="" method="post" enctype="multipart/form-data">
		<table align="center" width="750" border="2" bgcolor="#F6F7F8">
			<tr align="center">
				<td colspan="8"><h2>Edit and Update  Product here</h2></td>

			</tr>
			<tr>
				<td align="right"><b>Edit and Update Product Title:</b></td>
				<td><input type="text" name="product_title" size="80" value="<?php echo $pro_name; ?>"></td>
			</tr>
			<tr>
				<td align="right"><b> Edit and Update Product Category:</b></td>
				<td>
					<select name="product_cat" required>
						<option><?php echo $category_title; ?></option>
						<?php
                            $get_cats = "select * from categories";
	                        $run_cats = mysqli_query($con, $get_cats);

	                        while ($row_cats = mysqli_fetch_array($run_cats)){
		                       $cat_id = $row_cats['cat_id'];
		                       $cat_name = $row_cats['cat_name'];

		                       echo "<option value='$cat_id'>$cat_name</option>";
	                        }

						?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right"><b> Edit and Update Product Sub Categories:</b></td>
				<td>
					<select name="product_sub_cat">
						<option><?php echo $sub_cat_title; ?></option>
						<?php
                            $get_sub_cats = "select * from sub_cat";
	                        $run_sub_cats = mysqli_query($con, $get_sub_cats);

	                        while ($row_sub_cats = mysqli_fetch_array($run_sub_cats)){
		                       $sub_cat_id = $row_sub_cats['sub_cat_id'];
		                       $sub_cat_name = $row_sub_cats['sub_cat_name'];

		                       echo "<option value='$sub_cat_id'>$sub_cat_name</option>";
	                        }

						?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right"><b>Product Brand:</b></td>
				<td>
					<select name="product_brand" required>
						<option><?php echo $brand_title; ?></option>
						<?php
                            $get_brands = "select * from brands";
	                        $run_brands = mysqli_query($con, $get_brands);

	                        while ($row_brands = mysqli_fetch_array($run_brands)){
		                       $brand_id = $row_brands['brand_id'];
		                       $brand_name = $row_brands['brand_name'];

		                       echo "<option value='$brand_id'>$brand_name</option>";
	                        }

						?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right"><b>Product Distributor:</b></td>
				<td>
					<select name="product_dist" required>
						<option><?php echo $pro_dist; ?></option>
						<?php
                            $get_dist = "select * from distributors";
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
				<td align="right"><b>Product Price:</b></td>
				<td><input type="text" name="product_price" value="<?php echo $pro_price; ?>"></td>
			</tr>
			<tr>
				<td align="right"><b>Product Description:</b></td>
				<td>
                    <textarea name="product_desc" cols="20" rows="10" ><?php echo $pro_desc; ?></textarea>
				</td>
			</tr>
			<tr>
				<td align="right"><b>Product Manufacturer:</b></td>
				<td><input type="text" name="product_manu" size="80" value="<?php echo $pro_manu; ?>"></td>
			</tr>
			<tr>
				<td align="right"><b>Product Keyword:</b></td>
				<td><input type="text" name="product_keyword" size="80" value="<?php echo $pro_keyword; ?>"></td>
			</tr>
			<tr>
				<td align="right"><b>Product Region:</b></td>
				<td>
					<select name="product_reg" required>
						<option><?php echo $region_title; ?></option>
						<?php
                            $get_reg = "select * from regions";
	                        $run_regs = mysqli_query($con, $get_reg);

	                        while ($row_regs = mysqli_fetch_array($run_regs)){
		                       $region_id = $row_regs['region_id'];
		                       $region_name = $row_regs['region_name'];

		                       echo "<option value='$region_id'>$region_name</option>";
	                        }

						?>
					</select>
				</td>
			</tr>
			
			
			<tr align="center">
				
				<td colspan="8"><input type="submit" name="update_product" value="Update Product"></td>
			</tr>
		</table>
	</form>

</body>
</html>

<?php

  if (isset($_POST['update_product'])) {
  	
  	//geting text data from form fields

  	$update_id = $pro_id;


  	$product_title = $_POST['product_title'];
  	$product_cat = $_POST['product_cat'];
  	$product_sub_cat = $_POST['product_sub_cat'];
  	$product_brand = $_POST['product_brand'];
  	$product_price = $_POST['product_price'];
  	$product_desc = $_POST['product_desc'];
  	$product_manu = $_POST['product_manu'];
  	$product_keyword = $_POST['product_keyword'];
  	$product_reg = $_POST['region_id'];
  	$dist_id = $_POST['product_dist'];
  

  

// use ur databes to cross check exactly one by one as in table
   $update_product = "update products set product_cat='$product_cat',product_sub_cat='$product_sub_cat',product_brand='$product_brand',product_title='$product_title',product_price='$product_price',product_desc='$product_desc',dist_id='$dist_id',product_manu='$product_manu',product_keyword='$product_keyword',region_id='$product_reg' where product_id='$update_id'";


  	//execute query

  	$run_product = mysqli_query($con, $update_product);

  	if ($run_product) {
  		echo "<script>alert('Product has been Updated succesfully')</script>";
  		echo "<script>window.open('index.php?view_products','_self')</script>";
  	}


  }

?>

<!--close the not accessing -->
<?php  } ?>