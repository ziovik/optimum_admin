<?php
/**
 * Created by PhpStorm.
 * User: nd
 * Date: 31.08.18
 * Time: 22:17
 */

class ProductItem
{
	public $id;
	public $product_id;
	public $cart_id;
	public $quantity;
	public $product_name;
	public $product_price;

	/**
	 * ProductItem constructor.
	 * @param $id
	 * @param $product_id
	 * @param $cart_id
	 * @param $quantity
	 * @param $product_name
	 * @param $product_price
	 */
	public function __construct($id, $product_id, $cart_id, $quantity,$product_name, $product_price)
	{
		$this->id = $id;
		$this->product_id = $product_id;
		$this->cart_id = $cart_id;
		$this->quantity = $quantity;
		$this->product_name = $product_name;
		$this->product_price = $product_price;
	}
}