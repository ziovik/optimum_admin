<?php
/**
 * Created by PhpStorm.
 * User: nd
 * Date: 04.08.18
 * Time: 0:59
 */

class SubCategory
{
    public $id;
    public $name;
    public $category_id;

	/**
	 * Category constructor.
	 * @param $id
	 * @param $name
	 * @param $category_id
	 */
    public function __construct($id, $name, $category_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->category_id = $category_id;
    }
}