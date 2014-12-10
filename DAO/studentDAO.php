<?php

class StudentDAO extends DAO
{

    protected $table_name = "students";
    protected $table_id = "student_number";
    protected $foreign_key = "id_nationality";
    protected $join_table_name = "nationalities";
    protected $join_table_id = "id";


    public function search($params){
        return "search Student";
    }
    public function update($params){
        return "update Student";
    }
    public function delete($params){
        return "delete Student";
    }
}

?>
