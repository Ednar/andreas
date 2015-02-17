<?php

/**
 * Class PrintTypeDAO
 */
class PrintTypeDAO extends BaseDAO {

    /**
     * @return mixed
     */
    public function getAllPrintTypes() {
        $sql = 'SELECT * FROM PrintType';
        $statement = self::$pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    /**
     * @param $typeID
     * @return mixed
     */
    public function getPrintTypeByID($typeID) {
        $sql = 'SELECT type FROM PrintType WHERE printTypeID = :typeID';
        $statement = self::$pdo->prepare($sql);
        $statement->execute(array('typeID' => $typeID));
        return $statement->fetch();
    }
}