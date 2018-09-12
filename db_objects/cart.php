<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 8/3/2018
 * Time: 11:16 PM
 */

class Cart
{
	public $id;
	public $customer_id;
	public $status;

	/**
	 * cart constructor.
	 * @param $id
	 * @param $customer_id
	 * @param $status
	 */
	public function __construct($id, $customer_id, $status)
	{
		$this->id = $id;
		$this->customer_id = $customer_id;
		$this->status = $status;
	}
}