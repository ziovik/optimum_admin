<?php
/**
 * Created by PhpStorm.
 * User: nd
 * Date: 04.08.18
 * Time: 14:48
 */

class ProductItem
{
	public $id;
	public $product_id;
	public $quantity;
	public $cart_id;

	/**
	 * ProductItem constructor.
	 * @param $id
	 * @param $product_id
	 * @param $quantity
	 * @param $cart_id
	 */
	public function __construct($id, $product_id, $quantity, $cart_id)
	{
		$this->id = $id;
		$this->product_id = $product_id;
		$this->quantity = $quantity;
		$this->cart_id = $cart_id;
	}
}