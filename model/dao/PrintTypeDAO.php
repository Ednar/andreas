<?php

require_once 'helpers/DatabaseHandleConstants.php';

class PrintTypeDAO extends AbstractDAO {

    /**
     * @return mixed
     */
    public function getAllPrintTypes() {
        $sql = 'SELECT * FROM PrintType';
        return $this->databaseHandle->request($sql, array(), 'fetchAll');
    }

    /**
     * @param $typeID
     * @return mixed
     */
    public function getPrintTypeByID($typeID) {
        $sql = 'SELECT type FROM PrintType WHERE printTypeID = :typeID';
        return $this->databaseHandle->request($sql, array('typeID' => $typeID), 'fetch');
    }
}