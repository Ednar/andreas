<?php
/**
 * Created by PhpStorm.
 * User: Robert
 * Date: 2015-02-05
 * Time: 11:51
 */

interface IDAO {

    public function getAllPrints();
    public function getPrint($printID);
    public function insertPrint($name, $description, $price, $pictureID);
    public function deletePrint($printID);
    public function updatePrint($printID, $name, $description, $price, $pictureID);
    public function getPrintsByCategory($category);
    public function getMediaLibrary();
    public function insertPictureToLibrary($url, $alt);
    public function deletePictureFromLibrary($pictureID);
    public function updatePictureInLibrary($pictureID, $url, $alt);
            

}