<?php
/**
 * Created by PhpStorm.
 * User: nd
 * Date: 04.08.18
 * Time: 0:49
 */

class Product
{
    public $id;
    public $name;
    public $description;
    public $manufacturer;
    public $keyword;
    public $price;
    public $distributor_id;
    public $sub_category_id;

    /**
     * Product constructor.
     * @param $id
     * @param $name
     * @param $description
     * @param $manufacturer
     * @param $keyword
     * @param $price
     * @param $distributor_id
     * @param $sub_category_id
     */
    public function __construct($id, $name, $description, $manufacturer, $keyword, $price, $distributor_id, $sub_category_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->manufacturer = $manufacturer;
        $this->keyword = $keyword;
        $this->price = $price;
        $this->distributor_id = $distributor_id;
        $this->sub_category_id = $sub_category_id;
    }


}