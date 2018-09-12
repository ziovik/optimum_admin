

<table width="100%" align="center" >
	<h2 style="text-align: center;">View All Customers</h2></td>
	
	<tr style="text-align: center;">
		
		<th>Customer Name</th>
		<th>Email</th>
    <th>Telephone</th>
    <th>Region</th>
    <th>Index Code</th>
    <th>Street</th>
    <th>Building</th>
    <th>House</th>
		
    <th>Edit</th>
    <th>Delete</th>
	</tr>
     
     <?php

       include("../inc/db.php");
        //for not acceessing this page by another person who is not in admin

   if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}

else{

   //

       $get_customer = "select 
                            c.id as customer_id,
                            c.name as customer_name,
                           
                            con.email as email,
                            con.telephone as telephone,
                            r.name as region_name,
                            a.index_code as index_code,
                            a.building as building,
                            a.house as house,
                            s.name as street_name 
                         from customer c
                            
                             join contact con on con.id = c.contact_id
                             join region r on r.id = c.region_id
                             join address a on a.id = c.address_id
                             join street s on s.id = a.street_id";

       $run_customer = mysqli_query($con, $get_customer);

       while($row_c = mysqli_fetch_array($run_customer)){
          $customer_id = $row_c['customer_id'];
       	  $customer_name = $row_c['customer_name'];
       	  $customer_email = $row_c['email'];
          $customer_telephone = $row_c['telephone'];
      
          $region_name = $row_c['region_name'];
          $customer_building = $row_c['building'];
          $customer_index_code = $row_c['index_code'];
          $customer_house = $row_c['house'];
          $customer_street = $row_c['street_name'];
       	
     ?>

     <tr align="center">
     	<td><?php echo $customer_name;  ?></td>
     	<td><?php echo $customer_email; ?></td>
      <td><?php echo $customer_telephone; ?></td>
      <td><?php echo $region_name;  ?></td>
      <td><?php echo $customer_index_code; ?></td>
      <td><?php echo $customer_street; ?></td>
      <td><?php echo $customer_building;  ?></td>
      <td><?php echo $customer_house; ?></td>
     
     	<td><a href="index.php?edit_customer=<?php echo $customer_id; ?>">Edit</a></td>
     	
     	<td><a href="delete_customer.php?delete_customer=<?php echo $customer_id; ?>">Delete</a></td>
     </tr>

    <?php } ?>

</table>
<!--close the not accessing -->
<?php  } ?>