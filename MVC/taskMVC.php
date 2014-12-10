<?php

require_once("Models/TaskModel.php");

class TaskMVCFactory extends MVCFactory
{
    function __construct() {
        parent::__construct();
        $this->type = "Task";
    }

    public function createModel(){
        $this->DAO_Factory->initDBResources();
        $DAO = $this->DAO_Factory->getDAO($this->type);
        return new TaskModel($DAO);
    }
}

?>
