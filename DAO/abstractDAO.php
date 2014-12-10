<?php

abstract class DAO
{
    protected $dbManager = null;
    function __construct($dbmanagerOBJ)
    {
        $this->dbManager = $dbmanagerOBJ;
    }

    public function getDBManager() {
        if ($this->dbManager == null)
        throw new Exception ( "No persistence storage link" );

        return $this->dbManager;
    }

    public function get($id = null){
        $sqlQuery = "SELECT * ";
        $sqlQuery .= "FROM ". $this->table_name ." ";

        // if ($id !== null) {
        //     $sqlQuery .= "WHERE courses.id_course = '$id' ";
        // }

        $sqlQuery .= "ORDER BY ".$this->table_name.".".$this->table_id."; ";

        $result = $this->getDbManager()->executeSelectQuery($sqlQuery);

        return $result;
    }

    //abstract public function get($params);
    abstract public function search($params);
    abstract public function insert($params);
    abstract public function update($params);
    abstract public function delete($params);
}


?>
