<?php

require_once("Models/Model.php");
require_once("Models/CourseModel.php");
require_once("Models/LecturerModel.php");
require_once("Models/NationalityModel.php");
require_once("Models/QuestionnaireModel.php");
require_once("Models/StudentModel.php");
require_once("Models/TaskModel.php");

class MVCFactory
{
    protected $DAO_Factory;
    protected $type;

    public function __construct($type){
        $this->DAO_Factory = new DAO_Factory();
        $this->type = $type;
    }

    public function createView($model, $resource){
        return new View($model, $resource);
    }

    public function createController($model, $action, $id, $params){
        return new Controller($model, $action, $id, $params);
    }

    public function createModel(){
        $this->DAO_Factory->initDBResources();
        $DAO = $this->DAO_Factory->getDAO($this->type);
        $model = $this->type."Model";

        return new $model($DAO);
    }
}
?>
