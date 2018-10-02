<?php
include("inc/db.php");
$data = json_decode(file_get_contents('php://input'), true);
if (isset($_GET["action"])) {
    $action = $_GET["action"];


    switch ($action) {
        case "get_modal":
            get_modal();
            break;
    }
    return;
}



function get_modal(){
    global $con;

    if (!empty($_GET["pro_id"]) && !empty($_GET["pro_name"])) {


        $product_id = $_GET['pro_id'];
        $product_name = $_GET['pro_name'];

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
        }
    }

}

?>



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
