<?php
include("inc/db.php");
include("db_objects/product.php");

if (isset($_GET['pro_id'])) {
    $product_id = $_GET['pro_id'];
    $sql = "select 
                 p.id as id,
                 p.name as name,
                 st.price as price,
                 p.distributor_id as distributor_id,
                 p.manufacturer as manufacturer,
                 p.description as description,
                 st.min_order as min_order,
                 c.name as company_name,
                 st.max_order as max_order 
              from product p 
                   join store_item st on st.product_id = p.id
                   join distributor d on d.id = p.distributor_id
                   join company c on c.id = d.company_id
                   
              where p.id='$product_id'";
    $result = mysqli_query($con, $sql);
    $product = null;
    while ($rows = mysqli_fetch_array($result)) {
        $pro_id = $rows['id'];
        $pro_name = $rows['name'];
        $pro_price = $rows['price'];
        $pro_dist = $rows['distributor_id'];
        $pro_desc = $rows['description'];
        $min_order = $rows['min_order'];
        $max_order = $rows['max_order'];
        $pro_manu = $rows['manufacturer'];
        $dist_name = $rows['company_name'];
        $product = new Product($pro_id, $pro_name, $pro_desc, $pro_manu, null, $pro_price, $pro_dist, null, $min_order, $dist_name );
    }
    print_r(json_encode($product));
}