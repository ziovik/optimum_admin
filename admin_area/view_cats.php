

<table width="800" align="center" >
	<tr align="center">
		<td colspan="7"><h2>View All Categories</h2></td>
	</tr>
	<tr style="text-align: center;">
		<th >Category ID</th>
		<th>Category Name</th>
		
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

       $get_cat = "select * from category";

       $run_cat = mysqli_query($con, $get_cat);

       $i = 0;

       while($row_cat = mysqli_fetch_array($run_cat)){

       	
        $cat_id = $row_cat['id'];
      

       	$cat_name = $row_cat['name'];
       	
       	$i++;
       

       

     ?>

     <tr align="center">
     	<td><?php echo $i;  ?></td>
     	<td><?php echo $cat_name; ?></td>
     

     	<td><a href="index.php?edit_cat=<?php echo $cat_id; ?>">Edit</a></td>
     	<td><a href="delete_cat.php?delete_cat=<?php echo $cat_id; ?>">Delete</a></td>
     </tr>

    <?php } ?>

</table>

<!--close the not accessing -->
<?php  } ?>