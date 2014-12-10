<?php

class QuestionnaireDAO extends DAO
{

    protected $table_name = "questionnaire";
    protected $table_id = "id";

    public function search($params){
        return "search Questionnaire";
    }
    public function insert($params){
        return "insert Questionnaire";
    }
    public function update($params){
        return "update Questionnaire";
    }
    public function delete($params){
        return "delete Questionnaire";
    }
}

?>
