<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 8/3/2018
 * Time: 11:14 PM
 */

include ($_SERVER['DOCUMENT_ROOT']."/optimum-master/inc/db.php"); // need to be deleted!


function db_create_cart_for_customer($customer_id)
{
	global $con;
	$sql = "insert into cart (customer_id,status) values ('$customer_id','active')";
	mysqli_query($con, $sql);
}

function db_get_cart_id_by_customer($customer_id)
{
	global $con;
	$sql = "select * from cart where status = 'active' and customer_id = '$customer_id'";
	$result = mysqli_query($con, $sql);

	if (mysqli_num_rows($result) == 0) {
		return null;
	} else {
		$array = mysqli_fetch_assoc($result);
		return new Cart($array['id'], $array['customer_id'], $array['status']);
	}
}

function db_insert_customer_message($customer_id, $distributor_id, $message, $message_date)
{
	global $con;
	$sql = "
insert into customer_chat (customer_id, distributor_id, message, message_date)
values ('$customer_id', '$distributor_id', '$message', '$message_date')";
	mysqli_query($con, $sql);
}

function db_insert_distributor_message($distributor_id, $customer_id, $message, $message_date)
{
	global $con;
	$sql = "
insert into distributor_chat (customer_id, distributor_id, message, message_date)
values ('$customer_id', '$distributor_id', '$message', '$message_date')";
	mysqli_query($con, $sql);
}

function db_get_customer_messages($customer_id, $customer_name, $distributor_id)
{
	global $con;
	$sql =
		"select 
message, message_date
from customer_chat 
where 
customer_id ='$customer_id' and distributor_id = '$distributor_id'";

	$result = mysqli_query($con, $sql);
	$messages = array();

	while ($rows = mysqli_fetch_array($result)) {
		$message = $rows['message'];
		$message_date = $rows['message_date'];

		array_push($messages, new CustomerMessage($customer_name, $message, $message_date));
	}

	return $messages;
}

function db_get_distributor_messages($distributor_id, $distributor_name, $customer_id)
{
	global $con;
	$sql =
		"select 
message, message_date
from distributor_chat 
where 
distributor_id ='$distributor_id' and customer_id = '$customer_id'";

	$result = mysqli_query($con, $sql);
	$messages = array();

	while ($rows = mysqli_fetch_array($result)) {
		$message = $rows['message'];
		$message_date = $rows['message_date'];

		array_push($messages, new DistributorMessage($distributor_name, $message, $message_date));
	}

	return $messages;
}

function db_get_customer_active_cart_id($customer_id)
{
	global $con;

	$sql = "select id from cart where customer_id = '$customer_id' and status = 'active'";
	$result = mysqli_query($con, $sql);
	$rows = mysqli_fetch_array($result);
	return $rows["id"];
}

function db_add_product_to_active_cart($product_id, $product_quantity, $active_cart_id)
{
	global $con;

	$sql = "insert into product_item (product_id, quantity, cart_id, onscreen_status) 
    		values ('$product_id', '$product_quantity', '$active_cart_id', 'Отправил')";
	mysqli_query($con, $sql);
}

function db_update_product_in_active_cart($id, $product_quantity)
{
	global $con;

	$sql = "update product_item set quantity = '$product_quantity' where id ='$id'";
	mysqli_query($con, $sql);
}


function db_get_product_in_active_cart($product_id, $cart_id) {
	global $con;
	$sql = "select * from product_item where product_id = '$product_id' and cart_id = '$cart_id'";
	$result = mysqli_query($con, $sql);

	$product_item = null;

	while ($rows = mysqli_fetch_array($result)) {
		$product_item = new ProductItem(
			$rows["id"],
			$rows["product_id"],
			$rows["cart_id"],
			$rows["quantity"],
			null,
			null);
	}

	return $product_item;
}

function db_get_items_from_active_cart($customer_id) {
	global $con;

	$sql = "select p.*, pd.name as product_name, st.price as product_price from product_item p
join cart c on p.cart_id = c.id
join product pd on pd.id = p.product_id
join store_item st on st.product_id = pd.id
where c.customer_id = '$customer_id' and c.status = 'active'";
	$result = mysqli_query($con, $sql);

	$items = array();

	while ($rows = mysqli_fetch_array($result)) {
		$item = new ProductItem(
			$rows["id"],
			$rows["product_id"],
			$rows["cart_id"],
			$rows["quantity"],
			$rows["product_name"],
			$rows["product_price"]);
		array_push($items, $item);
	}

	return $items;
}

function db_delete_product_from_active_cart($id) {
	global $con;
	$sql = "delete from product_item where id = '$id'";
	mysqli_query($con, $sql);
}