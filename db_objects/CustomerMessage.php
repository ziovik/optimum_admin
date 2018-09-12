<?php
/**
 * Created by PhpStorm.
 * User: nd
 * Date: 29.08.18
 * Time: 13:38
 */
require_once 'Message.php';

class CustomerMessage extends Message
{

	/**
	 * CustomerMessage constructor.
	 * @param $author
	 * @param $body
	 * @param $date
	 */
	public function __construct($author, $body, $date)
	{
		parent::__construct($author, $body, $date);
	}
}
?>