<?php

require_once("Models/StudentModel.php");

class StudentMVCFactory extends MVCFactory
{
    function __construct() {
        parent::__construct();
        $this->type = "Student";
    }

    public function createModel(){
        $this->DAO_Factory->initDBResources();
        $DAO = $this->DAO_Factory->getDAO($this->type);
        return new StudentModel($DAO);
    }
}

?>
