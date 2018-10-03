<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 8/3/2018
 * Time: 11:17 PM
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
    public $min_quantity;
    public $distributor;

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
     * @param $min_quantity
     * @param $distributor
     */
    public function __construct($id, $name, $description, $manufacturer, $keyword, $price, $distributor_id, $sub_category_id, $min_quantity, $distributor)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->manufacturer = $manufacturer;
        $this->keyword = $keyword;
        $this->price = $price;
        $this->distributor_id = $distributor_id;
        $this->sub_category_id = $sub_category_id;
        $this->min_quantity = $min_quantity;
        $this->distributor = $distributor;
    }
}
