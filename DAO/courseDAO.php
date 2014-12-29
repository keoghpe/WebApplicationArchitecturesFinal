<?php

class CourseDAO extends DAO
{
    protected $table_name = "courses";
    protected $table_id = "id_course";

    protected $related_table_id = array("lecturers"=>"lecturer_id");
}

?>
