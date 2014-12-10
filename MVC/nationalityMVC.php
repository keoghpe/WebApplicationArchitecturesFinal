<?php

require_once("Models/NationalityModel.php");

class NationalityMVCFactory extends MVCFactory
{
    function __construct() {
        parent::__construct();
        $this->type = "Nationality";
    }

    public function createModel(){
        $this->DAO_Factory->initDBResources();
        $DAO = $this->DAO_Factory->getDAO($this->type);
        return new NationalityModel($DAO);
    }
}

?>
