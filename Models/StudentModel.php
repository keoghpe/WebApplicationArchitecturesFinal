<?php

class StudentModel extends Model {

    protected $template = array(
        "student_number"=>"ffffff",
        "age"=>"0",
        "id_nationality"=>"0"
    );

    protected $types = array(
        "student_number"=>"hex",
        "description"=>"alphanumeric",
        "lecturer_id"=>"integer"
    );
}

?>