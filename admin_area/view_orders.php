<table width="800" align="center" >
	<tr align="center">
		<td colspan="7"><h2>View all Orders Here</h2></td>
	</tr>
	<tr style="text-align: center;">
		<th>Order Number</th>
    <th>Customer Name</th>
		
		<th>Order Date</th>
		
		
	</tr>
     
     <?php

       include ("../inc/db.php");



       $get_order = "select 
                        distinct sm.id as order_id,
                        c.name as customer_name,
                        sm.registration_date,
                        
                        c.id as customer_id
                     from product_item pt
                        join cart crt on crt.id = pt.cart_id
                        join simple_order sm on sm.cart_id = pt.cart_id
                        join customer c on c.id = crt.customer_id
                        join product p on p.id = pt.product_id
                        join distributor d on d.id = p.distributor_id
                        join company com on com.id = d.company_id  ";

       $run_order = mysqli_query($con, $get_order);
       if (!$run_order) {
             printf("Error: %s\n", mysqli_error($con));
            exit();
           }/// helps to check error
     
       while($row_order = mysqli_fetch_array($run_order)){
       	//for deleting
        $order_id = $row_order['order_id'];
       	//deleting
        $customer_id = $row_order['customer_id'];
        $customer_name = $row_order['customer_name'];
       	$order_date = $row_order['registration_date'];
   
     ?>

     <tr align="center">
     	<td><a href="index.php?order_details=<?php echo $order_id ;  ?>"><?php echo $order_id ;  ?></td>
      <td><a href="index.php?customer_details=<?php echo $customer_id;  ?>"><?php echo $customer_name;  ?></a></td>
     	<td><?php echo $order_date; ?></td>    
      
     </tr>

<?php } ?>
</table

