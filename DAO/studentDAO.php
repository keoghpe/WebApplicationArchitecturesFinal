<?php

class StudentDAO extends DAO
{

    protected $table_name = "students";
    protected $table_id = "student_number";

    public function search($params){
        return "search Student";
    }
    public function insert($params){
        return "insert Student";
    }
    public function update($params){
        return "update Student";
    }
    public function delete($params){
        return "delete Student";
    }
}

?>
