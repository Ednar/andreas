<?php
/**
 * Created by PhpStorm.
 * User: Robert
 * Date: 2015-02-05
 * Time: 11:51
 */

interface TableGateway {

    public function getAllPictures();
    public function addPicture();
    public function removePicture();
    public function updatePicture();
    public function getAllPicturesByCategory($category);

}