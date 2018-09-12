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
<h2 style="text-align: center;">Мои товары</h2>
<table width="100%" align="center" id='mytable'>
 <thead>
	<tr style="text-align: center;">
		
		<th style="width:400px; text-align: center;">Наимнование</th>
		
		<th>Цена (руб)</th>
		<th style="text-align: center;">Производитель</th>
    <th style="text-align: center;">Годен до</th>
    <th style="text-align: center;">Минимальная покупка</th>
    
    <th style="text-align: center;">Скидки</th>
    <th style="text-align: center;">Примечание</th>
	</tr>
</thead>     
     <?php

       include("../inc/db.php");
      

       if (isset($_SESSION['distributor_id'])) {

        $dist_id = $_SESSION['distributor_id'];

        $get = "select 
                  
                   p.name as product_name,
                   si.price as product_price,
                   p.manufacturer as manufacturer,
                   si.min_order as min_order,
                  
                   p.discount as discount,
                   p.expires as expires,
                   p.description as description
                from 
                    product p
                    join distributor d on d.id = p.distributor_id
                    join store_item si on si.product_id = p.id
                   
                where d.id = '$dist_id'";

          $run = mysqli_query($con, $get);
           if (!$run ) {
             printf("Error: %s\n", mysqli_error($con));
            exit();
           }/// helps to check error


          while($rows = mysqli_fetch_array($run)){
            $product_name = $rows['product_name'];
            $product_price = $rows['product_price'];
            $manufacturer = $rows['manufacturer'];
            $expires = $rows['expires'];
            $min_order = $rows['min_order'];
            
            $discount = $rows['discount'];
            $desc = $rows['description'];
     
     ?>
    <tbody>
     <tr align="center">
     	
     	<td ><?php echo $product_name; ?></td>
     	<td><?php echo $product_price; ?></td>
      <td><?php echo $manufacturer; ?></td>
      <td><?php echo $expires; ?></td>
      <td><?php echo $min_order; ?></td>
     
      <td><?php echo $discount ; ?></td>
      <td><?php echo $desc ; ?></td>

     </tr>
    </tbody>
    <?php } } ?>

</table>
<div class="pagination-container" style="padding-left:300px; ">
  <nav>
     <ul class="pagination"></ul>
  </nav>
</div>

 <script >
         var table = '#mytable'
         $('#maxRows').on('change', function(){
          $('.pagination').html('')
          var trnum = 0
          var maxRows = parseInt($(this).val())
          var totalRows = $(table+' tbody tr').length
          $(table+' tr:gt(0)').each(function(){
            trnum++
            if(trnum > maxRows){
              $(this).hide()
            }
            if (trnum <= maxRows) {
              $(this).show()
            }
          })
          if (totalRows > maxRows) {
            var pagenum = Math.ceil(totalRows/maxRows)
            for (var i=1; i<=pagenum;) {
              $('.pagination').append('<li data-page="'+i+'"> \ <span>'+ i++ +'<span class="sr-only">(current)</span></span> \ </li>').show()
            }
          }
          $('.pagination li:first-child').addClass('active')
          $('.pagination li').on('click', function(){
            var pageNum = $(this).attr('data-page')
            var trIndex = 0;
            $('.pagination li').removeClass('active')
            $(this).addClass('active')
            $(table+' tr:gt(0)').each(function(){
              trIndex++
              if (trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)) {
                $(this).hide()
              }else{
                $(this).show()
              }
            })
          })
         })
         $(function(){
          $('table tr:eq(0)').prepend('<th>ID</th>')
          var id = 0;
          $('table tr:gt(0)').each(function(){
            id++
            $(this).prepend('<td>'+id+'</td>')
          })
         })
      </script>
     