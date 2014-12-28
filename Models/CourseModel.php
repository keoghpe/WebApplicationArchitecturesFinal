<?php

class CourseModel extends Model {

    protected $types = array(
        "id_course" => "integer",
        "description"=>"alphanumeric",
        "lecturer_id"=>"integer"
    );
}

?>
