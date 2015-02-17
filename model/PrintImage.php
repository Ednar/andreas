<?php

/**
 * Class PrintImage
 *
 * Holds relevant image information
 */
final class PrintImage {

    private $fullSize;
    private $altText;

    function __construct($fullSize, $altText) {
        $this->fullSize = $fullSize;
        $this->altText = $altText;
    }

    /**
     * The url of the image
     *
     * @return mixed
     */
    public function getFullSize() {
        return $this->fullSize;
    }


    /**
     * The alt text of the image
     *
     * @return mixed
     */
    public function getAltText() {
        return $this->altText;
    }



}