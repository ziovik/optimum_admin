
<br><br>
<table width="100%" align="center" >
	<tr align="center">
		<h2 style="text-align: center;">Посмотреть все истории заказов здесь</h2>
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
         if (isset($_GET['check_order_history'])) {
           $check_order_history = $_GET['check_order_history'];
         

    $i= 0;

       if (isset($_SESSION['distributor_id'])) {
         
       

       $dist_id= $_SESSION['distributor_id'];

       $total = 0;
         $get = "select 

                     com.name as company_name,
                     so.registration_date as order_date,
                     so.id as order_id,
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


                  where d.id = '$dist_id' AND so.id = '$check_order_history' AND (pt.onscreen_status ='Принял' OR pt.onscreen_status='Отказ')  ";

                  $run = mysqli_query($con, $get);

                  if (!$run) {
             printf("Error: %s\n", mysqli_error($con));
            exit();
           }/// helps to check error

                 while($rows = mysqli_fetch_array($run)) {
                   $cart_id = $rows['cart_id'];
                   $status = $rows['status'];
                  $order_date = $rows['order_date'];
                  $customer_name = $rows['customer_name'];
                  $customer_id = $rows['customer_id'];
                  $product_name = $rows['product_name'];
                  $pro_item_id = $rows['product_id'];
                  
                  $product_price = $rows['price'];
                  $quantity = $rows['quantity'];
                  $order_id = $rows['order_id'];


                                $i++;
                      
               
           
                              
     ?>

      <tr align="center">
            <td><?php echo $i;  ?></td>
            <td><?php echo $customer_name; ?></td>
            <td><?php echo $product_name; ?></td>
            <td><?php echo $product_price; ?></td>
            <td><?php echo $quantity; ?></td>  
            <td><?php echo $order_date; ?></td> 
           
    
            <th><?php echo $status; ?></th>
      </tr>


<?php } } }?> 

</table>
<br>
<br>



<div style="float: right;">
    <form method="post" action="excel_history.php?order_id=<?php echo $order_id ?> & customer_id=<?php echo $customer_id ?>">
        <input type="submit" id="btnID"  name="export_excel_history" class="btn btn-success" value="Печать Заказы">
    </form>
</div>

<?php
  include("../inc/db.php");

  if (isset($_SESSION['distributor_id']))
      $dist_id = $_SESSION['distributor_id'];
      $sql = "select * from distributor where id = '$dist_id'";
      $result =mysqli_query($con, $sql);
      $rows = mysqli_fetch_array($result);
      $package = $rows['package'];



?>
<script>
    function myFunction() {
        var package = "<?php echo $package; ?>"


        if (package == 'not_full') {
            document.getElementById("btnID").disabled = true;
        }
        else{
            document.getElementById("btnID").disabled = false;
        }
    }
    window.addEventListener('load',myFunction);

</script>


