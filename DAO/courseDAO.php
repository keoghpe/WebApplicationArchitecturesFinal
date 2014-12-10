<?php

class CourseDAO extends DAO
{
    protected $table_name = "courses";
    protected $table_id = "id_course";
    protected $foreign_key = "lecturer_id";
    protected $join_table_name = "lecturers";
    protected $join_table_id = "id";

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
