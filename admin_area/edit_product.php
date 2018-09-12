<!DOCTYPE html>
<?php 
 
include ("../inc/db.php");
 //for not acceessing this page by another person who is not in admin

   if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}

else{

   //
if ($_GET['edit_product']) {
	$get_id = $_GET['edit_product'];

	 $get_pro = "select
	                  p.id, 
	                  p.name,
	                  p.distributor_id,
	                  si.price as price,
	                  p.manufacturer,
	                  p.description,
	                  p.licence,
	                  p.code,
	                  p.sub_category_id,
	                  p.expires,
	                  p.discount,
	                  si.min_order,
	                  si.max_order 
	              from product p
	                   join store_item si on si.product_id = p.id
	               where p.id = '$get_id'";

       $run_pro = mysqli_query($con, $get_pro);

       $i = 0;

       $row_pro = mysqli_fetch_array($run_pro);

       	//for deleting
          $pro_id = $row_pro['id'];
       	//deleting

       	$pro_name = $row_pro['name'];
       	$pro_dist = $row_pro['distributor_id'];
       	$pro_price = $row_pro['price'];
       	$product_manufacturer = $row_pro['manufacturer'];
       	$pro_desc = $row_pro['description'];
       	$licence = $row_pro['licence'];
       	$code = $row_pro['code'];
       	$pro_sub_cat_id = $row_pro['sub_category_id'];
       	$expires = $row_pro['expires'];
       	$discount = $row_pro['discount'];
       	$product_min_order = $row_pro['min_order'];
       	$product_max_order = $row_pro['max_order'];


       
        



       	//another table sub_cat
       	$get_sub_cat = "select * from sub_category where id='$pro_sub_cat_id'";

       	$run_sub_cat = mysqli_query($con, $get_sub_cat);

       	$row_sub_cat=mysqli_fetch_array($run_sub_cat);

       	$sub_cat_name = $row_sub_cat['name'];


       	//another table for distributor 
       	$get_dist = "select 
       	                   com.name as company_name
       	             from distributor  d
       	                  join company com on com.id = d.company_id
       	             where d.id='$pro_dist'";

       	$run_dist = mysqli_query($con, $get_dist);

       	$row_dist =mysqli_fetch_array($run_dist);

       	$dist_name = $row_dist['company_name'];

       	



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
		<table align="center" width="90%" border="2" bgcolor="#F6F7F8">
			<h2 style="text-align: center;">Edit and Update  Product here</h2>

			
			<tr>
				<td align="right"><b>Edit and Update Product Title:</b></td>
				<td>
                    <textarea name="product_name" cols="20" rows="4" ><?php echo $pro_name; ?></textarea>
				</td>
			</tr>
			
			<tr>
				<td align="right"><b>Edit and Update Product Sub Categories:</b></td>
				<td>
					<select name="product_sub_category">
						<option><?php echo $sub_cat_name; ?></option>
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
				<td align="right"><b>Edit and Update Product Distributor :</b></td>
				<td>
					<select name="dist_id" required>
						<option><?php echo $dist_name; ?></option>
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
				<td align="right"><b>Edit and Update Product Price:</b></td>
				<td><input type="text" name="product_price" value="<?php echo $pro_price; ?>" required></td>
			</tr>
			<tr>
				<td align="right"><b>Edit and Update Product Description:</b></td>
				<td>
                    <textarea name="product_desc" cols="20" rows="10" ><?php echo $pro_desc; ?></textarea>
				</td>
			</tr>
			<tr>
				<td align="right"><b>Edit and Update Product Min Order:</b></td>
				<td><input type="text" name="min_order" size="20" value="<?php echo $product_min_order; ?>" required></td>
			</tr>
			<tr>
				<td align="right"><b>Edit and Update Product Max Order:</b></td>
				<td><input type="text" name="max_order" size="20" value="<?php echo $product_max_order; ?>" required></td>
			</tr>
			<tr>
				<td align="right"><b> Edit and Update Product Manufacturer:</b></td>
				<td><input type="text" name="product_manufacturer" size="80" value="<?php echo $product_manufacturer; ?>" required></td>
			</tr>
			
			<tr>
				<td align="right"><b>Edit and Update Product Discount:</b></td>
				<td><input type="text" name="discount" size="80" value="<?php echo $discount; ?>" required></td>
			</tr>
			<tr>
				<td align="right"><b>Edit and Update Product Expiring Date:</b></td>
				<td><input type="text" name="expires" size="40" value="<?php echo $expires; ?>" required></td>
			</tr>
				<tr>
				<td align="right"><b>Edit and Update Product Licence:</b></td>
				<td><input type="text" name="licence" size="40" value="<?php echo $licence; ?>" required></td>
			</tr>
				<tr>
				<td align="right"><b>Edit and Update Product code:</b></td>
				<td><input type="text" name="code" size="40" value="<?php echo $code; ?>" required></td>
			
			<tr align="center">
				
				<td colspan="8"><input type="submit" name="update_product" class="btn btn-success" value="Update Product"></td>
			</tr>
		</table>
	</form>

</body>
</html>

<?php

  if (isset($_POST['update_product'])) {
  	
  	//geting text data from form fields

  	$update_id = $get_id;
  	$product_name = $_POST['product_name'];
  	$product_sub_category = $_POST['product_sub_category'];
  	$product_price = $_POST['product_price'];
  	$product_desc = $_POST['product_desc'];
  	$product_min_order = $_POST['min_order'];
  	$product_max_order = $_POST['max_order'];
  	$product_manufacturer = $_POST['product_manufacturer'];
  	$product_discount = $_POST['discount'];
  	$expires= $_POST['expires'];
  	$dist_id = $_POST['dist_id'];
  	$licence= $_POST['licence'];
  	$code = $_POST['code'];
  
   

$update_store_item = "update store_item set price ='$product_price', max_order = '$product_max_order',  min_order = '$product_min_order' where product_id = '$update_id'";
$result = mysqli_query($con, $update_store_item);
  
  	

// use ur databes to cross check exactly one by one as in table
   $update_product = "update product set  name='$product_name', 
                      manufacturer='$product_manufacturer', expires='$expires', 
                       
                      licence='$licence', code='$code', discount='$product_discount', 
                      description='$product_desc'

    where id='$update_id'";



  	//execute query

  	$run_product = mysqli_query($con, $update_product);

  	if ($run_product) {
  		echo "<script>alert('Product has been Updated succesfully')</script>";
  		echo "<script>window.open('index.php?view_products','_self')</script>";
  	}else{
  		echo "<script>alert('not product updated')</script>";
  	}


  }

?>

<!--close the not accessing -->
<?php  } ?>