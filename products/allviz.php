<?php
   session_start();
   include("../inc/db.php");
   include("../inc/functions.php");
   
   //for not acceessing this page by another person who is not in admin
   
   if (!isset($_SESSION['customer_id'])) {
    echo "<script>window.open('customer/customer_login.php?not_admin=You are not signed in!','_self')</script>";
   } else {
   //end
   
   
    ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title>OPTIMUM BEAUTY | PRODUCT</title>
      <!-- Google font -->
      <link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">
      <!-- Bootstrap -->
      <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css" />
      <!-- Slick -->
      <link type="text/css" rel="stylesheet" href="../css/slick.css" />
      <link type="text/css" rel="stylesheet" href="../css/slick-theme.css" />
      <!-- nouislider -->
      <link type="text/css" rel="stylesheet" href="../css/nouislider.min.css" />
      <!-- Font Awesome Icon -->
      <link rel="stylesheet" href="../css/font-awesome.min.css">
      <!-- Custom stlylesheet -->
      <link type="text/css" rel="stylesheet" href="../css/style.css" />
      <link type="text/css" rel="stylesheet" href="../css/table.css" />
      <link type="text/css" rel="stylesheet" href="../css/checkout_style.css" />
      <!--table resp-->
      <link rel="stylesheet" href="../css/rwd-table.min.css">
      
      <script type="text/javascript">
         var _gaq = _gaq || [];
         _gaq.push(['_setAccount', 'UA-19870163-1']);
         _gaq.push(['_trackPageview']);
         
         (function() {
             var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
             ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
             var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
         })();
      </script>
   </head>
   <body>
      <!-- HEADER -->
     <?php include("inc_products/header.php")  ?>
     <!-- HEADER -->
      <!-- NAVIGATION -->
      <?php include("inc_products/navigation.php")   ?>
      <!-- NAVIGATION -->
      <!-- BREADCRUMB -->
      <div id="breadcrumb">
         <div class="container">
            <ul class="breadcrumb">
               <li><a href="../optimum_beauty.php">Главная</a></li>
               <li class="active">Визаж </li>
            </ul>
         </div>
      </div>
      <!-- /BREADCRUMB -->
      <!-- HOME -->
      <div id="home">
         <!-- container -->
         <div class="container" style="min-height: 600px;">
            <!-- home wrap -->
            <div class="home-wrap">
               <!-- home slick -->
               <div>
                  <?php cart(); ?>
                  <!-- banner -->
                  <br>
               <h4>Выберите количество строк</h4>
               <div class="form-group">
                  <select name="state" id="maxRows" class="form-control" style="width: 150px;">
                     <option value="5000">Показать все...</option>
                     <option value="5">5</option>
                     <option value="10">10</option>
                     <option value="15">15</option>
                     <option value="20">20</option>
                     <option value="25">25</option>
                  </select>
               </div>
               <div style="overflow-x:auto;">
                  <table cellspacing="0" id='mytable'
                     class="table table-small-font table-bordered table-striped" style="width: 100%;">
                     <thead>
                        <tr>
                           <th colspan="1" data-priority="2">Дистрибьютор</th>
                           <th colspan="1" data-priority="3" style=" width: 500px;">Найменование</th>
                           <th colspan="1" data-priority="4">Производитель/<br>Страна производства</th>
                           <th colspan="1" data-priority="5">Цена</th>
                           <th colspan="1" data-priority="6">Годен до</th>
                           <th colspan="1" data-priority="7">Остаток</th>
                           <th colspan="1" data-priority="8">Примечание</th>
                        </tr>
                     </thead>
                              <?php
                                 include("../inc/db.php");
                                 if(isset($_SESSION['customer_id'])){
                                                         $customer_id = $_SESSION['customer_id'];
                                 
                                 
                                 
                                 if (isset($_GET['allviz'])) {
                                                             $allviz_id = $_GET['allviz'];
                                                             $get_allviz_pro =
                                                                 "select 
                                                                   p.id as product_id, 
                                                                   p.name as product_name, 
                                                                   p.manufacturer as product_manufacturer,
                                                                   st.price as product_price, 
                                                                   st.min_order as product_min_order,
                                                                   p.expires as expires,
                                                                   p.description as discription,
                                                                   p.discount as discount,
                                                                   cm.name as company_name
                                                                   
                                                              from
                                                                 store s
                                                                 join distributor d on d.id = s.distributor_id
                                                                 join product p on p.distributor_id = d.id
                                                                 join customer c on c.region_id = s.region_id
                                                                 join company cm on cm.id = d.company_id
                                                                 join sub_category sb on sb.id = p.sub_category_id
                                                                 join category ct on ct.id = sb.category_id
                                                                 join store_item st on st.product_id = p.id
                                                                 
                                                                 where c.id ='$customer_id' and ct.id= '$allviz_id'";
                                 
                                                             $run_allviz_pro = mysqli_query($con, $get_allviz_pro);
                                 
                                                             
                                  $count_allviz = mysqli_num_rows($run_allviz_pro);
                                 
                                  if ($count_allviz == 0) {
                                      echo "<h2 style='text-align:center;'>Нет продукта</h2>";
                                                             } else {
                                      while($row_allviz_pro=mysqli_fetch_array($run_allviz_pro)) {
                                      $pro_id = $row_allviz_pro['product_id'];
                                      $pro_name = $row_allviz_pro['product_name'];
                                      $pro_manu = $row_allviz_pro['product_manufacturer'];
                                      $pro_price = $row_allviz_pro['product_price'];
                                      $pro_dist = $row_allviz_pro['company_name'];
                                                                     $pro_min_order = $row_allviz_pro['product_min_order'];
                                                                     $pro_expires = $row_allviz_pro['expires'];
                                                                     $pro_desc = $row_allviz_pro['discription'];
                                 
                                      ?>
                               <tbody>
                        <tr>
                           <th data-priority="1"
                              style="background: white; color: #400040;"><?php echo $pro_dist ?></th>
                           <th data-priority="2" style="background: white; color: #400040; width: 500px;">
                              <a href="../details.php?pro_id=<?php echo $pro_id ?>"><?php echo $pro_name ?></a>
                           </th>
                           <th data-priority="3"
                              style="background: white; color: #400040;"><?php echo $pro_manu ?></th>
                           <th data-priority="4"
                              style="background: white; color: #400040;"><?php echo $pro_price ?></th>
                           <th data-priority="5"
                              style="background: white; color: #400040;"><?php echo $pro_expires ?></th>
                           <th data-priority="5"
                              style="background: white; color: #400040;"><?php echo $pro_min_order ?></th>
                           <th data-priority="5"
                              style="background: white; color: #400040;"><?php echo $pro_desc ?></th>
                        </tr>
                     </tbody>
                     <?php } } } }?>    
                  </table>
                  <div class="pagination-container" style="padding-left:300px; ">
                     <nav>
                        <ul class="pagination"></ul>
                     </nav>
                  </div>
                     </div>
                  </div>
                  <br>
               </div>
               <!-- /section -->
            </div>
            <!-- /row -->
         </div>
         <!-- /container -->
      </div>
      <!-- /section -->
     <?php include("inc_products/footer.php")  ?>
     <?php } ?>