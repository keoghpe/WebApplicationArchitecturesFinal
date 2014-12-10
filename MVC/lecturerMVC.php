<?php

require_once("Models/LecturerModel.php");

class LecturerMVCFactory extends MVCFactory
{
    function __construct() {
        parent::__construct();
        $this->type = "Lecturer";
    }

    public function createModel(){
        $this->DAO_Factory->initDBResources();
        $DAO = $this->DAO_Factory->getDAO($this->type);
        return new LecturerModel($DAO);
    }
}

?>
