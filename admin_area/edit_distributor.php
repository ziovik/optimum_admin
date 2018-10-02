
<?php

include ("../inc/db.php");
//for not acceessing this page by another person who is not in admin


if ($_GET['edit_distributor']) {
    $distributor_id = $_GET['edit_distributor'];

    $get_distributor = "select 
                            d.id as distributor_id,
                            d.name as distributor_name,
                            com.name as company_name,
                            com.ogrn as ogrn,
                            com.inn as inn,
                            con.email as email,
                            con.telephone as telephone,
                            r.name as region_name,
                            a.index_code as index_code,
                            a.building as building,
                            a.house as house,
                            ro.name as role_name,
                            crd.login as login,
                            crd.password as password,
                            s.name as street_name 
                         from distributor d
                            
                             join contact con on con.id = d.contact_id
                             join company com on com.id = d.company_id
                             join region r on r.id = d.region_id
                             join address a on a.id = d.address_id
                             join street s on s.id = a.street_id
                             join credentials crd on crd.id = d.credentials_id
                             join role ro on ro.id = crd.role_id
                          where d.id = '$distributor_id'";

    $run_distributor = mysqli_query($con, $get_distributor);

    $row_d = mysqli_fetch_array($run_distributor);
    $distributor_id = $row_d['distributor_id'];
    $distributor_name = $row_d['distributor_name'];
    $distributor_email = $row_d['email'];
    $distributor_telephone = $row_d['telephone'];
    $region_name = $row_d['region_name'];
    $distributor_building = $row_d['building'];
    $distributor_index_code = $row_d['index_code'];
    $distributor_house = $row_d['house'];
    $distributor_street = $row_d['street_name'];
    $login = $row_d['login'];
    $password = $row_d['password'];
    $distributor_role = $row_d['role_name'];
    $company_name = $row_d['company_name'];
    $ogrn = $row_d['ogrn'];
    $inn = $row_d['inn'];


    ?>


    <form action="" method="post" enctype="multipart/form-data">
        <table align="center" width="90%" border="2" bgcolor="#F6F7F8">
            <h2 style="text-align: center;">Edit and Update  Distributor here</h2>


            <tr>
                <td align="right"><b>Edit and Update Distributor Company:</b></td>
                <td>
                    <input type="text" name="company_name" size="80" value="<?php echo $company_name; ?>" required>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Edit and Contact person Name:</b></td>
                <td>
                    <input type="text" name="distributor_name" size="80" value="<?php echo $distributor_name; ?>" required>
                </td>
            </tr>

            <tr>
                <td align="right"><b>Edit and Update Email:</b></td>
                <td>
                    <input type="text" name="email" size="30" value="<?php echo $distributor_email; ?>" required>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Edit and Update Telephone:</b></td>
                <td>
                    <input type="text" name="telephone" size="30" value="<?php echo $distributor_telephone; ?>" required>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Edit and Update OGRN:</b></td>
                <td>
                    <input type="text" name="ogrn" size="30" value="<?php echo $ogrn; ?>" >
                </td>
            </tr>
            <tr>
                <td align="right"><b>Edit and Update INN:</b></td>
                <td>
                    <input type="text" name="inn" size="30" value="<?php echo $inn; ?>" >
                </td>
            </tr>
            <tr>
                <td align="right"><b>Edit and Update Index_code:</b></td>
                <td>
                    <input type="text" name="index_code" size="30" value="<?php echo $distributor_index_code; ?>" >
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
                <td align="right"><b>Edit and Update Distributor Street :</b></td>
                <td>
                    <input type="text" name="street_name" size="30" value="<?php echo $distributor_street; ?>" >
                </td>
            </tr>
            <tr>
                <td align="right"><b>Edit and Update Building:</b></td>
                <td><input type="text" name="building" value="<?php echo $distributor_building; ?>" ></td>
            </tr>

            <tr>
                <td align="right"><b> Edit and Update House:</b></td>
                <td><input type="text" name="house"  value="<?php echo $distributor_house; ?>" ></td>
            </tr>
            <tr>
                <td align="right"><b>Edit and Update Role:</b></td>
                <td>
                    <select name="role_id">
                        <option><?php echo $distributor_role; ?></option>
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

                <td colspan="8"><input type="submit" name="update_distributor" class="btn btn-success" value="Update Distributor"></td>
            </tr>
        </table>
    </form>
<?php }  ?>

<?php

if (isset($_POST['update_distributor'])) {

    //getting text data from form fields

    $update_id = $distributor_id;


    $distributor_name = $_POST['distributor_name'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $index_code = $_POST['index_code'];
    $street_name = $_POST['street_name'];
    $building = $_POST['building'];
    $house = $_POST['house'];
    $region_id = $_POST['region_id'];
    $role_id = $_POST['role_id'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $company_name = $_POST['company_name'];
    $ogrn = $_POST['ogrn'];
    $inn = $_POST['inn'];

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

//    //update company table
//
//    $sql_update_company = "update company set name = '$company_name', ogrn = '$ogrn', inn = '$inn' ";
//    $result_update_company = mysqli_query($con, $sql_update_company);
//
//    $sql_get_company_id = "select * from company where name = '$company_name' and ogrn = '$ogrn' and  inn = '$inn'  ";
//    $result_company_id = mysqli_query($con, $sql_get_company_id);
//    $row_company_id = mysqli_fetch_array($result_company_id);
//    $company_id =$row_company_id['id'];


    //update credentials table
    $sql_update_credentials = "update credentials set login = '$login', password = '$password', role_id = '$role_id'";
    $result_update_credentials = mysqli_query($con, $sql_update_credentials);

    $sql_get_credentials_id = "select * from credentials where login = '$login' and password = '$password' and  role_id = '$role_id'  ";
    $result_credentials_id = mysqli_query($con, $sql_get_credentials_id);
    $row_credentials_id = mysqli_fetch_array($result_credentials_id);
    $credentials_id = $row_credentials_id['id'];


// use ur database to cross check exactly one by one as in table
    $update_distributor = "update distributor set name ='$distributor_name', 
	                      contact_id='$contact_id', region_id='$region_id', 
	                      address_id='$address_id', credentials_id='$credentials_id'

                   where id='$update_id'";


    //execute query

    $run_distributor = mysqli_query($con, $update_distributor);

    if ($run_distributor) {
        echo "<script>alert('Distributor has been Updated successfully')</script>";
        echo "<script>window.open('index.php?view_distributor','_self')</script>";
    }else{
        echo "<script>alert('Distributor not updated')</script>";
    }


}

?>

