

<table width="800" align="center" >
	<tr align="center">
		<td colspan="7"><h2>View All Regions</h2></td>
	</tr>
	<tr style="text-align: center;">
		
		<th> Name</th>
		<th> Code</th>
    <th> Country</th>
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

       $get_region= "select 
                      r.id as region_id,
                      r.name as region_name,
                      c.name as country_name,
                      r.code as region_code
                  from region r 
                       join country c on c.id = r.country_id";

       $run_region = mysqli_query($con, $get_region);

      

       while($row_region = mysqli_fetch_array($run_region)){

       	
        $region_id = $row_region['region_id'];
        $region_code =  $row_region['region_code'];
        $region_name = $row_region['region_name'];
       	$country_name = $row_region['country_name'];
       	
  
     ?>

     <tr align="center">
     	
     	<td><?php echo $region_name; ?></td>
      <td><?php echo $region_code;  ?></td>
      <td><?php echo $country_name; ?></td>

     	<td><a href="index.php?edit_region=<?php echo $region_id; ?>">Edit</a></td>
     	<td><a href="delete_region.php?delete_region=<?php echo $region_id; ?>">Delete</a></td>
     </tr>

    <?php } ?>

</table>

<!--close the not accessing -->
<?php  } ?>