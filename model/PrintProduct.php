<?php

/**
 * Class PrintProduct
 */
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

    function __construct($printInfo = Array()) {
        $this->title    = $printInfo['title'];
        $this->category = $printInfo['name'];
        $this->image    = new PrintImage(
            $printInfo['fullSize'],
            $printInfo['thumbnail'],
            $printInfo['alt']);

        $this->printID  = $printInfo['printID'];
        $this->quantity = 1;
    }

    /**
     * Returns a unique ID for each product based on a few select values.
     *
     * Note: This does not indicate object equality.
     *
     * @return string the unique print ID
     */
    public function getUniqueID() {
        return $this->printID . $this->getTypeID() . $this->getSizeID();
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

    /**
     * Increases the quantity of the print by 1
     */
    public function incrementQuantity() {
        $this->quantity++;
    }

    /**
     * Decreases the quantity of the print by 1
     */
    public function decrementQuantity() {
        $this->quantity--;
    }

    /**
     * @return int
     */
    public function getQuantity() {
        return $this->quantity;
    }

}