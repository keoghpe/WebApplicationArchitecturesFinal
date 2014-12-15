<?php

/**
 * @author Keoghpe
 *
 * This abstract DAO class implements all of the generic database methods for each table.
 * In order to make use of the methods a concrete class should inherit from this class and
 * contain protected attributes like the following:
 *
 * protected $table_name = "questionnaire"; // the table name
 * protected $table_id = "id"; // the table primary key
 * protected $join_table_name = "students"; // a table to join with (optional)
 * protected $foreign_key = "student_number"; // a foreign key to join on (must be set if $join_table_name is set)
 * protected $join_table_id = "student_number"; // the column name of the foreign key in the joining table (must be set if $join_table_name is set)
 *
 * A subclass can override these methods to produce different behaviour
 */

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


    public function get($id=null, $params=null, $related=null){

        $sqlQuery = "SELECT * ";
        $sqlQuery .= "FROM $this->table_name ";

        if(property_exists($this, "join_table_name")){
            $sqlQuery .= "INNER JOIN $this->join_table_name ";
            $sqlQuery .= "ON $this->table_name.$this->foreign_key";
            $sqlQuery .= "=";
            $sqlQuery .= "$this->join_table_name.$this->join_table_id ";
        }

        if ($id !== null) {
            $sqlQuery .= " WHERE  $this->table_name.$this->table_id = '$id' ";
        }

        $sqlQuery .= "ORDER BY $this->table_name.$this->table_id";
        $sqlQuery .="; ";

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

    public function search($query, $model){
        $sqlQuery = "SELECT * ";
        $sqlQuery .= "FROM $table_name ";
        $sqlQuery .= "WHERE ";

        $search_string = "";
        foreach($model as $key => $value){
            $search_string .= "$table_name.$key LIKE '%$query%' OR ";
        }

        $sqlQuery .= substr($search_string, 0, -3);
        $sqlQuery .= "ORDER BY $table_name.$table_id; ";

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

        $result = $this->getDbManager()->executeQuery($sqlQuery);

        return $result;
    }

    public function delete($id){
        $sqlQuery = "DELETE FROM $table_name ";
        if($id !== null)
            $sqlQuery .= "WHERE $table_name.$table_id = '$id'";

        $result = $this->getDbManager()->executeQuery($sqlQuery);

        return $result;
    }
}


?>
