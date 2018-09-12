<?php
session_start();

include("../inc/db.php");



$query = "
          select 
            p.name,
            p.id as product_id,
            p.manufacturer ,
            st.price , 
            st.min_order ,
            p.expires ,
            p.description ,
            p.discount ,
            cm.name as company_name 
          from 

              store s
              join distributor d on d.id = s.distributor_id
              join product p on p.distributor_id = d.id
              join customer c on c.region_id = s.region_id
              join company cm on cm.id = d.company_id
              join store_item st on st.product_id = p.id
      
     where  d.id = '2'";
$run = mysqli_query($con, $query);
$row = mysqli_fetch_array($run);

$product_id = $row['product_id'];

?>

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
			

		</tr>
       </thead>

		<?php
         $i = 0;
		include("../inc/functions.php");
		global $con;
		$output = '';
		


		if (isset($_POST["query"])) {
			$search = mysqli_real_escape_string($con, $_POST["query"]);
			$query = "
          select 
            p.name,
            p.id as product_id,
            p.manufacturer ,
            st.price , 
            st.min_order ,
            p.expires ,
            p.description ,
            p.discount ,
            cm.name as company_name 
          from 

              store s
              join distributor d on d.id = s.distributor_id
              join product p on p.distributor_id = d.id
              join customer c on c.region_id = s.region_id
              join company cm on cm.id = d.company_id
              join store_item st on st.product_id = p.id
      
     where  d.id = '2'
  AND p.name LIKE '%" . $search . "%'
  
 ";
		} else {
			$query =
				"select 
            p.id as product_id,
            p.name , 
            p.manufacturer ,
            st.price , 
            st.min_order ,
            p.expires ,
            p.description ,
            p.discount ,
            cm.name as company_name
      from 

              store s
              join distributor d on d.id = s.distributor_id
              join product p on p.distributor_id = d.id
              join customer c on c.region_id = s.region_id
              join company cm on cm.id = d.company_id
              join store_item st on st.product_id = p.id
      
      where  d.id = '2'
         
 ";
		}
		$result = mysqli_query($con, $query);
		if (!$result) {
			printf("Error: %s\n", mysqli_error($con));
			exit();
		}/// helps to check error

		$count_result = mysqli_num_rows($result);
		if ($count_result == 0) {
			echo "<h2>'нет продукта'</h2>";
		} else {

			while ($row_pro = mysqli_fetch_array($result)) {
				$pro_id = $row_pro['product_id'];
				$pro_expires = $row_pro['expires'];
				$pro_name = $row_pro['name'];
				$pro_price = $row_pro['price'];
				$pro_desc = $row_pro['description'];
				$pro_manu = $row_pro['manufacturer'];
				$pro_min_order = $row_pro['min_order'];
				$pro_dist = $row_pro['company_name'];
				$pro_discount = $row_pro['discount'];

               $i++;
				?>

				<tbody>
				<tr>


						<td data-priority='1' style='background: white; color: #400040;'><?php echo $pro_dist ?></td>
						<td data-priority='2' style='background: white; color: #400040; width: 400px;'><a
									href='details.php?pro_id=<?php echo $pro_id ?>'
									style="max-width: 500px;"><?php echo $pro_name ?></a></td>
						<td data-priority='3' style='background: white; color: #400040;'><?php echo $pro_manu ?></td>


						<td data-priority='4' style='background: white; color: #400040;'><?php echo $pro_price ?></td>

						<td data-priority='5' style='background: white; color: #400040;'><?php echo $pro_expires ?></td>
						<td data-priority='6'
							style='background: white; color: #400040;'><?php echo $pro_min_order ?></td>
						<td data-priority='7' style='background: white; color: #400040;'><?php echo $pro_desc ?></td>


				</tr>
               </tbody>

				<?php
			}

		}

		?>
	
	</table>
	
<div class="pagination-container" style="padding-left:300px; ">
    	<nav>
    		<ul class="pagination"></ul>
    	</nav>
    </div>

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