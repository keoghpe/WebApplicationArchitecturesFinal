<?php

class TaskModel extends Model {

    protected $types = array(
        "task_id"=>"integer",
        "description"=>"paragraph",
        "date"=>"date",
        "duration_mins"=>"integer",
        "daytime"=>"timeinterval",
        "course_id"=>"1"
    );
}

?>
