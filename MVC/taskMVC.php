<?php

class TaskMVCFactory extends MVCFactory
{
    function __construct() {
        parent::__construct();
        $this->type = "Task";
    }
}

?>
