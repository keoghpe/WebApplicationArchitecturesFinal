<?php

class CourseModel extends Model {

    protected $template = array(
        "description"=>"empty",
        "lecturer_id"=>"1"
    );

    protected $types = array(
        "description"=>"alphanumeric",
        "lecturer_id"=>"integer"
    );
}

?>
