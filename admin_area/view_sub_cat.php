

<table width="800" align="center" >
	<tr align="center">
		<td colspan="7"><h2>View All Sub Categories</h2></td>
	</tr>
	<tr style="text-align: center;">
		<th >Sub Category ID</th>
		<th>Sub Category Name</th>
		
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

       $get_sub_cat = "select * from sub_category";

       $run_sub_cat = mysqli_query($con, $get_sub_cat);

       $i = 0;

       while($row_sub_cat = mysqli_fetch_array($run_sub_cat)){

       	
        $sub_cat_id = $row_sub_cat['id'];
      

       	$sub_cat_name = $row_sub_cat['name'];
       	
       	$i++;
       

       

     ?>

     <tr align="center">
     	<td><?php echo $i;  ?></td>
     	<td><?php echo $sub_cat_name; ?></td>
     

     	<td><a href="index.php?edit_sub_cat=<?php echo $sub_cat_id; ?>">Edit</a></td>
     	<td><a href="delete_sub_cat.php?delete_sub_cat=<?php echo $sub_cat_id; ?>">Delete</a></td>
     </tr>

    <?php } ?>

</table>

<!--close the not accessing -->
<?php  } ?>
