<?php
/**
 * Created by PhpStorm.
 * User: nd
 * Date: 04.08.18
 * Time: 1:35
 */

class Customer
{
    public $id;
    public $name;
    public $company_id;
    public $contact_id;
    public $region_id;
    public $address_id;
    public $credentials_id;

	/**
	 * Customer constructor.
	 * @param $id
	 * @param $name
	 * @param $company_id
	 * @param $contact_id
	 * @param $region_id
	 * @param $address_id
	 * @param $credentials_id
	 */
	public function __construct($id, $name, $company_id, $contact_id, $region_id, $address_id, $credentials_id)
	{
		$this->id = $id;
		$this->name = $name;
		$this->company_id = $company_id;
		$this->contact_id = $contact_id;
		$this->region_id = $region_id;
		$this->address_id = $address_id;
		$this->credentials_id = $credentials_id;
	}
}