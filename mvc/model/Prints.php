<?php


/**
 * Description of Prints
 *
 * @author noworries
 */
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

class Prints {
    public $title;
    public $url;
    public $size;
    public $price;
    
    public function __construct($title, $url, $size, $price) {
        $this->title = $title;
        $this->url = $url;
        $this->size = $size;
        $this->price = $price;        
    }
}
