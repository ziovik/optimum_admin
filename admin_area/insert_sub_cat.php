<form action="" method="post" style="padding-top: 50px; ">
	<h2 style="text-align: center;">Insert New Sub Category</h2>
  <table align="center" width="50%" border="2" bgcolor="#F6F7F8">
    <tr>
      <td>Sub-Category Name</td>
      <td>Category ID</td>
    </tr>
    <tr>
      <td>  <input type="text" name="new_sub_cat" style="width: 300px;" required></td>
      <td>
        <select name="new_category_id">
            <option>Select category</option>
            <?php
               include("../inc/db.php");
                  $get_cats = "select * from category";
                $run_cats = mysqli_query($con, $get_cats);

                while ($row_cats = mysqli_fetch_array($run_cats)){
                 $category_id = $row_cats['id'];
                 $category_name= $row_cats['name'];

                 echo "<option value='$category_id'>$category_name</option>";
                }

            ?>
          </select>
       
      </td>
    </tr>
  
  </table>
	<br>
  <div style="padding-left: 450px;">
    <button class="primary-btn" type="submit" name="add_sub_cat" value="Add Sub Category" style="border-radius: 5px;">Add Sub Category</button> 
  </div>
  
</form>

<?php
  
  include("../inc/db.php");

  //for not acceessing this page by another person who is not in admin

   if (!isset($_SESSION['user_email'])) {
  echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}

else{

   //

  if (isset($_POST['add_sub_cat'])) {
  	

  $new_sub_category = $_POST['new_sub_cat'];
  $new_category_id = $_POST['new_category_id'];
  
  $insert_sub_cat ="insert into sub_category (name,category_id) values ('$new_sub_category','$new_category_id')";

  $run_sub_cat = mysqli_query($con, $insert_sub_cat);

  if ($run_sub_cat) {
  	echo "<script>alert('New Sub Category Has been Inserted')</script>";
  	echo "<script>window.open('index.php?view_sub_cat','_self');</script>";

  }
  }
 
?>
<!--close the not accessing -->
<?php  } ?>