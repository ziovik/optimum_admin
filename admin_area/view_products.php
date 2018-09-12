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
    <option value="50">50</option>

  </select>
</div>
<div style="overflow-x:auto;">
  <table cellspacing='0' id='mytable' class='table table-small-font table-bordered table-striped'>
    <thead>
    <tr>

      <th colspan='1' data-priority="1" style="text-align: center;">Дистрибьютор</th>

      <th colspan='1' data-priority="2" style="text-align: center; max-width: 500px;">Найменование</th>
      <th colspan='1' data-priority="3" style="text-align: center;">Производитель/<br>Страна производства</th>


      <th colspan='1' data-priority="4" style="text-align: center;">Цена<br>(руб.)</th>
      <th colspan='1' data-priority="5" style="text-align: center;">Годен до</th>
      <th colspan='1' data-priority="6" style="text-align: center;">Остаток</th>
      <th colspan='1' data-priority="7" style="text-align: center;">Примечание</th>
      <th colspan='1' data-priority="6" style="text-align: center;">Edit</th>
      <th colspan='1' data-priority="7" style="text-align: center;">Delete</th>

    </tr>

     </thead>
     
     <?php
     include("../inc/db.php");

      $query =
        "select 
            p.id as product_id,
            p.name , 
            p.manufacturer ,
            si.price , 
            si.min_order ,
            p.expires ,
            p.description ,
            p.discount ,
            cm.name as company_name
      from 

            product p
            join distributor d on d.id = p.distributor_id
            join company cm on cm.id = d.company_id
            join store_item si on si.product_id = p.id
      ORDER BY p.id ASC
      ";
     
 
    $run = mysqli_query($con, $query);


    if (!$run) {
      printf("Error: %s\n", mysqli_error($con));
      exit();
    }/// helps to check error

      while ($row_pro = mysqli_fetch_array($run)) {
        $pro_id = $row_pro['product_id'];
        $pro_expires = $row_pro['expires'];
        $pro_name = $row_pro['name'];
        $pro_price = $row_pro['price'];
        $pro_desc = $row_pro['description'];
        $pro_manu = $row_pro['manufacturer'];
        $pro_min_order = $row_pro['min_order'];
        $pro_dist = $row_pro['company_name'];
        $pro_discount = $row_pro['discount'];


     ?>

     <tbody>
        <tr>


            <td data-priority='1' style='background: white; color: #400040;'><?php echo $pro_dist ?></td>
            <td data-priority='2' style='background: white; color: #400040; width: 400px;'>
                  <?php echo $pro_name ?></td>
            <td data-priority='3' style='background: white; color: #400040;'><?php echo $pro_manu ?></td>


            <td data-priority='4' style='background: white; color: #400040;'><?php echo $pro_price ?></td>

            <td data-priority='5' style='background: white; color: #400040;'><?php echo $pro_expires ?></td>
            <td data-priority='6'
              style='background: white; color: #400040;'><?php echo $pro_min_order ?></td>
            <td data-priority='7' style='background: white; color: #400040;'><?php echo $pro_desc ?></td>

            <td><a href="index.php?edit_product=<?php echo $pro_id; ?>">Edit</a></td>
            <td><a href="delete_product.php?delete_product=<?php echo $pro_id; ?>">Delete</a></td>
        </tr>
                    
      </tbody>
                  

    <?php }  ?>

</table>
<div class="pagination-container" ">
      <nav>
        <ul class="pagination"></ul>
      </nav>
</div>

