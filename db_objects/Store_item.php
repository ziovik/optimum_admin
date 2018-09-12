<?php

/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 8/3/2018
 * Time: 11:17 PM
 */

class Store_item
{
    public $id;
    public $product_id;
    public $store_id;
    public $price;
    public $min_order;
    public $max_order;

    /**
     * Store_item constructor.
     * @param $id
     * @param $product_id
     * @param $store_id
     * @param $price
     * @param $min_order
     * @param $max_order
     */
    public function __construct($id, $product_id, $store_id, $price, $min_order, $max_order)
    {
        $this->id = $id;
        $this->product_id = $product_id;
        $this->store_id = $store_id;
        $this->price = $price;
        $this->min_order = $min_order;
        $this->max_order = $max_order;
    }





}