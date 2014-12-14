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


    public function get($id=null, $params=null, $related_resource=null){

        $sqlQuery = "SELECT * ";
        $sqlQuery .= "FROM $this->table_name ";

        $sqlQuery .= "INNER JOIN $this->join_table_name ";
        $sqlQuery .= "ON $this->table_name.$this->foreign_key";
        $sqlQuery .= "=";
        $sqlQuery .= "$this->join_table_name.$this->join_table_id ";

        if ($id !== null) {
            $sqlQuery .= " WHERE  $this->table_name.$this->table_id = '$id' ";
        }

        $sqlQuery .= "ORDER BY $this->table_name.$this->table_id";
        $sqlQuery .="; ";

        //echo $sqlQuery;
        $result = $this->getDbManager()->executeSelectQuery($sqlQuery);

        return $result;

    }

    public function insert($params){

        $keys = "(";
        $values = "(";

        foreach($params as $key => $value) {
            $keys .= "$key, ";
            $values .= "'$value', ";
        }

        $keys = substr($keys, 0, -2);
        $values = substr($values, 0, -2);

        $keys .= ")";
        $values .= ")";

        $sqlQuery = "INSERT INTO ". $this->table_name ." " .$keys." ";
        $sqlQuery .= "VALUES " . $values .";";

        $result = $this->getDbManager()->executeQuery($sqlQuery);

        if($result === null){
            $result = array("sucessfully inserted:" => $params);
        }

        return $result;

    }

    public function search($id, $query, $model){
        $sqlQuery = "SELECT * ";
        $sqlQuery .= "FROM $table_name ";
        $sqlQuery .= "WHERE ";

        $search_string = "";
        foreach($model as $key => $value){
            $search_string .= "$table_name.$key LIKE '%$query%' OR ";
        }

        $sqlQuery .= substr($search_string, 0, -3);
        $sqlQuery .= "ORDER BY publications.id; ";

        $result = $this->getDbManager()->executeSelectQuery($sqlQuery);

        return $result;
    }

    public function update($id, $params){
        $sqlQuery = "UPDATE $table_name";
        $sqlQuery .= " SET ";

        $set_string = "";

        foreach($params as $key => $value) {
            $set_string .= "$table_name.$key = '$value', ";
        }

        $set_string = substr($set_string, 0, -2);

        $sqlQuery .= $set_string;
        $sqlQuery .= " WHERE $table_name.$table_id = $id";

        echo $sqlQuery;

        $result = $this->getDbManager()->executeQuery($sqlQuery);

        return $result;
    }

    public function delete($id){
        $sqlQuery = "DELETE FROM $table_name ";
        $sqlQuery .= "WHERE $table_name.$table_id = '$id'";

        $result = $this->getDbManager()->executeQuery($sqlQuery);

        return $result;
    }
}


?>
