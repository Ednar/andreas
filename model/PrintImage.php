<?php

/**
 * Class PrintImage
 *
 * Holds relevant image information
 */
class PrintImage {

    private $fullSize;
    private $thumbnail;
    private $altText;

    function __construct($fullSize, $thumbnail, $altText) {
        $this->fullSize = $fullSize;
        $this->thumbnail = $thumbnail;
        $this->altText = $altText;
    }

    /**
     * @return mixed
     */
    public function getFullSize()
    {
        return $this->fullSize;
    }

    /**
     * @return mixed
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @return mixed
     */
    public function getAltText()
    {
        return $this->altText;
    }



}