<?php
/**
 * Created by PhpStorm.
 * User: nd
 * Date: 04.08.18
 * Time: 21:37
 * @param $product_id
 * @param $customer_id
 * @param $quantity
 */



function add_product_to_cart($product_id, $customer_id, $quantity)
{
	show_message($quantity);
	return;

	if (db_get_cart_id_by_customer($customer_id) == null) {
		db_create_cart_for_customer($customer_id);
	}

	$cart = db_get_cart_id_by_customer($customer_id);
	add_to_product_item($cart->id, $product_id, $quantity);
	$_SESSION['product_item_number'] = get_product_items_in_cart_for_customer_id($customer_id, 'active');
}
