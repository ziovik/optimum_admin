
<?php 
 
include ("../inc/db.php");
 //for not acceessing this page by another person who is not in admin


if ($_GET['edit_customer']) {
	$customer_id = $_GET['edit_customer'];

	 $get_customer = "select 
                            c.id as customer_id,
                            c.name as customer_name,
                            ro.name as role_name,
                            con.email as email,
                            con.telephone as telephone,
                            r.name as region_name,
                            a.index_code as index_code,
                            a.building as building,
                            a.house as house,
                            crd.login as login,
                            crd.password as password,
                            s.name as street_name 
                         from customer c
                            
                             join contact con on con.id = c.contact_id
                             join region r on r.id = c.region_id
                             join address a on a.id = c.address_id
                             join street s on s.id = a.street_id
                             join credentials crd on crd.id = c.credentials_id
                             join role ro on ro.id = crd.role_id
                          where c.id = '$customer_id'";

       $run_customer = mysqli_query($con, $get_customer);

      $row_c = mysqli_fetch_array($run_customer);
          $customer_id = $row_c['customer_id'];
       	  $customer_name = $row_c['customer_name'];
       	  $customer_email = $row_c['email'];
          $customer_telephone = $row_c['telephone']; 
          $region_name = $row_c['region_name'];
          $customer_building = $row_c['building'];
          $customer_index_code = $row_c['index_code'];
          $customer_house = $row_c['house'];
          $customer_street = $row_c['street_name'];
          $customer_role = $row_c['role_name'];
          $login = $row_c['login'];
          $password = $row_c['password'];


  

?>


	<form action="" method="post" enctype="multipart/form-data">
		<table align="center" width="90%" border="2" bgcolor="#F6F7F8">
			<h2 style="text-align: center;">Edit and Update  Customer here</h2>

			
			<tr>
				<td align="right"><b>Edit and Update Customer Name:</b></td>
				<td>
                    <input type="text" name="customer_name" size="80" value="<?php echo $customer_name; ?>" required>
				</td>
			</tr>
			
			<tr>
				<td align="right"><b>Edit and Update Email:</b></td>
				<td>
                    <input type="text" name="email" size="30" value="<?php echo $customer_email; ?>" required>
				</td>
			</tr>
			<tr>
				<td align="right"><b>Edit and Update Telephone:</b></td>
				<td>
                    <input type="text" name="telephone" size="30" value="<?php echo $customer_telephone; ?>" required>
				</td>
			</tr>
			<tr>
				<td align="right"><b>Edit and Update Index_code:</b></td>
				<td>
                    <input type="text" name="index_code" size="30" value="<?php echo $customer_index_code; ?>" >
				</td>
			</tr>
			<tr>
				<td align="right"><b>Edit and Update Region:</b></td>
				<td>
					<select name="region_id">
						<option><?php echo $region_name; ?></option>
						<?php
                            $get_region = "select * from region";
	                        $run_region = mysqli_query($con, $get_region);

	                        while ($row_region = mysqli_fetch_array($run_region)){
		                       $region_id = $row_region['id'];
		                       $region_name = $row_region['name'];

		                       echo "<option value='$region_id'>$region_name</option>";
	                        }

						?>
					</select>
				</td>
			</tr>
			
			<tr>
				<td align="right"><b>Edit and Update Customer Street :</b></td>
				<td>
					 <input type="text" name="street_name" size="30" value="<?php echo $customer_street; ?>" >
				</td>
			</tr>
			<tr>
				<td align="right"><b>Edit and Update Building:</b></td>
				<td><input type="text" name="building" value="<?php echo $customer_building; ?>" ></td>
			</tr>
			
			<tr>
				<td align="right"><b> Edit and Update House:</b></td>
				<td><input type="text" name="house"  value="<?php echo $customer_house; ?>" ></td>
			</tr>
			<tr>
				<td align="right"><b>Edit and Update Role:</b></td>
				<td>
					<select name="role_id">
						<option><?php echo $customer_role; ?></option>
						<?php
                            $get_role = "select * from role";
	                        $run_role = mysqli_query($con, $get_role);

	                        while ($row_role = mysqli_fetch_array($run_role)){
		                       $role_id = $row_role['id'];
		                       $role_name = $row_role['name'];

		                       echo "<option value='$role_id'>$role_name</option>";
	                        }

						?>
					</select>
				</td>
			</tr>


			<tr>
				<td align="right"><b> Edit and Update Login:</b></td>
				<td><input type="text" name="login"  value="<?php echo $login; ?>" required></td>
			</tr>
			<tr>
				<td align="right"><b> Edit and Update Password:</b></td>
				<td><input type="text" name="password"  value="<?php echo $password; ?>" required></td>
			</tr>

			
			<tr align="center">
				
				<td colspan="8"><input type="submit" name="update_customer" class="btn btn-success" value="Update Customer"></td>
			</tr>
		</table>
	</form>
<?php }  ?>

