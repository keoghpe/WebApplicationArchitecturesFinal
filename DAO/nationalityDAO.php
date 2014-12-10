<?php

class NationalityDAO extends DAO
{

    protected $table_name = "nationalities";
    protected $table_id = "id";

    public function search($params){
        return "search Nationality";
    }
    public function insert($params){
        return "insert Nationality";
    }
    public function update($params){
        return "update Nationality";
    }
    public function delete($params){
        return "delete Nationality";
    }
}

?>
