<?php

require_once("Models/QuestionnaireModel.php");
class QuestionnaireMVCFactory extends MVCFactory
{
    function __construct() {
        parent::__construct();
        $this->type = "Questionnaire";
    }

    public function createModel(){
        $this->DAO_Factory->initDBResources();
        $DAO = $this->DAO_Factory->getDAO($this->type);
        return new QuestionnaireModel($DAO);
    }
}

?>
