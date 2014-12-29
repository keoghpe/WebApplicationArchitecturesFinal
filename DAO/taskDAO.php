<?php

class TaskDAO extends DAO
{

    protected $table_name = "tasks";
    protected $table_id = "task_id";

    protected $related_table_id = array("courses"=>"course_id");
}

?>
