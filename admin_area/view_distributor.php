
<table width="100%" align="center" >
	<h2 style="text-align: center;">View All Distributor</h2></td>
	
	<tr style="text-align: center;">
		
		<th>Distributor Name</th>
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

       $get_distributor = "select 
                            d.id as distributor_id,
                            com.name as distributor_name,
                            con.email as email,
                            con.telephone as telephone,
                            r.name as region_name,
                            a.index_code as index_code,
                            a.building as building,
                            a.house as house,
                            s.name as street_name

                         from distributor d
                            
                             join contact con on con.id = d.contact_id
                             join region r on r.id = d.region_id
                             join address a on a.id = d.address_id
                             join street s on s.id = a.street_id
                             join company com on com.id = d.company_id 
                             join credentials crd on crd.id = d.credentials_id";

       $run_distributor = mysqli_query($con, $get_distributor);
if (!$run_distributor) {
             printf("Error: %s\n", mysqli_error($con));
            exit();
           }/// helps to check error

       while($row_d = mysqli_fetch_array($run_distributor)){
          $distributor_id = $row_d['distributor_id'];
       	  $distributor_name = $row_d['distributor_name'];
       	  $distributor_email = $row_d['email'];
          $distributor_telephone = $row_d['telephone'];
      
          $region_name = $row_d['region_name'];
          $distributor_building = $row_d['building'];
          $distributor_index_code = $row_d['index_code'];
          $distributor_house = $row_d['house'];
          $distributor_street = $row_d['street_name'];
       	
     ?>

     <tr align="center">
     	<td><?php echo $distributor_name;  ?></td>
     	<td><?php echo $distributor_email; ?></td>
      <td><?php echo $distributor_telephone; ?></td>
      <td><?php echo $region_name;  ?></td>
      <td><?php echo $distributor_index_code; ?></td>
      <td><?php echo $distributor_street; ?></td>
      <td><?php echo $distributor_building;  ?></td>
      <td><?php echo $distributor_house; ?></td>
     
     	<td><a href="index.php?edit_distributor=<?php echo $distributor_id; ?>">Edit</a></td>
     	
     	<td><a href="delete_distributor.php?delete_distributor=<?php echo $distributor_id; ?>">Delete</a></td>
     </tr>

    <?php } ?>

</table>
<!--close the not accessing -->
<?php  } ?>