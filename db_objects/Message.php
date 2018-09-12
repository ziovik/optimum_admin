<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 8/28/2018
 * Time: 3:14 PM
 */

class Message
{
    public $author;
    public $body;
    public $date;

    /**
     * Message constructor.
     * @param $author
     * @param $body
     * @param $date
     */
    public function __construct($author, $body, $date)
    {
        $this->author = $author;
        $this->body = $body;
        $this->date = $date;
    }
}
?>