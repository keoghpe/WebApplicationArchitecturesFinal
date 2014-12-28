<?php

class CourseDAO extends DAO
{
    protected $table_name = "courses";
    protected $table_id = "id_course";
    protected $foreign_key = "lecturer_id";
    protected $join_table_name = "lecturers";
    protected $join_table_id = "id";
    
}

?>
