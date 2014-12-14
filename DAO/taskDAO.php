<?php

class TaskDAO extends DAO
{

    protected $table_name = "tasks";
    protected $table_id = "task_id";
    protected $foreign_key = "course_id";
    protected $join_table_name = "courses";
    protected $join_table_id = "id_course";
}

?>
