<?php

class CourseDAO extends DAO
{
    protected $table_name = "courses";
    protected $table_id = "id_course";

    public function search($params){
        return "search Course";
    }
    public function insert($params){
        return "insert Course";
    }
    public function update($params){
        return "update Course";
    }
    public function delete($params){
        return "delete Course";
    }
}

?>
