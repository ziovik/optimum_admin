
<table width="900px" align="center" >
  <tr align="center">
    <th colspan="5" ><h2 style="color: white; text-align: center;">Order details</h2></th>
  </tr>
  <tr style="text-align: center;">
    <td style="width: 300px;">Distributor name</td>
    <td> Region</td>
    <td>Product name</td>
    <td>Quantity</td>
    <td>price</td>
   

  </tr>

  <?php

  include("../inc/db.php");


// this is for customer details
  if (isset($_GET['order_details'])) {
     $order_details = $_GET['order_details'];
    
 

       $total = 0;
         $get = "select 

                     com.name as company_name,
                     c.name as customer_name,
                     r.name as customer_region,
                     p.name as product_name,
                     si.price as price,
                     pt.quantity as quantity
                    
                  from 
                       distributor d
                       
                       join company com on com.id = d.company_id
                       join product p on p.distributor_id = d.id
                       join product_item pt on pt.product_id = p.id
                       join simple_order so on so.cart_id = pt.cart_id
                       join cart crt on crt.id = so.cart_id
                       join customer c on c.id = crt.customer_id
                       join region r on r.id = c.region_id
                       join store_item si on si.product_id = p.id
                       


                  where so.id = '$order_details' ";

                  $run = mysqli_query($con, $get);
                  

                    while($rows = mysqli_fetch_array($run)){
                   
                      $customer_name = $rows['customer_name'];
                      $product_name = $rows['product_name'];
                      $region_name = $rows['customer_region'];
                      $product_quantity = $rows['quantity'];
                      $product_price = $rows['price'];
                      $distributor_name = $rows['company_name'];
                       
               
      ?>
          <tr style="text-align: center;">
            <td><?php echo $distributor_name;  ?></td>
            <td><?php echo $region_name;  ?></td>
            <td><?php echo $product_name;  ?></td>
            <td><?php echo $product_quantity;  ?></td>
            <td><?php echo $product_price;  ?></td>
          </tr>
      

       <?php
          } }  
       ?>




</table>
<input style="background:#800080; border-radius:5px; width: 80px; height: 50px; color: white;" class="btn next-btn" type="submit" value="Назад" onClick="back()">

<script type="text/javascript">
    function back() {
    window.location = "index.php?view_orders";
    }
</script>


  <br>
  <br>

                  
