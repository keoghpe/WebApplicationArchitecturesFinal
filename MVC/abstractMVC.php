<?php

require_once("Models/Model.php");

abstract class MVCFactory
{
    protected $DAO_Factory;
    protected $type;

    public function __construct(){
        $this->DAO_Factory = new DAO_Factory();
    }
    public function createView($model){
        return new View($model);
    }
    public function createController($model, $action, $id, $params){
        return new Controller($model, $action, $id, $params);
    }
    public function createModel(){
        $this->DAO_Factory->initDBResources();
        $DAO = $this->DAO_Factory->getDAO($this->type);
        return new Model($DAO);
    }
}
?>
