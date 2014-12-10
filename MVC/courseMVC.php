<?php

require_once('Models/CourseModel.php');

class CourseMVCFactory extends MVCFactory
{
    function __construct() {
        parent::__construct();
        $this->type = "Course";
    }

    public function createModel(){
        $this->DAO_Factory->initDBResources();
        $DAO = $this->DAO_Factory->getDAO($this->type);
        return new CourseModel($DAO);
    }
}

?>
