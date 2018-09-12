<?php 
 
include ("../inc/db.php");
 ?>


  <form action="" method="post" enctype="multipart/form-data">
    <table align="center" width="900px;" border="2" bgcolor="#F6F7F8">
      <h2 style="text-align: center;">Insert New Distributor here</h2>

      
      <tr>
        <td align="right" style="width: 150px;"><b>Distributor Name:</b></td>
          <td>
             <input type="text" name="distributor_name" size="80" required>
        </td>
      </tr>
       <tr>
        <td align="right"><b>Company:</b></td>
        <td><input type="text" name="company_name" size="80" required></td>
      </tr>
      <tr>
        <td align="right"><b>Email:</b></td>
        <td>
          <input type="text" name="email" size="80" required>
        </td>
      </tr>
      
      <tr>
        <td align="right"><b>Telephone :</b></td>
        <td>
          <input type="text" name="telephone" size="50" required>
        </td>
      </tr>
      <tr>
        <td align="right"><b>Region:</b></td>
        <td>
          <select name="region">
            <option>Select  sub category</option>
            <?php
                $get_region = "select * from region";
                $result = mysqli_query($con, $get_region);

                while ($row_region = mysqli_fetch_array($result)){
                 $region_id = $row_region['id'];
                 $region_name = $row_region['name'];

                 echo "<option value='$region_id'>$region_name</option>";
                }

            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td align="right"><b>Index Code:</b></td>
        <td>
            <input type="text" name="index_code" size="30" required>
      </tr>
      <tr>
        <td align="right"><b>Street:</b></td>
        <td><input type="text" name="street" size="40" required></td>
      </tr>
      <tr>
        <td align="right"><b>Building:</b></td>
        <td><input type="text" name="building" size="20" required></td>
      </tr>
      
      <tr>
        <td align="right"><b>House:</b></td>
        <td><input type="text" name="house" size="20" required></td>
      </tr>
       <tr>
        <td align="right"><b>OGRN:</b></td>
        <td><input type="text" name="ogrn" size="50" required></td>
      </tr>
      
      <tr>
        <td align="right"><b>INN:</b></td>
        <td><input type="text" name="inn" size="50" required></td>
      </tr>

     
     <tr>
        <td align="right"><b>Login:</b></td>
        <td><input type="text" name="login" size="20" required></td>
      </tr>
      <tr>
        <td align="right"><b>Password:</b></td>
        <td><input type="text" name="password" size="20" required></td>
      </tr>
      <tr>
        <td align="right"><b>Role:</b></td>
        <td>
          <select name="role_id">
            <option>Select  role</option>
            <?php
                $get_role = "select * from role";
                $result = mysqli_query($con, $get_role);

                while ($row_role = mysqli_fetch_array($result)){
                 $role_id = $row_role['id'];
                 $role_name = $row_role['name'];

                 echo "<option value='$role_id'>$role_name</option>";
                }

            ?>
          </select>
        </td>
      </tr>
       <tr align="center">   
        <td colspan="8"><input type="submit" name="insert_distributor" class="btn btn-success" value="Insert New Distributor"></td>
      </tr>
    </table>
  </form>



<?php

  if (isset($_POST['insert_distributor'])) {
    
    //geting text data from form fields

    $name = $_POST['distributor_name'];
    $company_name = $_POST['company_name'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $region = $_POST['region'];
    $index_code = $_POST['index_code'];
    $street = $_POST['street'];
    $building = $_POST['building'];
    $house = $_POST['house'];

    $ogrn = $_POST['ogrn'];
    $inn = $_POST['inn'];
   

    $login = $_POST['login'];
    $password = $_POST['password'];
    $role = $_POST['role_id'];


    
    $insert_conatct = "insert into contact (email, telephone ) values ('$email', '$telephone')";
    $result_contact = mysqli_query($con, $insert_conatct);

    $sql_get_contact_id = "select * from contact where email ='$email' and telephone = '$telephone'";
    $result_contact_id = mysqli_query($con, $sql_get_contact_id);
    $row_contact_id = mysqli_fetch_array($result_contact_id);
    $contact_id =$row_contact_id['id'];



    $sql_insert_street = "insert into street (name, region_id ) values ('$street', '$region')";
    $result_street = mysqli_query($con, $sql_insert_street);

    $sql_get_street_id = "select * from street where name = '$street' and region_id = '$region'";
    $result_street_id = mysqli_query($con, $sql_get_street_id);
    $row = mysqli_fetch_array($result_street_id);
    $street_id = $row['id'];



    $insert_address = "insert into address (index_code, street_id, building, house ) values ('$index_code', '$street_id', '$building', $house)";
    $result_address = mysqli_query($con, $insert_address);
    
    $sql_get_address_id = "select * from address where index_code = '$index_code' and street_id = '$street_id' and building = '$building' and house = '$house'";
    $result_address_id = mysqli_query($con, $sql_get_address_id);
    $row_address_id = mysqli_fetch_array($result_address_id);
    $address_id = $row_address_id['id'];

   
   $insert_credentials = "insert into credentials (login, password, role_id ) values ('$login', '$password', '$role')";
    $result_credentials = mysqli_query($con, $insert_credentials);

   $sql_get_credentials_id = "select * from credentials where login = '$login' and password = '$password'";
   $result_credentials_id = mysqli_query($con, $sql_get_credentials_id);
   $row_credentials_id = mysqli_fetch_array($result_credentials_id);
   $credentials_id = $row_credentials_id['id'];
    
   // company id

    $insert_company = "insert into company (name, ogrn, inn ) values ('$company_name', '$ogrn', '$inn')";
    $result_company = mysqli_query($con, $insert_company);


   $sql_get_company_id = "select * from company where name = '$company_name' and ogrn = '$ogrn' and inn = '$inn'";
   $result_company_id = mysqli_query($con, $sql_get_company_id);
   $row_company_id = mysqli_fetch_array($result_company_id);
   $company_id = $row_company_id['id'];



    $insert_distributor = "insert into distributor
    (contact_id, company_id, credentials_id, region_id, address_id ) values
    ('$contact_id', '$company_id','$credentials_id', '$region', '$address_id' )";


    //execute query

    $result_insert_distributor = mysqli_query($con, $insert_distributor);

    if ($result_insert_distributor) {
      echo "<script>alert('distributor has been added succesfully')</script>";
      echo "<script>window.open('index.php?view_distributor','_self')</script>";
    }


  }

?>
