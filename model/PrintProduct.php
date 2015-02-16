<?php

class PrintProduct {

    private $title;
    private $category;
    private $size;
    private $type;
    private $price;

    private $printID;
    private $sizeID;
    private $typeID;

    private $sizeOptions = array();
    private $typeOptions = array();

    private $image;

    private $quantity;

    function __construct($printInfo = Array(), PrintImage $printImage) {
        $this->title    = $printInfo['title'];
        $this->category = $printInfo['categoryID'];
        $this->image    = $printImage;

        $this->printID  = $printInfo['printID'];
        $this->quantity = 1;
    }

    public function getUniqueID() {
        return $this->printID . $this->getSizeID() . $this->getTypeID();
    }

    /**
     * @param $sizeOptions
     */
    public function setSizeOptions($sizeOptions) {
        $this->sizeOptions = $sizeOptions;
    }

    /**
     * @param $typeOptions
     */
    public function setTypeOptions($typeOptions) {
        $this->typeOptions = $typeOptions;
    }

    /**
     * @return mixed
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * @return mixed
     */
    public function getSize() {
        return $this->size;
    }

    /**
     * @return mixed
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getPrintID() {
        return $this->printID;
    }

    /**
     * @return mixed
     */
    public function getSizeID() {
        return $this->sizeID;
    }

    /**
     * @return mixed
     */
    public function getTypeID() {
        return $this->typeID;
    }

    /**
     * @return array
     */
    public function getSizeOptions() {
        return $this->sizeOptions;
    }

    /**
     * @return array
     */
    public function getTypeOptions() {
        return $this->typeOptions;
    }

    /**
     * @return PrintImage
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size) {
        $this->size = $size['format'];
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type['type'];
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @param mixed $sizeID
     */
    public function setSizeID($sizeID)
    {
        $this->sizeID = $sizeID;
    }

    /**
     * @param mixed $typeID
     */
    public function setTypeID($typeID)
    {
        $this->typeID = $typeID;
    }

    public function incrementQuantity() {
        $this->quantity++;
    }

    public function decrementQuantity() {
        $this->quantity--;
    }

    public function getQuantity() {
        return $this->quantity;
    }

}