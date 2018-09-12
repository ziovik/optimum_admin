<?php
/**
 * Created by PhpStorm.
 * User: nd
 * Date: 04.08.18
 * Time: 0:58
 */

class Category
{
    public $id;
    public $name;

    /**
     * Category constructor.
     * @param $id
     * @param $name
     */
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}