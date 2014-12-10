<?php

class TaskDAO extends DAO
{

    protected $table_name = "tasks";
    protected $table_id = "task_id";

    public function search($params){
        return "search Task";
    }
    public function insert($params){
        return "insert Task";
    }
    public function update($params){
        return "update Task";
    }
    public function delete($params){
        return "delete Task";
    }
}

?>