<?php

  if (isset($_POST['update_customer'])) {
  	
  	//geting text data from form fields

  	$update_id = $customer_id;

  	$customer_name = $_POST['customer_name'];
  	$email = $_POST['email'];
  	$telephone = $_POST['telephone'];
  	$index_code = $_POST['index_code'];
  	$street_name = $_POST['street_name'];
  	$building = $_POST['building'];
  	$house = $_POST['house'];
  	$region_id = $_POST['region_id'];
  	$role_id = $_POST['role_id'];
  	
  //update contact table 
  	$sql_update_contact = "update contact set email = '$email', telephone = '$telephone' where id ='$update_id'";
  	$result_update_contact = mysqli_query($con, $sql_update_contact);

  	$sql_get_contact_id = "select * from contact where email = '$email' and telephone = '$telephone' ";
  	$result_contact_id = mysqli_query($con, $sql_get_contact_id);
  	$row_contact_id = mysqli_fetch_array($result_contact_id);
  	$contact_id =$row_contact_id['id'];

  	//update street table 
  	$sql_update_street = "update street set name = '$street_name', region_id = '$region_id' ";
  	$result_street = mysqli_query($con, $sql_update_street);

  	$sql_get_street_id = "select * from street where name = '$street_name' and region_id = '$region_id' ";
  	$result_street_id = mysqli_query($con, $sql_get_street_id);
  	$row_street_id = mysqli_fetch_array($result_street_id);
  	$street_id =$row_street_id['id'];

  //update address table

    $sql_update_address = "update address set index_code = '$index_code', street_id = '$street_id', building = '$building', house = '$house' ";
  	$result_update_address = mysqli_query($con, $sql_update_address);

  	$sql_get_address_id = "select * from address where index_code = '$index_code' and street_id = '$street_id' and  building = '$building' and house ='$house' ";
  	$result_address_id = mysqli_query($con, $sql_get_address_id);
  	$row_address_id = mysqli_fetch_array($result_address_id);
  	$address_id =$row_address_id['id'];
  

  //update credentials table	
   $sql_update_credentials = "update credentials set login = '$login', password = '$password', role_id = '$role_id'";
  	$result_update_credentials = mysqli_query($con, $sql_update_credentials);

  	$sql_get_credentials_id = "select * from credentials where login = '$login' and password = '$password' and  role_id = '$role_id'  ";
  	$result_credentials_id = mysqli_query($con, $sql_get_credentials_id);
  	$row_credentials_id = mysqli_fetch_array($result_credentials_id);
  	$credentials_id = $row_credentials_id['id'];
  

// use ur database to cross check exactly one by one as in table
   $update_customer = "update customer set name ='$customer_name', 
	                      contact_id='$contact_id', region_id='$region_id', 
	                      address_id='$address_id', credentials_id='$credentials_id'

                   where id='$update_id'";


  	//execute query

  	$run_customer = mysqli_query($con, $update_customer);

  	if ($run_customer) {
  		echo "<script>alert('Customer has been Updated succesfully')</script>";
  		echo "<script>window.open('index.php?view_customers','_self')</script>";
  	}else{
  		echo "<script>alert('Customer not updated')</script>";
  	}


  }

?>

