<?php

require_once 'BaseDAO.php';

/**
 * Class SizeDAO
 */
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
        $statement->execute(array(':printID' => $printID));
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
    public function getPriceForSizeAndType($typeID, $format) {
        $sql = 'SELECT price FROM Size WHERE printTypeID = :printTypeID AND format = :format';
        $inputParams = array(':format' => $format, ':printTypeID' => $typeID);
        $statement = self::$pdo->prepare($sql);
        $statement->execute($inputParams);
        $result = $statement->fetch();
        return $result[0];
    }

    /**
     * @return array sizes for all 3:1 images
     */
    public function getSizeIDsForAspectRatioWide() {
        $sql = "SELECT sizeID FROM Size
                WHERE format = '120x40' OR '150x50' OR '180x60' OR '210x70'";
        $statement = self::$pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    /**
     * @return array sizes for all 16:9 images
     */
    public function getSizeIDsForAspectRatioFat() {
        $sql = "SELECT sizeID FROM Size
                WHERE format = '90x51' OR format = '100x56' OR format = '110x62' OR format = '120x68'";
        $statement = self::$pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchALL();
    }

    /**
     * Adds all the correct sizes to the database
     *
     * @param $printID
     * @param $sizeIDs
     */
    public function setSizeToPrint($printID, $sizeIDs) {
        foreach ($sizeIDs as $sizeID) {
            $size = $sizeID['sizeID'];
            $sql = 'INSERT INTO SizeToPrint (printID, sizeID) VALUES (:printID, :sizeID)';
            $statement = self::$pdo->prepare($sql);
            $inputParams = array(':printID' => $printID, ':sizeID' => $size);
            $statement->execute($inputParams);
        }
    }
}