<?php
/**
 * Created by PhpStorm.
 * User: nd
 * Date: 04.08.18
 * Time: 0:49
 */

class Cart
{
    public $id;
    public $customer_id;
    public $status;

    /**
     * Cart constructor.
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