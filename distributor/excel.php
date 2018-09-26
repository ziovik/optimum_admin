<?php
session_start();
include("../inc/db.php");

$output = '<meta http-equiv=Content-Type content="text/html; charset=utf-8">';
$i = 0;

if (isset($_SESSION['distributor_id'])) {

  if (isset($_GET['customer_id'])) {
    if (isset($_GET['order_id'])) {

    $order_id = $_GET['order_id'];
    $customer_id = $_GET['customer_id'];
    $dist_id = $_SESSION['distributor_id'];

    if (isset($_POST['export_excel'])) {


        $total = 0;
        $get = "select 
                     so.id as order_id,
                     com.name as company_name,
                     d.name as distributor_name,
                     c.name as customer_name,
                     con.email as customer_email,
                     con.telephone as customer_telephone,
                     r.name as customer_region,
                     st.name as street_name,
                     a.building as customer_building,
                     a.house as customer_house,
                     a.index_code as index_code
                    
                     

                from simple_order so 
                     join product_item pt on pt.cart_id = so.cart_id
                     join cart crt on crt.id = pt.cart_id
                     join product p on p.id = pt.product_id
                     join distributor d on d.id = p.distributor_id
                     join customer c on c.id = crt.customer_id
                     join company com on com.id = d.company_id
                     join contact con on con.id = c.contact_id
                     join region r on r.id = c.region_id
                     join address a on a.id = c.address_id
                     join street st on st.id = a.street_id
                     join store_item si on si.product_id = p.id
                     
               where d.id = '$dist_id'  AND  c.id = '$customer_id' AND so.id='$order_id' AND (pt.onscreen_status = 'Отправил' OR pt.onscreen_status = 'Смотрел' )
                      ";




        $run = mysqli_query($con, $get);

        $rows = mysqli_fetch_array($run);

       

        $output .= '
        <div style="text-align:center;">

       <h2 style="text-align:center;">' . $rows['company_name'] . ' </h2 ><h4 >заказ № ' . $order_id . '</h4>
       
       </div>
       <div>
       <p>От "' . $rows['customer_name'] . '" </p>
       <table>
           <tr>
             <td>Контактное лицо:</td>
             <td style="padding-left:100px;"><h4 > ' . $rows['customer_name'] . '<br> ' . $rows['customer_email'] . ', ' . $rows['customer_telephone'] . '</h4></td>
           </tr>
       </table>
       <br>
      <table>
           <tr>
              <td>Адрес Доставки:</td>
              <td style="padding-left:100px;"><h4>' . $rows['customer_region'] . '<br> ул.: ' . $rows['street_name'] . ', дом: ' . $rows['customer_building'] . ', кв. : ' . $rows['customer_house'] . ', почтовой адресс: ' . $rows['index_code'] . '</h4></td>

       </tr>
       </table>

       </div>

       
       <br>
       
       <table class="table" style= "font-family: arial, sans-serif; border-collapse: collapse; width: 100%;">
       <tr>
          <th style="width : 500px;  border: 1px solid #ddd; padding: 8px;  padding-top: 12px;padding-bottom: 12px; text-align: left; background-color: #800080;color: white;">наименование</th>
          <th style="width : 200px;  border: 1px solid #ddd; padding: 8px;  padding-top: 12px;padding-bottom: 12px; text-align: left; background-color: #800080;color: white;">Производитель</th>
          <th style="width : 50px;  border: 1px solid #ddd; padding: 8px;  padding-top: 12px;padding-bottom: 12px; text-align: left; background-color: #800080;color: white;">годен_до</th>
          <th style="width : 100px;  border: 1px solid #ddd; padding: 8px;  padding-top: 12px;padding-bottom: 12px; text-align: left; background-color: #800080;color: white;">Цена</th>
          <th style="width : 100px;  border: 1px solid #ddd; padding: 8px;  padding-top: 12px;padding-bottom: 12px; text-align: left; background-color: #800080;color: white;">количество</th>
          <th style="width : 100px;  border: 1px solid #ddd; padding: 8px;  padding-top: 12px;padding-bottom: 12px; text-align: left; background-color: #800080;color: white;">Cумма</th>
       </tr>

       ';

        $total = 0;
        $get_product = "select 
                              p.name as product_name,
                              p.manufacturer as manufacturer,
                              p.expires as expires,
                              st.price as price,
                              pt.quantity as quantity
                         
                         
                         from product_item pt 
                              join simple_order so on so.cart_id = pt.cart_id
                              join cart crt on crt.id = pt.cart_id
                              join product p on p.id = pt.product_id
                              join distributor d on d.id = p.distributor_id
                              join store_item st on st.product_id = p.id
                         
                              
                     
                         where d.id = '$dist_id' AND crt.customer_id = '$customer_id' AND so.id='$order_id' AND (pt.onscreen_status = 'Отправил' OR pt.onscreen_status = 'Смотрел' )
                         ";

        $run_product = mysqli_query($con, $get_product);


        while ($row = mysqli_fetch_array($run_product)) {


            $output .= '
            
            <tr >

            <td style="width : 500px; text-align:left;  border: 1px solid #ddd;padding: 8px;">' . $row['product_name'] . '</td>

            <td  style="width : 50px; text-align:center; border: 1px solid #ddd; padding: 8px;"">' . $row['manufacturer'] . '</td>
            <td  style="width : 50px; text-align:center; border: 1px solid #ddd; padding: 8px;"">' . $row['expires'] . '</td>
            <td  style="width : 50px; text-align:center; border: 1px solid #ddd; padding: 8px;"">' . $row['price'] . '</td>
            <td  style="width : 50px; text-align:center; border: 1px solid #ddd; padding: 8px;"">' . $row['quantity'] . '</td>
            <td  style="width : 50px; text-align:center; border: 1px solid #ddd; padding: 8px;"">' . ($row['quantity']) * ($row['price']) . '</td>

            </tr>
            ';


        }
    }

    $output .= '</table>';

    header("Content-Type: text/cvs; charset=utf-8");
    header("Content-Disposition: attachment; filename=download.cvs");
    echo $output;

}}}
?>