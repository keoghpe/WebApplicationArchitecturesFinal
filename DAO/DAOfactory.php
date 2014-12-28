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

        $DAOs = array('Lecturer','Course','Task','Student','Nationality','Questionnaire');

        
        if(in_array($type, $DAOs)){
            $type = $type."DAO";
            return new $type($this->dbManager);
        } else {
            throw new Exception("You broke my DAO somehow");
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
