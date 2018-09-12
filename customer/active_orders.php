<table width="800" align="center" >
   <h2 style="text-align: center;">Активный заказ</h2>
   <tr style="text-align: center;">
      <th style="text-align: center;">S/N</th>
      <th style="text-align: center;">Номер Заказа</th>
      <th style="text-align: center;">Дата</th>
      <th style="text-align: center;">Действие</th>
   </tr>
   <?php
      include("../inc/db.php");
      
      if (isset($_GET['active_orders'])){
      
       $active_orders = $_GET['active_orders'];
      
        if (isset($_SESSION['customer_id'])) {
      
      // this is for customer details
       $customer_id = $_SESSION['customer_id'];
       
       
       $i= 0;
      
         
         $get_order = "select 
                          distinct so.id as order_id,
                          so.registration_date
                         
                      from 
                           cart c
                           join product_item pt on pt.cart_id = c.id
                           join simple_order so on so.cart_id = pt.cart_id
                      where c.customer_id = '$customer_id' AND  (pt.onscreen_status = 'Отправил'   or pt.onscreen_status = 'Смотрел')  ";
      
         $run_order = mysqli_query($con, $get_order);
      
         while ($row_order = mysqli_fetch_array($run_order)) {
             $order_date = $row_order['registration_date'];
      
             $order_id = $row_order['order_id'];
      
             $i++;
         
         
         
         ?>
   <tr align="center">
      <td><?php echo $i;  ?></td>
      <td><?php echo $order_id ; ?></td>
      <td><?php echo $order_date; ?></td>
      <td><a  href="my_account.php?my_orders=<?php echo  $order_id; ?>">Подробность</a></td>
   </tr>
   <?php } } }?>
</table>