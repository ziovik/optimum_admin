<table width="100%" align="center" >
  <tr align="center">
    <td colspan="7"><h2>Посмотреть все заявки здесь</h2></td>
  </tr>
  <tr style="text-align: center;">
    <th >S/N</th>
    <th>Имя Клиента</th>
    <th>наименование товара</th>
    <th>Цена</th>
    <th>Количество</th>
    <th>Дата заказа</th>
    <th>действие</th>

    
  </tr>
      <?php

      

       include("../inc/db.php");
         if (isset($_GET['check_order'])) {
           $check_order = $_GET['check_order'];
         

      $i=0;
     // this is for order details

       if (isset($_SESSION['distributor_id'])) {
         
       

       $dist_id= $_SESSION['distributor_id'];

       $total = 0;
         $get = "select 

                     com.name as company_name,
                     so.registration_date as order_date,
                     c.name as customer_name,
                     c.id as customer_id,
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
                     pt.id as product_item,
                     ct.telephone as telephone,
                     crt.id as cart_id,
                     so.id as order_id,
                     pt.id as product_id,
                     pt.onscreen_status as status




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


                  where d.id = '$dist_id' AND so.id = '$check_order' AND (pt.onscreen_status='Отправил'  OR pt.onscreen_status='Смотрел')";

                  $run = mysqli_query($con, $get);

                  

                 while($rows = mysqli_fetch_array($run)) {
                   $cart_id = $rows['cart_id'];
                   $status = $rows['status'];
                  $order_date = $rows['order_date'];
                  $customer_name = $rows['customer_name'];
                  $customer_id = $rows['customer_id'];
                  $product_name = $rows['product_name'];
                  $pro_item_id = $rows['product_id'];
                  $order_id = $rows['order_id'];
                  $product_price = $rows['price'];
                  $quantity = $rows['quantity'];


                                $i++;

           
                              
     ?>

      <tr align="center">
            <td><?php echo $i;  ?></td>
            <td><?php echo $customer_name; ?></td>
            <td><?php echo $product_name; ?></td>
            <td><?php echo $product_price; ?></td>
            <td><?php echo $quantity; ?></td>  
            <td><?php echo $order_date; ?></td> 
           
            
            
            <td>
              


              <button type="submit"  class="btn btn-default " onclick="seen_order()"> В обработку<i class="fa fa-spinner fa-spin" style="font-size:24px"></i></button>
             <br><hr>

               <button type="submit"  class="btn btn-default " onclick="accept_order()"> Выполнить<i class="fa fa-check" aria-hidden="true"></i></button>
             <br><hr>

               <button type="submit"  class="btn btn-default " onclick="reject_order()"> Отклонить<i class="fa fa-close" style="font-size:28px;color:red"></i></button>
             <br><hr>

              

            </td>
            <th><?php echo $status; ?></th>
      </tr>


<?php } } }?> 

</table>
<br>
<br>
<form  method="post" action="excel.php?order_id=<?php echo $order_id ?> & customer_id=<?php echo $customer_id ?>">
  <input type="submit" name="export_excel" class="btn btn-success" value="Печать ">
  
</form>

<!--onblur="validate()" disabled="false" -->

<script>
function seen_order() {
    var txt;
    if (confirm("Вы смотрели заказы или нет?")) {
        txt = "Вы смотрели заказы или нет?";
        window.location = 'index1.php?seen_order=<?php echo $pro_item_id;  ?>';
    } else {
         nope
    }
    document.getElementById("demo").innerHTML = txt;
}

function accept_order() {
    var txt;
    if (confirm("Вы точно хотете подтвердить заказ?")) {
        txt = "Вы точно хотете подтвердить заказ?";
        window.location = 'index1.php?confirm_order=<?php echo $pro_item_id;  ?>';
    } else {
         nope
    }
    document.getElementById("demo").innerHTML = txt;
}

function reject_order() {
    var txt;
    if (confirm("Вы точно хотете Отклонить этот заказ?")) {
        txt = "Вы точно хотете Отклонить этот заказ?";
        window.location = 'index1.php?reject_order=<?php echo $pro_item_id;  ?>';
    } else {
         nope
    }
    document.getElementById("demo").innerHTML = txt;
}
</script>
