
<table width="700px" align="center" >
  <tr align="center">
    <th colspan="5" ><h2 style="color: white; text-align: center;">Контактный инфо. клиента</h2></th>
  </tr>

  <?php

  include("../inc/db.php");


// this is for customer details
  if (isset($_GET['customer_details'])) {
     $customer_details = $_GET['customer_details'];
    
 
  if (isset($_SESSION['distributor_id'])) {


       $dist_id= $_SESSION['distributor_id'];

       $total = 0;
         $get = "select 

                     com.name as company_name,
                     so.registration_date as order_date,
                     c.name as customer_name,
                     ct.email as customer_email,
                     ct.telephone as customer_telephone,
                     r.name as customer_region,
                     st.name as street_name,
                     ad.index_code as index_code,
                     ad.building as building,
                     ad.house as house,
                     p.name as product_name,
                     si.price as price,
                     p.manufacturer as manufacturer,
                     p.expires as expires,
                     pt.quantity as quantity,
                     ct.telephone as telephone




                  from 
                       distributor d
                       
                       join company com on com.id = d.company_id
                       join product p on p.distributor_id = d.id
                       join product_item pt on pt.product_id = p.id
                       join simple_order so on so.cart_id = pt.cart_id
                       join cart crt on crt.id = so.cart_id
                       join customer c on c.id = crt.customer_id
                       join region r on r.id = c.region_id
                       join address ad on ad.id = c.address_id
                       join contact ct on ct.id = c.contact_id
                       join street st on st.id = ad.street_id
                       join store_item si on si.product_id = p.id


                  where d.id = '$dist_id' AND c.id = '$customer_details' ";

                  $run = mysqli_query($con, $get);
                  

                    $rows = mysqli_fetch_array($run);
                     $order_date = $rows['order_date'];
                      $customer_name = $rows['customer_name'];
                      $email = $rows['customer_email'];
                      $telephone = $rows['telephone'];
                      $region_name = $rows['customer_region'];
                      $street = $rows['street_name'];
                      $building = $rows['building'];
                      $house= $rows['house'];
                      $index_code = $rows['index_code'];
                      $product_name = $rows['product_name'];
                       
               
      ?>

      <tr align="center">

        <td>Имя Клиента</td>
        <td><?php echo $customer_name; ?></td>

      </tr>
      <tr align="center">

        <td>Tелефон</td>
        <td><?php echo $telephone; ?></td>

      </tr>
      <tr align="center">

        <td>Регион</td>
        <td><?php echo $region_name; ?></td>

      </tr>
      <tr align="center">

        <td>Email</td>
        <td><?php echo $email; ?></td>

      </tr>
      <tr align="center">

        <td>Aдрес</td>
        <td><?php echo $street; ?>, дом:  <?php echo $building;  ?>, Кватира: <?php echo $house;  ?>, почтовой адрес: <?php echo $index_code; ?></td>

      </tr>


       <?php
          } } 
       ?>




</table>
<input style="background:#800080; border-radius:5px; width: 80px; height: 50px;" class="btn next-btn" type="submit" value="Назад" onClick="back()">

<script type="text/javascript">
    function back() {
    window.location = "index1.php?view_orders_history";
    }
</script>


  <br>
  <br>

                  
