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


    public function get($params_array){

        $sqlQuery = "SELECT * ";
        $sqlQuery .= "FROM $this->table_name ";

        // if(property_exists($this, "join_table_name")){
        //     $sqlQuery .= "INNER JOIN $this->join_table_name ";
        //     $sqlQuery .= "ON $this->table_name.$this->foreign_key";
        //     $sqlQuery .= "=";
        //     $sqlQuery .= "$this->join_table_name.$this->join_table_id ";
        // }

        if ($params_array["id"] !== null) {
            $id=$params_array["id"];
            $sqlQuery .= " WHERE  $this->table_name.$this->table_id = '$id' ";
        }

        $sqlQuery .= "ORDER BY $this->table_name.$this->table_id ";

        $this->filter($sqlQuery, $params_array);

        $sqlQuery .="; ";

        $result = $this->getDbManager()->executeSelectQuery($sqlQuery);

        return $result;

    }

    public function search($params_array,$model){
        $query = $params_array["query"];
        $sqlQuery = "SELECT * ";
        $sqlQuery .= "FROM $this->table_name ";
        $sqlQuery .= "WHERE ";

        $search_string = "";
        foreach($model as $key => $value){
            $search_string .= "$this->table_name.$key LIKE '%$query%' OR ";
        }

        $sqlQuery .= substr($search_string, 0, -3);


        $sqlQuery .= "ORDER BY $this->table_name.$this->table_id ";

        $this->filter($sqlQuery, $params_array);

        $sqlQuery .= ";";

        $result = $this->getDbManager()->executeSelectQuery($sqlQuery);

        return $result;
    }

    public function insert($params_array){

        $params = $params_array["params"];

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

    public function update($params_array){

        $params = $params_array["params"];


        $sqlQuery = "UPDATE $this->table_name";
        $sqlQuery .= " SET ";

        $set_string = "";

        foreach($params as $key => $value) {
            $set_string .= "$this->table_name";
            $set_string .= ".$key ";
            $set_string .= "= '$value', ";
        }

        $set_string = substr($set_string, 0, -2);

        $sqlQuery .= $set_string;

        if($params_array["id"] !== null){
            $id = $params_array["id"];
            $sqlQuery .= " WHERE $this->table_name.$this->table_id = $id";
        }

        $sqlQuery .= ";";

        echo $sqlQuery;

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

    private function filter(&$sqlQuery, $params_array){

        if(\helper\array_and_key_exist($params_array["conditions"], "limit")){
            $limit = $params_array["conditions"]["limit"];
            $sqlQuery .= "LIMIT $limit ";

            if(\helper\array_and_key_exist($params_array["conditions"], "offset")){
                $offset = $params_array["conditions"]["offset"];
                $sqlQuery .= "OFFSET $offset ";
            }
        }
    }
}


?>
