<?php
/**
 * Created by PhpStorm.
 * User: Robert
 * Date: 2015-02-05
 * Time: 11:51
 */

interface TableGateway {

    public function getAllPrints();
    public function getPrint();
    public function addPrint();
    public function removePrint();
    public function updatePrint();
    public function getPrintsByCategory($category);

}