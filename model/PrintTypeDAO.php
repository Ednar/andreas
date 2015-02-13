<?php

require_once 'helpers/DatabaseHandleConstants.php';

class PrintTypeDAO extends AbstractDAO {

    public function getAllPrintTypes() {
        $sql = 'SELECT * FROM PrintType';
        return $this->databaseHandle->request($sql, array(), 'fetchAll');
    }

    public function getPrintTypeByID($typeID) {
        $sql = 'SELECT type FROM PrintType WHERE printTypeID = :typeID';
        return $this->databaseHandle->request($sql, array('typeID' => $typeID), 'fetch');
    }
}