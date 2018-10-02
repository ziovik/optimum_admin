<script>
    let currProId = null, currProName = null;
</script>
<?php
session_start();

include("inc/db.php");

//getting customer details
$customer_id = $_SESSION['customer_id'];



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
      
     where c.id = '$customer_id'";
$run = mysqli_query($con, $query);
$row = mysqli_fetch_array($run);
$count_result = mysqli_num_rows($run);



$product_id = $row['product_id'];

?>
<br>
<h4>Выберите количество строк</h4>
<div class="form-group">

	<select name="state" id="maxRows" class="form-control" style="width: 170px; height: 50px;">
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
		include("inc/functions.php");
		global $con;
		$output = '';
		//getting customer details
		$customer_id = $_SESSION['customer_id'];

        // determine which page the customer is currently on  LIMIT 
 //".$this_page_first_result. ',' .$result_per_page.
          

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
      
     where c.id = '$customer_id'
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
      
      where c.id = '$customer_id'  ";
     
 
		}
		$run = mysqli_query($con, $query);


		if (!$run) {
			printf("Error: %s\n", mysqli_error($con));
			exit();
		}/// helps to check error

		$count_result = mysqli_num_rows($run);
		if ($count_result == 0) {
			echo "<h2>'нет продукта'</h2>";
		} else {

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

			


               $i++;
				?>
				<tbody>
				<tr>


						<td data-priority='1' style='background: white; color: #400040;'><?php echo $pro_dist ?></td>
						<td data-priority='2' style='background: white; color: #400040; width: 400px;'>
                            <!--<a
									href='details.php?pro_id=<?php echo $pro_id ?>'
									style="max-width: 500px;"><?php echo $pro_name ?>
                            </a>-->



                            <a href="#" id="product_<?php echo $pro_id; ?>" onclick="modalPop(<?php echo
                            $pro_id; ?>)" style="max-width: 500px;" data-toggle="modal"
                                    data-target="#myModal"> <?php echo $pro_name ?>
                            </a>

                            <script>
                                function modalPop(productId) {
                                    alert('Hello');

                                        /*let popUp = document.getElementById('product_' + currProId);

                                        if (popUp == null) {
                                            console.log('Modal is not found');
                                            return;
                                        }*/
                                        console.log('productId: ' + productId);
                                        debugger

                                        let product = {
                                            'product_id': currProId,
                                            'product': productId,
                                            'customer_id': <?php echo $_SESSION["customer_id"]; ?>
                                        };

                                        let data = JSON.stringify(product);

                                        $.ajax({
                                            method: 'POST',
                                            url: 'modal_product.php?action=Product sent to modal',
                                            data: data,
                                            success: function () {
                                                loadModal();
                                            },
                                            error: function (error) {
                                                console.log(error);
                                            }
                                        });

                                        popUp.value = '';

                                }
                                function loadModal() {
                                    if (currProId == null) return;
                                    let ProductId = '<?php echo $pro_id; ?>';
                                    let ProductName = '<?php echo $pro_name; ?>';

                                    if (ProductId == undefined && ProductName == undefined) return;

                                    $.ajax({
                                        method: 'GET',
                                        url: 'modal_product.php?action=get_modal&pro_id=' + ProductId
                                        + '&pro_name=' + ProductName,

                                        success: function (data) {
                                            let popModal = document.getElementById('myModal' + currProId);
                                            if (popModal != null) popModal.innerHTML = data;
                                        },
                                        error: function () {
                                            console.log('error');
                                        }
                                    });
                                }
                            </script>

                        </td>


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
    <div class="pagination-container" >
    	<nav>
    		<ul class="pagination"></ul>
    	</nav>
    </div>

</div>
<div id="tmpModal"></div>

<!--modal start-->
<div class="modal fade"  id="myModal<?php echo $pro_id; ?>" role="dialog">
    <!-- modal dialog -->
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- modal header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="mohe">
                    <h4 class="modal-title"> Подробность</h4>
                </div>
            </div>
            <!-- end modal header-->
            <!-- modal body -->
            <div class="modal-body">
                <form role="form" action="#" method="post">
                    <fieldset>
                        <legend><h2 class="product-name" style="text-align: justify; width:100%;font-size: 16px;"><?php echo $pro_name; ?></h2></legend>
                        <div class="form-group col-xs-6">
                            <label for="name"> Цена: <?php echo number_format($pro_price, 2); ?> руб.</label>

                        </div>

                        <div class="form-group col-xs-6">
                            <label for="email"> минимальное количество: <?php echo $min_order; ?> </label>
                            <div>
                                <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o empty"></i>
                                </div>

                            </div>
                        </div>

                        <div class="form-group col-xs-6">
                            <label for="tel"> Количество:</label>
                            <div class="qty-input">

                                <input id="product_id" type="hidden" name="product_id" value="<?php echo $pro_id;
                                ?>">
                                <input id="product_quantity" class="input" type="number" name="product_quantity"
                                       value="<?php echo $min_order;?>">

                            </div>
                        </div>

                        <div class="form-group col-xs-6">
                            <label for="text"> Дистрибьютор: <?php echo $dist_name; ?></label>

                        </div>
                    </fieldset>

                    <fieldset>
                        <legend> Производитель/Страна пройзводителя:</legend>
                        <div class="form-group col-xs-12">
                            <div class="product-btns">


                            </div>

                        </div>

                        <div class="form-group col-xs-12">
                            <label for="comment"> Примечание: </label>
                            <textarea class="form-control" rows="5" id="comment"></textarea>
                        </div>
                    </fieldset>
                </form>
            </div>
            <!-- end modal body -->
            <!-- modal footer-->
            <div class="modal-footer">
                <div class="mohe">

                    <button type="submit" class="btn btn-default btn-md btn-sm" data-dismiss="modal" style="width: 200px;">Добавить в корзину</button>
                    <button type="submit" class="btn btn-default btn-md btn-sm" data-dismiss="modal"> отмена</button>
                </div>
            </div>
            <!-- end modal footer -->
        </div>
        <!-- end modal content-->
    </div>
    <!-- end modal dialog-->
</div>



<!--modal end-->
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

