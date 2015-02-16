<?php

require_once 'BaseDAO.php';

class SizeDAO extends BaseDAO {

    /**
     * @param $printID
     * @return mixed
     */
    public function getSizesForPrint($printID) {
        $sql = 'SELECT * FROM SizeToPrint
                LEFT JOIN Size on Size.sizeID = SizeToPrint.sizeID
                WHERE printID = :printID';
        $statement = self::$pdo->prepare($sql);
        $statement->execute(array('printID' => $printID));
        return $statement->fetchAll();
    }

    /**
     * @param $sizeID
     * @return mixed
     */
    public function getSize($sizeID) {
        $sql = 'SELECT format FROM Size WHERE sizeID = :sizeID';
        $statement = self::$pdo->prepare($sql);
        $statement->execute(array('sizeID' => $sizeID));
        return $statement->fetch();
    }

    /**
     * @param $typeID
     * @param $sizeID
     * @return mixed
     */
    public function getPriceForSizeAndType($typeID, $sizeID) {
        $sql = 'SELECT price FROM Size WHERE printTypeID = :printTypeID AND sizeID = :sizeID';
        $inputParams = array(':sizeID' => $sizeID, ':printTypeID' => $typeID);
        $statement = self::$pdo->prepare($sql);
        $statement->execute($inputParams);
        $result = $statement->fetch();
        return $result[0];
    }
}