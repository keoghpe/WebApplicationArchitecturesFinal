<?php

class Task  Model extends Model {

    protected $template = array(
        "description"=>"empty",
        "date"=>"2014-01-27",
        "duration_mins"=>"60",
        "daytime"=>"12:00-13:00",
        "course_id"=>"1"
    );

    protected $types = array(
        "description"=>"paragraph",
        "date"=>"date",
        "duration_mins"=>"integer",
        "daytime"=>"timeinterval",
        "course_id"=>"1"
    );
}

?>
