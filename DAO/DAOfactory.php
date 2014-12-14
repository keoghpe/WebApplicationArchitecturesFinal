<?php

include_once("simpledb_mysql_manager.php");
require_once("abstractDAO.php");
require_once("lecturerDAO.php");
require_once("taskDAO.php");
require_once("courseDAO.php");
require_once("nationalityDAO.php");
require_once("questionnaireDAO.php");
require_once("studentDAO.php"); 


class DAO_Factory {

    private $dbManager;

    public function initDBResources(){
        $this->dbManager = new DBManager ();
        $this->dbManager->openConnection ();
    }

    public function getDAO($type='')
    {
        switch ($type) {
            case 'Lecturer':
                return new LecturerDAO($this->dbManager);
                break;
            case 'Course':
                return new CourseDAO($this->dbManager);
                break;
            case 'Task':
                return new TaskDAO($this->dbManager);
                break;
            case 'Student':
                return new StudentDAO($this->dbManager);
                break;
            case 'Nationality':
                return new NationalityDAO($this->dbManager);
                break;
            case 'Questionnaire':
                return new QuestionnaireDAO($this->dbManager);
                break;
            default:
                echo "derp";
                break;
        }
    }

    public function clearDBResources() {
        if ($this->dbManager != null) {
            $this->dbManager->closeConnection ();
        }
    }

    public function getDBManager() {
        if ($this->dbManager == null)
        throw new Exception ( "No persistence storage link" );

        return $this->dbManager;
    }
}

?>
