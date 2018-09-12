<table width="100%" align="center" >
  <tr align="center">
    <h2 style="text-align: center;">История заказов </h2>
  </tr>
  <tr style="text-align: center;">
    <th >S/N</th>
    <th>Имя Клиента</th>

    <th>Дата заказа</th>
    <th>Действие</th>

  </tr>

  <?php

  include("../inc/db.php");


// this is for customer details
  if (isset($_SESSION['distributor_id'])) {
         
       $status ='inactive';

       $dist_id= $_SESSION['distributor_id'];

       $i = 0;
         $get = "select 

                     
                     distinct c.name,
                     so.registration_date as order_date,
                     so.id as order_id,
                     c.id as customer_id
                     

                  from 
                       distributor d
                    
                     
                       join product p on p.distributor_id = d.id
                       join product_item pt on pt.product_id = p.id
                       join simple_order so on so.cart_id = pt.cart_id
                       join cart crt on crt.id = so.cart_id
                       join customer c on c.id = crt.customer_id
                       


                  where d.id = '$dist_id' AND (pt.onscreen_status='Принял'  OR pt.onscreen_status='Отказ') ";

                  $run = mysqli_query($con, $get);
                  if (!$run) {
             printf("Error: %s\n", mysqli_error($con));
            exit();
           }/// helps to check error
                  

                 while($rows = mysqli_fetch_array($run)) {

                  $order_id = $rows['order_id'];
                  $order_date = $rows['order_date'];
                  $customer_name = $rows['name'];
                  $customer_id = $rows['customer_id'];
        
                  $i++;
          ?>

          <tr align="center">
            <td><?php echo $i;  ?></td>
            <td><a href="index1.php?customer_details=<?php echo $customer_id;  ?>"><?php echo $customer_name;  ?></a>  </td>
            <td><?php echo $order_date; ?></td>

            <td><a href="index1.php?check_order_history=<?php echo $order_id;  ?>">check</a></td>
          </tr>
          <?php  
        } 
      } 
    
  ?>


</table>
<br>
<br>



