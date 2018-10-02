
<br><br>
<table width="100%" align="center" >
    <tr align="center">
        <h2 style="text-align: center;">История заказов </h2>
    </tr>
    <tr style="text-align: center;">
        <th style="text-align: center;">Номер заказа</th>
        <th style="text-align: center;">Дата заказа</th>
        <th style="text-align: center;">Статус</th>

    </tr>

    <?php

    include("../inc/db.php");


    // this is for customer details
    if (isset($_SESSION['customer_id'])) {


        $customer_id= $_SESSION['customer_id'];


        $get = "select 

                     so.id ,
                     d.name as distributor_name,
                     com.name as company_name,
                     so.registration_date as order_date,
                     pt.onscreen_status as status,
                     d.id as distributor_id
                     

                  from 
                       simple_order so 
                    
                       join product_item pt on pt.cart_id = so.cart_id
                       join cart crt on crt.id = so.cart_id
                       join product p  on p.id = pt.product_id
                       join distributor d on p.distributor_id = d.id
                       join company com on d.company_id = com.id
                       join customer c on c.id = crt.customer_id


                  where c.id = '$customer_id' group by so.id ";

        $run = mysqli_query($con, $get);
        if (!$run) {
            printf("Error: %s\n", mysqli_error($con));
            exit();
        }/// helps to check error


        while($rows = mysqli_fetch_array($run)) {

            $order_id = $rows['id'];
            $order_date = $rows['order_date'];
            $distributor_name = $rows['distributor_name'];
            $distributor_id = $rows['distributor_id'];
            $company_name = $rows['company_name'];
            $status = $rows['status'];

            $currentStatus = null;
            if($status == 'Отправил'){
                $currentStatus = 'Отправил';
            }elseif ($status == 'Принял' || $status == 'Отказ'){
                $currentStatus = 'Заказ Закрыт';
            }elseif ($status == 'В обработку'){
                $currentStatus = 'В обработку';
            }

            ?>

            <tr align="center">
                <td><?php echo  $order_id ;  ?></td>

                <td><?php echo $order_date; ?></td>

                <td><a href="my_account.php?check_order_history_details=<?php echo $order_id;  ?>"><?php echo $currentStatus; ?></a></td>
            </tr>
            <?php
        }
    }

    ?>


</table>
<br>
<br>


