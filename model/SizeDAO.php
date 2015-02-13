<?php

require_once 'AbstractDAO.php';


class SizeDAO extends AbstractDAO {

    public function getSizesForPrint($printID) {
        $sql = 'SELECT * FROM SizeToPrint
                LEFT JOIN Size on Size.sizeID = SizeToPrint.sizeID
                WHERE printID = :printID';
        return $this->databaseManager->request($sql, array(':printID' => $printID), 'fetchAll');
    }

    public function getSize($sizeID) {
        $sql = 'SELECT format FROM Size WHERE sizeID = :sizeID';
        return $this->databaseManager->request($sql, array('sizeID' => $sizeID), 'fetch');
    }

    public function getPriceForSizeAndType($typeID, $sizeID) {
        $sql = 'SELECT price FROM Size WHERE typeID = :typeID AND sizeID = :sizeID';
        return $this->databaseManager->request(
            $sql,
            array(  ':sizeID ' => $sizeID,
                    'typeID' => $typeID),
            'fetchAll');
    }
}