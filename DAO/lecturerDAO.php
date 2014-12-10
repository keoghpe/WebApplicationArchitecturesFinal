<?php

class LecturerDAO extends DAO
{

    protected $table_name = "lecturers";
    protected $table_id = "id";

    public function search($params){
        return "search Lecturer";
    }
    public function update($params){
        return "update Lecturer";
    }
    public function delete($params){
        return "delete Lecturer";
    }
}

?>
