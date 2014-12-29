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
 *
 * A subclass can override these methods to produce different behaviour
 */

abstract class DAO
{
    protected $dbManager = null;
    function __construct($dbmanagerOBJ)
    {
        $this->dbManager = $dbmanagerOBJ;
        $this->related_table_id = array();
    }

    public function getDBManager() {
        if ($this->dbManager == null)
        throw new Exception( "No persistence storage link" );

        return $this->dbManager;
    }


    public function get($params_array){

        $sqlQuery = "SELECT ";
        $sqlQuery.= isset($params_array["conditions"]["fields"]) ? $params_array["conditions"]["fields"]: "* ";
        $sqlQuery .= " FROM $this->table_name ";

        if($params_array["related"] !== null && $params_array["id"] !== null){

            if(array_key_exists($params_array["related"], $this->related_table_id)){
                $id=$params_array["id"];
                $rel_id = $this->related_table_id[$params_array["related"]];
                $sqlQuery .= " WHERE  $rel_id = '$id' ";
            } else{
                $related = $params_array["related"];
                return array("related_entity_error"=>"There are no $related associated with the entity $this->table_name");
            }

        } else if ($params_array["id"] !== null) {
            $id=$params_array["id"];
            $sqlQuery .= " WHERE  $this->table_name.$this->table_id = '$id' ";
        }

        $sqlQuery .= "ORDER BY $this->table_name.$this->table_id ";

        $this->filter($sqlQuery, $params_array);

        $sqlQuery .="; ";
        //echo $sqlQuery;

        $result = $this->getDbManager()->executeSelectQuery($sqlQuery);

        return $result;

    }

    public function search($params_array,$model){
        $query = $params_array["query"];
        $sqlQuery.= isset($params_array["conditions"]["fields"]) ? $params_array["conditions"]["fields"]: "* ";
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

        //echo $sqlQuery;

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
