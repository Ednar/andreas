<?php

require_once 'AbstractDAO.php';


class SizeDAO extends AbstractDAO {

    public function getSizesForPrint($printID) {
        $sql = 'SELECT * FROM SizeToPrint
                LEFT JOIN Size on Size.sizeID = SizeToPrint.sizeID
                WHERE printID = :printID';
        return $this->databaseHandle->request($sql, array(':printID' => $printID), 'fetchAll');
    }

    public function getSize($sizeID) {
        $sql = 'SELECT format FROM Size WHERE sizeID = :sizeID';
        return $this->databaseHandle->request($sql, array('sizeID' => $sizeID), 'fetch');
    }

    public function getPriceForSizeAndType($typeID, $sizeID) {
        $sql = 'SELECT price FROM Size WHERE printTypeID = :printTypeID AND sizeID = :sizeID';
        $result =  $this->databaseHandle->request($sql, array(':sizeID' => $sizeID, ':printTypeID' => $typeID), 'fetch');
        return $result;
    }
}