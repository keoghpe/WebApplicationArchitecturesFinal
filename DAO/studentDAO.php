<?php

class StudentDAO extends DAO
{

    protected $table_name = "students";
    protected $table_id = "student_number";

    protected $related_table_id = array("nationalities"=>"id_nationality");
}

?>
