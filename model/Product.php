<?php

class Product {

    private $printID;
    private $name;
    private $price;
    private $frame;
    private $size;

    public function __construct($printInfo) {
        $this->printID = $printInfo['printID'];
        $this->name = $printInfo['name'];
        $this->price = $printInfo['price'];
        $this->quantity = 1;
    }

    public function setSize($size) {
        $this->size = $size;
    }

    public function setFrame($frame) {
        $this->frame = $frame;
    }

    public function getName() {
        return $this->name;
    }
}