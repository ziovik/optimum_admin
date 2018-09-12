<table width="100%" align="center" >
  <tr align="center">
    <h2 style="text-align: center;">Посмотреть все активные заказы здесь</h2>
  </tr>
  <tr style="text-align: center;">
    <th >S/N</th>
    <th>Имя Клиента</th>

    <th>Дата заказа</th>
    <th>Действие</th>
    <th>Посметреть подробности</th>


  </tr>

  <?php

  include("../inc/db.php");


// this is for customer details
  if (isset($_SESSION['distributor_id'])) {
         
       

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
                       


                  where d.id = '$dist_id' AND (pt.onscreen_status='Отправил'  OR pt.onscreen_status='Смотрел') ";

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

            <td><a href="index1.php?customer_details=<?php echo $customer_id;  ?>" ><?php echo $customer_name;  ?>    &nbsp;&nbsp;<!--<i class='fa fa-envelope faa-shake animated fa-2x'></i>--><i class="fa fa-address-card" aria-hidden="true" ></i></a>  </td>
            <td><?php echo $order_date; ?>&nbsp;&nbsp;<i class="fa fa-calendar"></i></td>

            <td><a href="accept_all_success.php?accept_all=<?php echo $order_id;  ?>">Принимать Все<i class="fa fa-check" aria-hidden="true"></i></a></td>
            <td><a href="index1.php?check_order=<?php echo $order_id;  ?>">Подродность  <i class="fa fa-eye" style="font-size:15px;color:#800080;"></i></a></td>
          </tr>
          <?php  
        } 
      } 
    
  ?>


</table>
<br>
<br>

<!--open folder-->

